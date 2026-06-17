<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { cursor: inherit; }

        :root {
            --pink-bg: #fdf2f5;
            --accent-pink: #ff4d8d;
            --text-main: #333;
            --text-light: #777;
        }

        body {
            cursor: url("{{ asset('assets/Images/cursor.png') }}") 0 0, auto;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            min-height: 100vh;

            background: linear-gradient(135deg, #ffffff 0%, #fdf2f5 50%, #f0e6fa 100%);
            position: relative;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.25;
            z-index: -1;
            animation: float 10s ease-in-out infinite;
        }

        body::before {
            background: #ff4d8d;
            top: 10%;
            left: 10%;
        }

        body::after {
            background: #c084fc;
            bottom: 10%;
            right: 10%;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-25px); }
        }

        main {
            text-align: center;
            padding: 60px 20px;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 34px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .subtitle {
            font-style: italic;
            color: var(--text-light);
            margin-bottom: 40px;
        }

        .viewer-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
        }

        .arrow {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s ease;
            font-size: 18px;
            font-weight: bold;
            color: var(--accent-pink);
        }

        .arrow:hover {
            transform: scale(1.1);
            background: #ffe4ee;
        }

        .strip-wrapper {
            background: white;
            padding: 18px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .strip-wrapper:hover {
            transform: translateY(-3px);
        }

        #saved-strip-img {
            max-width: 320px;
            width: 100%;
            border-radius: 12px;
            display: block;
        }
    </style>
</head>

<body>

{{-- NAVBAR (Laravel way) --}}
@if(auth()->check())
   @include('nav.HeaderAfterLogin')
@else
    @include('nav.nav')
@endif

<main>
    <h1>Your Photo</h1>
    <p id="strip-message" class="subtitle"></p>

    <div class="viewer-row">
        <button class="arrow" onclick="changePhoto(-1)">&lt;</button>

        <div class="strip-wrapper">
            <img id="saved-strip-img" alt="Your photo strip">
        </div>

        <button class="arrow" onclick="changePhoto(1)">&gt;</button>
    </div>
</main>

@include('nav.footer')

<script>
  let savedStrips = JSON.parse(sessionStorage.getItem('savedStrips') || "[]");

  const single = sessionStorage.getItem('savedStrip');
  if (savedStrips.length === 0 && single) {
      savedStrips = [single];
  }

  let currentIndex = savedStrips.length - 1;

  const img = document.getElementById('saved-strip-img');
  const msg = document.getElementById('strip-message');

  function updateView() {
    if (savedStrips.length > 0) {
      img.src = savedStrips[currentIndex];
      img.style.display = 'block';
      msg.textContent = `Photo ${currentIndex + 1} of ${savedStrips.length}`;
    } else {
      img.style.display = 'none';
      msg.textContent = "No saved strips found.";
    }
  }

  function changePhoto(step) {
    let newIndex = currentIndex + step;

    if (newIndex >= 0 && newIndex < savedStrips.length) {
        currentIndex = newIndex;
        updateView();
    }
  }

  updateView();
</script>

</body>
</html>