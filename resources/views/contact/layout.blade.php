<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Digital Strip - Layout</title>

    <style>
        *, *::before, *::after {
            cursor: url('assets/images/cursor.png') 0 0, auto;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: rgba(255, 218, 235, 0.7);
            color: #444;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 95%;
            max-width: 1100px;
            margin: 40px auto;
            padding: 40px;
            background: rgba(255, 235, 245, 0.7); 
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .main-heading {
            font-size: 3rem;
            font-weight: 800;
            color: #F875AA;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .sub-heading {
            color: #888;
            margin-bottom: 50px;
            font-size: 1.1rem;
        }

        .layout-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            padding: 10px;
        }

        .layout-option {
            background: #fff;
            padding: 25px 15px;
            border-radius: 20px;
            border: 2px solid transparent;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .layout-option:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(248, 117, 170, 0.2);
            border-color: #F875AA;
        }

        .strip-visual {
            background: #ffffff;
            width: 120px;
            height: 280px;
            margin: 0 auto 20px;
            display: flex;
            flex-direction: column;
            padding: 10px 8px 30px 8px;
            border-radius: 2px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
            position: relative;
        }

        .strip-visual::after {
            content: "♥ The Digital Strip ♥";
            position: absolute;
            bottom: 8px;
            left: 0;
            width: 100%;
            font-size: 7px;
            color: #fe87e8;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .strip-frame {
            background-color: #333;
            width: 100%;
            border-radius: 1px;
        }

        .layout-a .strip-visual { justify-content: space-between; }
        .layout-a .strip-frame  { height: 75px; }

        .layout-b .strip-visual { justify-content: space-around; }
        .layout-b .strip-frame  { height: 115px; }

        .layout-c .strip-visual {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: repeat(3, 1fr);
            gap: 5px;
        }
        .layout-c .strip-frame { height: 75px; }

        .layout-d .strip-visual {
            background: #ffffff;
            width: 200px;
            height: 200px;
            margin: 0 auto 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 8px;
            padding: 15px 10px 40px 10px;
            border-radius: 2px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            position: relative;
            align-content: center;
        }

        .layout-d .strip-frame {
            background-color: #333;
            width: 100%;
            aspect-ratio: 1 / 1;
            height: auto;
            margin: 0;
            border-radius: 1px;
        }

        .layout-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 4px;
        }

        .layout-details {
            font-size: 0.85rem;
            color: #aaa;
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
        <h1 class="main-heading">Photo Layout</h1>
        <p class="sub-heading">Select your favorite style for the photoshoot</p>

        <div class="layout-grid">

            <div class="layout-option layout-a" onclick="chooseLayout('A')">
                <div class="strip-visual">
                    <div class="strip-frame"></div>
                    <div class="strip-frame"></div>
                    <div class="strip-frame"></div>
                </div>
                <div class="layout-name">Classic Trio</div>
                <div class="layout-details">3 Vertical Poses</div>
            </div>

            <div class="layout-option layout-b" onclick="chooseLayout('B')">
                <div class="strip-visual">
                    <div class="strip-frame"></div>
                    <div class="strip-frame"></div>
                </div>
                <div class="layout-name">Double Focus</div>
                <div class="layout-details">2 Large Frames</div>
            </div>

            <div class="layout-option layout-c" onclick="chooseLayout('C')">
                <div class="strip-visual">
                    <div class="strip-frame"></div><div class="strip-frame"></div>
                    <div class="strip-frame"></div><div class="strip-frame"></div>
                    <div class="strip-frame"></div><div class="strip-frame"></div>
                </div>
                <div class="layout-name">Party Strip</div>
                <div class="layout-details">6 Mini Frames</div>
            </div>

            <div class="layout-option layout-d" onclick="chooseLayout('D')">
                <div class="strip-visual">
                    <div class="strip-frame"></div>
                    <div class="strip-frame"></div>
                    <div class="strip-frame"></div>
                    <div class="strip-frame"></div>
                </div>
                <div class="layout-name">Quad Grid</div>
                <div class="layout-details">4 Square Poses</div>
            </div>

        </div>
    </div>

    <script>
        function chooseLayout(layoutCode) {
            sessionStorage.setItem('selectedLayout', layoutCode);
            window.location.href = "{{ route('photobooth.camera') }}";
        }
    </script>

</body>
</html>