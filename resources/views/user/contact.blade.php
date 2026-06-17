<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        *, *::before, *::after { cursor: inherit; }

        body {
            cursor: url("{{ asset('assets/Images/cursor.png') }}") 0 0, auto;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(135deg, #ffffff 0%, #fdf2f5 50%, #f0e6fa 100%);
            position: relative;
            overflow-x: hidden;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            padding: 20px;
            background-color: #f0e6fa;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin: 20px 0;
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contact-box {
            display: flex;
            gap: 40px;
            padding: 40px;
            background-color: white;
            border-radius: 15px;
            width: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .info-section {
            flex: 1;
            max-width: 45%;
        }

        .info-section h1 {
            font-size: 2.5em;
            color: #e91e63;
            margin-bottom: 20px;
        }

        .info-section p {
            font-size: 1em;
            line-height: 1.6;
            color: #666;
        }

        .contact-form {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            resize: none;
            min-height: 220px;
        }

        textarea:focus {
            border-color: #e91e63;
        }

        textarea:disabled {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        .submit-btn {
            padding: 12px 40px;
            background-color: #fff;
            color: #e91e63;
            border: 2px solid #e91e63;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background-color: #e91e63;
            color: #fff;
            transform: translateY(-2px);
        }

        .disabled-btn {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .disabled-btn:hover {
            background-color: #fff;
            color: #e91e63;
            transform: none;
        }

        .login-warning {
            margin-top: 12px;
            color: #e91e63;
            font-size: 14px;
        }

        .login-warning a {
            color: #e91e63;
            font-weight: bold;
            text-decoration: none;
        }

        .login-warning a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
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

    <div class="contact-box">

        <div class="info-section">
            <h1>Contact Us</h1>

            <p>
                We love hearing from you! Send us feedback, questions, or suggestions anytime.
            </p>

            @guest
                <div class="alert alert-error">
                    You need to sign up or login first before sending a message.
                </div>
            @endguest

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif
        </div>

        <form class="contact-form" method="POST" action="{{ route('contact.store') }}">
            @csrf

            <div class="form-group">
                <label>Message</label>

                <textarea
                    name="message"
                    placeholder="Type your message..."
                    @guest disabled @endguest
                    required
                ></textarea>
            </div>

            @auth
                <button type="submit" class="submit-btn">
                    Submit
                </button>
            @else
                <button
                    type="button"
                    class="submit-btn disabled-btn"
                    onclick="alert('You need to sign up or login first.')"
                >
                    Send
                </button>

                <p class="login-warning">
                    Please
                    <a href="{{ route('login') }}">Login</a>
                    or
                    <a href="{{ route('signup') }}">Sign Up</a>
                    to send a message.
                </p>
            @endauth

        </form>

    </div>

</div>

@include('nav.footer')

</body>
</html>