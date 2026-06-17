<head>

    <style>
        * {
            cursor: inherit;
        }

        body {
            cursor: url("{{ asset('assets/Images/cursor.png') }}"), auto;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ffffff 0%, #fdf2f5 50%, #f0e6fa 100%);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* MAIN CONTAINER (unchanged style, just refined spacing) */
        .container {
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
            width: 90%;
            max-width: 1000px;
            padding: 20px;
            background-color: #fcf8ff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            margin-top: 20px;
        }

        /* SECTION CARDS (same colors, just better structure) */
        .content-section {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .content-section:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        }

        .content-section h2 {
            font-size: 1.1em;
            color: #000000;
            margin-top: 0;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }

        .content-section p {
            font-size: 1em;
            line-height: 1.7;
            margin: 0 auto 15px;
            max-width: 800px;
        }

        /* LIST IMPROVEMENT (no color change) */
        .promise-list {
            text-align: left;
            margin: 20px auto 0;
            padding-left: 20px;
            max-width: 700px;
        }

        .promise-list li {
            list-style-type: none;
            position: relative;
            margin-bottom: 12px;
            padding-left: 22px;
            font-size: 0.95em;
        }

        .promise-list li:before {
            content: "—";
            color: #6b3e77;
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        /* subtle spacing improvement for readability */
        strong {
            font-weight: 700;
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
@auth
    @include('nav.HeaderAfterLogin')
@else
    @include('nav.nav')
@endauth

<div class="container">

    <div class="content-section">
        <h2>About The Digital Strip</h2>
        <p>
            Welcome to <strong>The Digital Strip</strong>! We're your go-to source for fun, spontaneous memories,
            completely free and online. We bring the classic arcade photobooth experience right to your browser.
            Use your device’s webcam to instantly capture moments and turn them into photostrips.
        </p>
    </div>

    <div class="content-section">
        <h2>What Is The Digital Strip?</h2>
        <p>
            Think of us as a digital version of a classic arcade booth, but right in your browser.
            Snap real-time photos using your webcam and generate instant photostrips.
        </p>
        <p>
            No downloads. No sign-ups required. Just open and start creating memories.
        </p>
    </div>

    <div class="content-section">
        <h2>Our Promise: Fun, Free, and Fast</h2>

        <ul class="promise-list">
            <li><strong>100% Free & Simple:</strong> Click, pose, and your strip is ready in seconds.</li>
            <li><strong>Quick Save:</strong> Download instantly without needing an account.</li>
            <li><strong>Account Option:</strong> Save your photostrips and revisit them anytime.</li>
        </ul>
    </div>

</div>

@include('nav.footer')

</body>
</html>