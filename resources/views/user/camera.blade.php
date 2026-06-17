<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Section</title>   

    <style>
        *, *::before, *::after {
            cursor: inherit;
        }

        body {
            cursor: url("assets/Images/cursor.png"), auto;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f0f8;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            padding: 40px;
            background-color: #fcf8ff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            margin-top: -10px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .video-wrapper {
            position: relative;
            width: 90%;
            max-width: 600px;
            margin-bottom: 30px;
        }

        #video-container {
            background-color: #333;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            height: 450px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        #video-feed {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #countdown-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 0 10px rgba(0,0,0,0.8);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s;
        }

        #poses-left {
            margin-bottom: 8px;
            font-weight: bold;
            color: #000;
            text-align: center;
        }

        /* Debug bar — remove this once confirmed working */
        #debug-bar {
            font-size: 11px;
            color: #888;
            margin-bottom: 4px;
        }

        #capture-canvas {
            display: none;
        }

        .controls {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-top: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .shutter-button {
            padding: 15px 40px;
            background-color: #FF8282;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: inherit;
            font-size: 1.3em;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.1s;
        }

        .shutter-button:hover:not(:disabled) {
            background-color: #ff4b8b;
        }

        #upload-btn {
            background-color: #FFCDC9;
            cursor: inherit;
            color: #DA0C81;
            font-size: 1.1em;
            padding: 12px 30px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        #upload-btn:hover:not(:disabled) {
            background-color: #ffb6b0;
        }

        .shutter-button:active:not(:disabled) {
            transform: scale(0.98);
        }

        .shutter-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .timer-select {
            padding: 10px 15px;
            border-radius: 20px;
            border: 1px solid #6b3e77;
            background-color: #fff;
            font-size: 1em;
        }

        .filter-bar {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .filter-pill {
            background: #ffffff;
            border-radius: 999px;
            padding: 10px 18px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .filter-dot {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            cursor: inherit;
            background-size: cover;
            background-position: center;
            background-color: #f3f3f3;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .filter-dot:hover {
            transform: scale(1.08);
            box-shadow: 0 0 0 2px #ff4b8b33;
        }

        .filter-dot.active {
            box-shadow: 0 0 0 3px #ff4b8b;
        }

        .filter-dot.normal  { background-image: url('assets/Images/ic_normal.jpg'); }
        .filter-dot.bw      { background-image: url('assets/Images/ic_black&white.jpeg'); }
        .filter-dot.sepia   { background-image: url('assets/Images/ic_sepia.jpeg'); }
        .filter-dot.mirror  { background-image: url('assets/Images/ic_mirror.webp'); }

        #preview-strip {
            margin-top: 30px;
            padding: 15px 12px 35px 12px;
            background-color: white;
            width: 160px;
            min-height: 250px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 2px;
        }

        #preview-strip::after {
            content: " The Digital Strip ";
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
            font-size: 9px;
            color: #fe87e8;
            font-weight: bold;
            text-align: center;
        }

        .preview-layout {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-grow: 1;
            justify-content: center;
        }

        .preview-layout.layout-C,
        .preview-layout.layout-D {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-content: center;
            gap: 6px;
        }

        .preview-slot {
            background: #f0f0f0;
            border-radius: 1px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #bbb;
            aspect-ratio: 4 / 3;
        }

        .layout-C .preview-slot,
        .layout-D .preview-slot {
            aspect-ratio: 1 / 1;
        }

        .preview-slot img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #next-btn {
            margin-top: 20px;
            padding: 12px 32px;
            border-radius: 999px;
            border: none;
            background: #ff4b8b;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            display: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            cursor: inherit;
        }
    </style>
