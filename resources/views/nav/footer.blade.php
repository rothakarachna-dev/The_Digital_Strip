<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photobooth Footer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* --- CREATIVE VIBE FOOTER --- */
        .site-footer {
            width: 100%;
            background-color: #FFAEC9;
            color: #ffffff;
            padding: 60px 20px 30px 20px;
            text-align: center; /* Center everything for a portfolio feel */
        }

        /* Main Branding / Catchphrase */
        .footer-brand h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .footer-brand p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        /* Simplified Nav - No "Columns" */
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            position: relative;
            padding-bottom: 5px;
        }

        /* Cute Underline Hover */
        .footer-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }

        .footer-links a:hover::after {
            width: 100%;
        }

        /* Minimal Newsletter */
        .footer-newsletter {
            max-width: 400px;
            margin: 0 auto 40px auto;
        }

        .input-group {
            display: flex;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px;
            border-radius: 50px; /* Pill shape */
            border: 2px solid white;
        }

        .input-group input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 10px 20px;
            color: white;
            outline: none;
        }

        .input-group input::placeholder { color: rgba(255, 255, 255, 0.7); }

        .input-group button {
            background: white;
            color: #FFAEC9;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .input-group button:hover {
            background: #fff0f3;
            transform: scale(1.05);
        }

        /* Bottom Details */
        .footer-bottom {
            font-size: 0.85rem;
            opacity: 0.7;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        @media (max-width: 600px) {
            .footer-links { gap: 15px; }
            .footer-brand h2 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

    <footer class="site-footer">
        <div class="footer-brand">
            <h2>The Digital Strip.</h2>
            <p>Ready for your first try? Let's make memories.</p>
        </div>

        <div class="footer-bottom">
            <p>Phnom Penh, Cambodia | h.rothakarachna@gmail.com</p>
            <p>&copy; 2026 The Digital Strip</p>
        </div>
    </footer>

</body>
</html>