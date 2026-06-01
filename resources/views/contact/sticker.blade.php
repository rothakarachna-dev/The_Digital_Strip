<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Customize</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", sans-serif;
        }

        *, *::before, *::after {
            cursor: inherit;
        }

        body {
            cursor: url("/images/cursor.png"), auto;
            margin: 0;
            background: radial-gradient(circle at center, #ffe1e8, #fff6f9);
        }

        .container {
            display: flex;
            gap: 40px;
            padding: 40px 60px;
        }

        h2.page-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
            width: 75%;
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--deep-pink);
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(248, 117, 170, 0.3);
            text-transform: capitalize;
        }

        .preview {
            width: 250px;
            background: #ffffff;
            padding: 15px 15px 40px 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .preview-layout-container {
            width: 100%;
        }

        .preview-slot {
            background: #333;
            width: 100%;
            border-radius: 2px;
            overflow: hidden;
        }

        .preview-layout.layout-A {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .layout-A .preview-slot { height: 140px; }

        .preview-layout.layout-B {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .layout-B .preview-slot { height: 210px; }

        .preview-layout.layout-C {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }
        .layout-C .preview-slot { height: 100px; }

        .preview-layout.layout-D {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .layout-D .preview-slot {
            aspect-ratio: 1 / 1;
            height: auto;
        }

        .preview-footer {
            position: absolute;
            bottom: 12px;
            font-size: 13px;
            font-weight: bold;
            color: #F875AA;
            text-align: center;
            width: 100%;
            letter-spacing: 0.5px;
            margin-top: 15px;
        }

        .preview-slot img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .filter-bw img   { filter: grayscale(100%); }
        .filter-sepia img { filter: sepia(100%); }

        .preview-slot.square {
            border-radius: 12px;
            clip-path: none;
        }

        .preview-slot.circle {
            border-radius: 50%;
            overflow: hidden;
        }

        .preview-slot.heart {
            border-radius: 0;
            clip-path: polygon(
                50% 92%, 20% 70%, 8% 55%, 4% 40%, 4% 30%,
                8% 22%, 15% 16%, 24% 12%, 33% 12%, 40% 15%,
                50% 22%, 60% 15%, 67% 12%, 76% 12%, 85% 16%,
                92% 22%, 96% 30%, 96% 40%, 92% 55%, 80% 70%
            );
            overflow: hidden;
        }

        .preview-slot.star {
            border-radius: 0;
            clip-path: polygon(50% 0%, 79% 91%, 2% 35%, 98% 35%, 21% 91%);
            overflow: hidden;
        }

        .preview-meta {
            font-size: 11px;
            text-align: center;
            margin-top: 4px;
        }

        .right-side {
            flex: 1;
        }

        .page-title {
            text-align: center;
            font-weight: 500;
            margin: 0 0 30px 0;
        }

        .panel { width: 100%; }

        .section { margin-bottom: 25px; }

        .section h3 {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .palette {
            display: grid;
            grid-template-columns: repeat(auto-fill, 34px);
            gap: 10px;
        }

        .color {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid #ddd;
            cursor: inherit;
        }

        .color:nth-child(1) { background: #ff5a7a; }
        .color:nth-child(2) { background: #ffd1dc; }
        .color:nth-child(3) { background: #c8f4f9; }
        .color:nth-child(4) { background: #fff3a0; }
        .color:nth-child(5) { background: #8bc34a; }
        .color:nth-child(6) { background: #caa6ff; }
        .color:nth-child(7) { background: #000; }
        .color:nth-child(8) { background: #fff; }

        .color.selected { outline: 3px solid #ff6a88; }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            max-height: 250px;
            overflow-y: auto;
            padding: 5px;
        }

        .item {
            width: 50px;
            height: 50px;
            background: #ffffffa6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: inherit;
        }

        .item.sticker-btn { cursor: inherit; }

        .preview-sticker {
            position: absolute;
            width: 60px;
            height: 60px;
            cursor: move;
            box-sizing: border-box;
            transform-origin: center center;
        }

        .preview-sticker img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            pointer-events: none;
        }

        .sticker-resize {
            position: absolute;
            width: 14px;
            height: 14px;
            right: -7px;
            bottom: -7px;
            background: #ff6a88;
            border-radius: 50%;
            border: 2px solid #fff;
            cursor: se-resize;
            box-shadow: 0 0 4px rgba(0,0,0,0.4);
        }

        .sticker-rotate {
            position: absolute;
            width: 14px;
            height: 14px;
            top: -24px;
            left: 50%;
            transform: translateX(-50%);
            background: #6b3e77;
            border-radius: 50%;
            border: 2px solid #fff;
            cursor: grab;
            box-shadow: 0 0 4px rgba(0,0,0,0.4);
        }

        .sticker-rotate::before {
            content: '';
            position: absolute;
            width: 2px;
            height: 18px;
            bottom: -18px;
            left: 50%;
            transform: translateX(-50%);
            background: #6b3e77;
        }

        .preview-sticker.active { outline: 2px dashed #ff6a88; }

        .options {
            margin-top: 15px;
            display: flex;
            gap: 25px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 18px;
            padding: 40px 0 60px;
        }

        .action-btn {
            padding: 14px 36px;
            border-radius: 30px;
            border: 2px solid #ff8fa6;
            background: #ffc1d1;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: inherit;
            transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
        }

        .action-btn:hover {
            background: #ff6a88;
            border-color: #ff6a88;
            color: #ffffff;
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

    <!-- MAIN -->
    <div class="container">

        <!-- Preview strip -->
        <div class="preview" id="preview-strip">
            <div class="preview-layout-container"></div>
            <div class="preview-footer">♥ The Digital Strip ♥</div>
            <div class="preview-meta" id="preview-meta"></div>
        </div>

        <!-- Right side: title + controls -->
        <div class="right-side">
            <h2 class="page-title">Customize your Photo</h2>

            <div class="panel">

                <div class="section">
                    <h3>Frame Color</h3>
                    <div class="palette" id="frame-palette">
                        <div class="color selected" data-color="#ff5a7a"></div>
                        <div class="color" data-color="#ffd1dc"></div>
                        <div class="color" data-color="#c8f4f9"></div>
                        <div class="color" data-color="#fff3a0"></div>
                        <div class="color" data-color="#8bc34a"></div>
                        <div class="color" data-color="#caa6ff"></div>
                        <div class="color" data-color="#000000"></div>
                        <div class="color" data-color="#ffffff"></div>
                    </div>
                </div>

                <div class="section">
                    <h3>Photo Shape</h3>
                    <div class="grid" id="shape-grid">
                        <div class="item shape-btn selected" data-shape="square">◻️</div>
                        <div class="item shape-btn" data-shape="circle">⭕</div>
                        <div class="item shape-btn" data-shape="heart">❤️</div>
                        <div class="item shape-btn" data-shape="star">⭐</div>
                    </div>
                </div>

                <div class="section">
                    <h3>Stickers</h3>
                    <div class="grid">
                        @forelse ($stickers as $sticker)
                            <div class="item sticker-btn" data-sticker-img="{{ asset($sticker->image_path) }}">
                                <img src="{{ asset($sticker->image_path) }}" alt="sticker" style="width:100%; height:100%; object-fit:contain;">
                            </div>
                        @empty
                            <p style="font-size: 12px; color: #777;">No stickers uploaded.</p>
                        @endforelse
                    </div>
                </div>

                <div class="options">
                    <label><input type="checkbox" id="add-date"> Add Date</label>
                    <label><input type="checkbox" id="add-time"> Add Time</label>
                </div>

            </div>
        </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="actions">
        <button class="action-btn" id="retake-btn">Retake</button>
        <button class="action-btn" id="save-strip">Save</button>
        <button class="action-btn" id="download-strip">Download</button>
    </div>

    <script>
        const previewStrip    = document.getElementById('preview-strip');
        const previewMeta     = document.getElementById('preview-meta');
        const layoutContainer = previewStrip.querySelector('.preview-layout-container');
        const footerText      = previewStrip.querySelector('.preview-footer');

        const storedPhotos = sessionStorage.getItem('capturedPhotos');
        const storedFilter = sessionStorage.getItem('selectedFilter') || 'normal';

        let photos = [];
        if (storedPhotos) {
            try { photos = JSON.parse(storedPhotos); }
            catch (e) { console.error('Error parsing capturedPhotos', e); }
        }

        // --- BUILD LAYOUT ---
        layoutContainer.innerHTML = '';
        const layoutWrapper = document.createElement('div');
        const currentLayout = (sessionStorage.getItem('selectedLayout') || 'A').toUpperCase();
        layoutWrapper.className = `preview-layout layout-${currentLayout} filter-${storedFilter}`;
        layoutContainer.appendChild(layoutWrapper);

        const layoutMap = { 'A': 3, 'B': 2, 'C': 6, 'D': 4 };
        let slotsCount = layoutMap[currentLayout] || 3;

        for (let i = 0; i < slotsCount; i++) {
            const slot = document.createElement('div');
            slot.className = 'preview-slot square';
            if (photos[i]) {
                const img = document.createElement('img');
                img.src = photos[i];
                slot.appendChild(img);
            } else {
                slot.innerHTML = '<span style="color:#666; font-size:10px;">Empty</span>';
            }
            layoutWrapper.appendChild(slot);
        }

        // === Frame Color ===
        const colorButtons = document.querySelectorAll('#frame-palette .color');
        colorButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const color = btn.getAttribute('data-color');
                previewStrip.style.backgroundColor = color;
                if (color === "#000000") {
                    footerText.style.color = "#ffffff";
                    if (previewMeta) previewMeta.style.color = "#ffffff";
                } else {
                    footerText.style.color = "#F875AA";
                    if (previewMeta) previewMeta.style.color = "#F875AA";
                }
                colorButtons.forEach(b => b.classList.remove('selected'));
                btn.classList.add('selected');
            });
        });

        // === Date & Time ===
        const dateCheckbox = document.getElementById('add-date');
        const timeCheckbox = document.getElementById('add-time');

        function updatePreviewMeta() {
            const now = new Date();
            let parts = [];
            if (dateCheckbox && dateCheckbox.checked) parts.push(now.toLocaleDateString());
            if (timeCheckbox && timeCheckbox.checked) parts.push(now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));
            previewMeta.textContent = parts.join(' • ');
        }

        if (dateCheckbox) dateCheckbox.addEventListener('change', updatePreviewMeta);
        if (timeCheckbox) timeCheckbox.addEventListener('change', updatePreviewMeta);

        // === Photo Shape ===
        const shapeButtons = document.querySelectorAll('.shape-btn');
        function applyShape(shape) {
            document.querySelectorAll('.preview-slot').forEach(slot => {
                slot.classList.remove('square', 'circle', 'heart', 'star');
                slot.classList.add(shape);
            });
        }

        shapeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const shape = btn.getAttribute('data-shape');
                shapeButtons.forEach(b => b.classList.remove('selected'));
                btn.classList.add('selected');
                applyShape(shape);
            });
        });

        // ====== STICKERS ======
        const stickerButtons = document.querySelectorAll('.sticker-btn');
        const strip = document.getElementById('preview-strip');

        let dragTarget = null, resizeTarget = null, rotateTarget = null, activeSticker = null;
        let dragOffsetX = 0, dragOffsetY = 0, startWidth = 0, startHeight = 0;
        let startMouseX = 0, startMouseY = 0, rotateStartX = 0, rotateStartY = 0;

        function addStickerImage(src) {
            const sticker = document.createElement('div');
            sticker.className = 'preview-sticker';
            sticker.dataset.angle = '0';
            sticker.innerHTML = `<img src="${src}"><div class="sticker-resize"></div><div class="sticker-rotate"></div>`;
            sticker.style.width  = '60px';
            sticker.style.height = '60px';
            sticker.style.left   = '50px';
            sticker.style.top    = '50px';

            sticker.addEventListener('mousedown', (e) => {
                if (e.target.classList.contains('sticker-resize') || e.target.classList.contains('sticker-rotate')) return;
                e.preventDefault();
                dragTarget = sticker;
                const sRect = sticker.getBoundingClientRect();
                dragOffsetX = e.clientX - sRect.left;
                dragOffsetY = e.clientY - sRect.top;
                setActiveSticker(sticker);
            });

            sticker.querySelector('.sticker-resize').addEventListener('mousedown', (e) => {
                e.stopPropagation(); e.preventDefault();
                resizeTarget = sticker;
                startWidth  = sticker.offsetWidth;
                startHeight = sticker.offsetHeight;
                startMouseX = e.clientX;
                startMouseY = e.clientY;
                setActiveSticker(sticker);
            });

            sticker.querySelector('.sticker-rotate').addEventListener('mousedown', (e) => {
                e.stopPropagation(); e.preventDefault();
                rotateTarget = sticker;
                const sRect = sticker.getBoundingClientRect();
                rotateStartX = sRect.left + sRect.width / 2;
                rotateStartY = sRect.top  + sRect.height / 2;
                setActiveSticker(sticker);
            });

            strip.appendChild(sticker);
            setActiveSticker(sticker);
        }

        function setActiveSticker(sticker) {
            document.querySelectorAll('.preview-sticker').forEach(s => s.classList.remove('active'));
            activeSticker = sticker;
            if (sticker) sticker.classList.add('active');
        }

        function setStickerHandlesVisible(visible) {
            document.querySelectorAll('.sticker-resize, .sticker-rotate').forEach(h => {
                h.style.display = visible ? '' : 'none';
            });
            if (!visible && activeSticker) activeSticker.classList.remove('active');
            if (visible  && activeSticker) activeSticker.classList.add('active');
        }

        stickerButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const src = btn.getAttribute('data-sticker-img');
                if (src) addStickerImage(src);
            });
        });

        document.addEventListener('mousemove', (e) => {
            const stripRect = strip.getBoundingClientRect();
            if (dragTarget) {
                dragTarget.style.left = (e.clientX - stripRect.left - dragOffsetX) + 'px';
                dragTarget.style.top  = (e.clientY - stripRect.top  - dragOffsetY) + 'px';
            }
            if (resizeTarget) {
                let newSize = Math.max(20, startWidth + (e.clientX - startMouseX));
                resizeTarget.style.width  = newSize + 'px';
                resizeTarget.style.height = newSize + 'px';
            }
            if (rotateTarget) {
                const dx = e.clientX - rotateStartX;
                const dy = e.clientY - rotateStartY;
                const finalAngle = Math.atan2(dy, dx) * (180 / Math.PI) + 90;
                rotateTarget.style.transform = `rotate(${finalAngle}deg)`;
            }
        });

        document.addEventListener('mouseup', () => { dragTarget = null; resizeTarget = null; rotateTarget = null; });

        document.addEventListener('keydown', (e) => {
            if (activeSticker && (e.key === 'Backspace' || e.key === 'Delete')) {
                e.preventDefault();
                activeSticker.remove();
                activeSticker = null;
            }
        });

        // === Export / Navigation ===
        const exportAction = (isDownload) => {
            setStickerHandlesVisible(false);
            html2canvas(previewStrip, { scale: 2 }).then(canvas => {
                const dataUrl = canvas.toDataURL('image/png');
                if (isDownload) {
                    const link = document.createElement('a');
                    link.href     = dataUrl;
                    link.download = 'photostrip.png';
                    link.click();
                } else {
                    let savedStrips = JSON.parse(sessionStorage.getItem('savedStrips') || "[]");
                    savedStrips.push(dataUrl);
                    sessionStorage.setItem('savedStrips', JSON.stringify(savedStrips));
                    sessionStorage.setItem('savedStrip', dataUrl);
                    window.location.assign("{{ route('photobooth.photo') }}");
                }
                setStickerHandlesVisible(true);
            });
        };

        document.getElementById('save-strip').addEventListener('click',     () => exportAction(false));
        document.getElementById('download-strip').addEventListener('click', () => exportAction(true));
        document.getElementById('retake-btn').addEventListener('click',     () => window.history.back());
    </script>

</body>
</html>