</head>
<body>

    {{-- Navigation --}}
    @auth
        @include('nav.HeaderAfterLogin')
    @else
        @include('nav.nav')
    @endauth

    <div class="container">
        <h1 style="color: #000; margin-bottom: 10px;">Ready for Your Strip?</h1>

        <!-- Debug bar: shows exactly what was read from sessionStorage -->
        <div id="debug-bar"></div>

        <div id="poses-left"></div>

        <div class="video-wrapper">
            <div id="video-container">
                <video id="video-feed" autoplay></video>
                <canvas id="capture-canvas"></canvas>
                <div id="countdown-overlay"></div>
            </div>
        </div>

        <div class="controls">
            <select id="timer-select" class="timer-select">
                <option value="3">3 seconds</option>
                <option value="6">6 seconds</option>
                <option value="10">10 seconds</option>
            </select>

            <button class="shutter-button" id="shutter-btn">Take Photo</button>

            <input type="file" id="file-upload" accept="image/*" style="display: none;">
            <button class="shutter-button" id="upload-btn">Upload Photo</button>
        </div>

        <div class="filter-bar">
            <div class="filter-pill">
                <button class="filter-dot normal active" data-filter="normal" title="Normal"></button>
                <button class="filter-dot bw"     data-filter="bw"     title="Black & White"></button>
                <button class="filter-dot sepia"  data-filter="sepia"  title="Sepia"></button>
                <button class="filter-dot mirror" data-filter="mirror" title="Mirror toggle"></button>
            </div>
        </div>

        <div id="preview-strip"></div>
        <button id="next-btn">Next</button>
    </div>

    <script>
        const video            = document.getElementById('video-feed');
        const canvas           = document.getElementById('capture-canvas');
        const shutterBtn       = document.getElementById('shutter-btn');
        const uploadBtn        = document.getElementById('upload-btn');
        const fileUpload       = document.getElementById('file-upload');
        const previewStrip     = document.getElementById('preview-strip');
        const timerSelect      = document.getElementById('timer-select');
        const countdownOverlay = document.getElementById('countdown-overlay');
        const posesLeftEl      = document.getElementById('poses-left');
        const filterDots       = document.querySelectorAll('.filter-dot');
        const nextBtn          = document.getElementById('next-btn');
 

        const capturedPhotos = [];

        // Map covers every reasonable format the layout page might store:
        // letter (A/a), number (1/2/3/4), or word (layout-a / layoutA)
        const layoutPoseMap = {
            'A': 3, 'B': 2, 'C': 6, 'D': 4,
            'a': 3, 'b': 2, 'c': 6, 'd': 4,
            '1': 3, '2': 2, '3': 6, '4': 4,
        };

        // Read the raw value and also normalise it to A/B/C/D
        const rawLayout = sessionStorage.getItem('selectedLayout') || 'A';

        // Handle formats like 'layout-b', 'layoutB', 'Layout B', etc.
        function resolveLayout(raw) {
            // Strip non-alpha, uppercase, take first alpha char
            const letter = raw.replace(/[^a-zA-Z]/g, '').toUpperCase().charAt(0);
            return ['A','B','C','D'].includes(letter) ? letter : 'A';
        }

        let selectedLayout     = resolveLayout(rawLayout);
        let totalPoses         = layoutPoseMap[selectedLayout]; // always a number now
        let currentColorFilter = 'normal';
        let isMirrored         = false;



        function updatePosesLeftText() {
            posesLeftEl.textContent = `Poses: ${capturedPhotos.length} / ${totalPoses}`;
        }

        function checkCompletion() {
            if (capturedPhotos.length >= totalPoses) {
                shutterBtn.disabled    = true;
                uploadBtn.disabled     = true;
                shutterBtn.textContent = 'Done!';
                nextBtn.style.display  = 'block';
            }
        }

        function updateVideoStyles() {
            let filter = 'none';
            if (currentColorFilter === 'bw')    filter = 'grayscale(100%)';
            if (currentColorFilter === 'sepia') filter = 'sepia(100%)';
            video.style.filter    = filter;
            video.style.transform = isMirrored ? 'scaleX(-1)' : 'scaleX(1)';
        }

        async function startCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
            } catch (err) {
                console.error('Error accessing camera:', err);
            }
        }

        function updatePreview() {
            previewStrip.innerHTML = '';
            const layoutWrapper = document.createElement('div');
            layoutWrapper.className = `preview-layout layout-${selectedLayout}`;

            for (let i = 0; i < totalPoses; i++) {
                const slot = document.createElement('div');
                slot.className = 'preview-slot';
                if (capturedPhotos[i]) {
                    const img = document.createElement('img');
                    img.src = capturedPhotos[i];
                    slot.appendChild(img);
                } else {
                    slot.textContent = i + 1;
                }
                layoutWrapper.appendChild(slot);
            }
            previewStrip.appendChild(layoutWrapper);
        }

        function capturePhoto() {
            canvas.width  = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');

            if (isMirrored) {
                ctx.translate(canvas.width, 0);
                ctx.scale(-1, 1);
            }
            if (currentColorFilter === 'bw')    ctx.filter = 'grayscale(100%)';
            if (currentColorFilter === 'sepia') ctx.filter = 'sepia(100%)';

            ctx.drawImage(video, 0, 0);
            capturedPhotos.push(canvas.toDataURL('image/jpeg'));

            updatePreview();
            updatePosesLeftText();
            checkCompletion();

            if (capturedPhotos.length < totalPoses) {
                shutterBtn.disabled = false;
            }
        }

        shutterBtn.addEventListener('click', () => {
            let count = parseInt(timerSelect.value);
            shutterBtn.disabled = true;

            countdownOverlay.textContent   = count;
            countdownOverlay.style.opacity = 1;

            const timer = setInterval(() => {
                count--;
                if (count > 0) {
                    countdownOverlay.textContent = count;
                } else {
                    clearInterval(timer);
                    countdownOverlay.style.opacity = 0;
                    capturePhoto();
                }
            }, 1000);
        });

        uploadBtn.addEventListener('click', () => {
            if (capturedPhotos.length >= totalPoses) return;
            fileUpload.click();
        });

        fileUpload.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file || capturedPhotos.length >= totalPoses) return;

            const reader = new FileReader();
            reader.onload = (event) => {
                const img = new Image();
                img.onload = () => {
                    const oc   = document.createElement('canvas');
                    oc.width   = img.naturalWidth;
                    oc.height  = img.naturalHeight;
                    const octx = oc.getContext('2d');

                    if (isMirrored) {
                        octx.translate(oc.width, 0);
                        octx.scale(-1, 1);
                    }
                    if (currentColorFilter === 'bw')    octx.filter = 'grayscale(100%)';
                    if (currentColorFilter === 'sepia') octx.filter = 'sepia(100%)';

                    octx.drawImage(img, 0, 0);

                    capturedPhotos.push(oc.toDataURL('image/jpeg'));
                    updatePreview();
                    updatePosesLeftText();
                    checkCompletion();
                };
                img.src = event.target.result;
                fileUpload.value = '';
            };
            reader.readAsDataURL(file);
        });

        filterDots.forEach(dot => {
            dot.addEventListener('click', () => {
                const f = dot.dataset.filter;
                if (f === 'mirror') {
                    isMirrored = !isMirrored;
                    dot.classList.toggle('active', isMirrored);
                } else {
                    currentColorFilter = f;
                    filterDots.forEach(d => {
                        if (d.dataset.filter !== 'mirror') d.classList.remove('active');
                    });
                    dot.classList.add('active');
                }
                updateVideoStyles();
            });
        });

        nextBtn.addEventListener('click', () => {
            sessionStorage.setItem('capturedPhotos', JSON.stringify(capturedPhotos));
            sessionStorage.setItem('selectedFilter', currentColorFilter);
            sessionStorage.setItem('selectedLayout', selectedLayout);
            window.location.href = "{{ route('photobooth.sticker') }}";
        });

        startCamera();
        updatePreview();
        updatePosesLeftText();
    </script>

</body>
</html>