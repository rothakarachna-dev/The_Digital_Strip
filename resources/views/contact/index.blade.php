<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Digital Strip - Home</title>

    <style>
        /* Custom cursor and global resets */
        *, *::before, *::after { cursor: inherit; }

        body {
            cursor: url("{{ asset('assets/Images/cursor.png') }}") 0 0, auto;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #fdf2f5 50%, #f0e6fa 100%);
        }

        input::-ms-reveal, input::-ms-clear { display: none; }

        /* Layout Sections */
        .title-section { text-align: center; margin-top: 50px; }

        .title-section h1 {
            font-size: 60px;
            font-style: italic;
            font-family: Georgia, serif;
            margin-bottom: 40px;
        }

        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            gap: 60px;
        }

        /* Sidebar Content */
        .left-side, .right-side {
            width: 20%;
            text-align: center;
            padding: 10px;
        }

        .left-side h2, .right-side h2 {
            font-size: 28px;
            font-weight: 700;
            color: #193e5c;
            margin-bottom: 10px;
        }

        .side-img {
            width: 100%;
            margin-top: 40px;
        }

        .small {
            width: 70%;
            margin-top: 10px;
        }

        /* Photobooth Machine Center */
        .center {
            width: 30%;
            position: relative;
        }

        .photobooth-container {
            position: relative;
            width: 100%;
        }

        .photobooth {
            width: 100%;
            display: block;
        }

        .photostrip {
            position: absolute;
            top: 70%;
            left: 22%;
            transform: translateX(-50%);
            width: 10%;
            transition: 0.3s;
        }

        .photostrip:hover {
            transform: translateX(-50%) scale(1.5);
        }

        .start-btn {
            position: absolute;
            top: 55%;
            left: 60%;
            transform: translate(-50%, -50%);
            background: transparent;
            border: none;
            color: #fafafa;
            font-size: 4vw;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .start-btn:hover {
            transform: translate(-50%, -50%) scale(1.3);
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    @auth
        @include('nav.HeaderAfterLogin')
    @else
        @include('nav.nav')
    @endauth

    <section class="title-section">
        <h1>The Digital Strip</h1>

        <div class="content-container">

            <div class="left-side">
                <h2>Strike a pose</h2>
                <img src="{{ asset('assets/Images/friend posing.webp') }}" class="side-img">
                <img src="{{ asset('assets/Images/posing 2.webp') }}" class="side-img small">
            </div>

            <div class="center">
                <div class="photobooth-container">
                    <img src="{{ asset('assets/Images/photo booth machine.webp') }}" class="photobooth">
                    <img src="{{ asset('assets/Images/photo strip.png') }}" class="photostrip">
                </div>

                <button 
                    id="start-btn" 
                    class="start-btn" 
                    data-is-logged-in="{{ auth()->check() ? 'true' : 'false' }}">
                    Start!
                </button>
            </div>

            <div class="right-side">
                <h2>Get your<br>photos<br>instantly!</h2>
                <img src="{{ asset('assets/Images/posing.webp') }}" class="side-img">
            </div>

        </div>
    </section>

    {{-- Footer location based on your structure in nav/ --}}
    @include('nav.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const startBtn = document.getElementById('start-btn');
            if (!startBtn) return;

            startBtn.addEventListener('click', () => {
                // Reading from the data attribute is cleaner and more reliable
                const isLoggedIn = startBtn.getAttribute('data-is-logged-in') === 'true';

                if (!isLoggedIn) {
                    // Redirecting to login for a smoother user experience
                    window.location.href = "{{ url('/login') }}";
                    return;
                }

                // Path to your layout page
                window.location.href = "{{ url('/layout') }}";

            });

        });
    </script>

</body>
</html>