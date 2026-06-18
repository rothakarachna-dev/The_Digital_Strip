<head>
  <!-- Bootstrap Icons (ADD THIS) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root {
      --primary-pink: #F875AA;
      --soft-pink: #FFCDC9;
      --deep-pink: #DA0C81;
      --bg-gradient: radial-gradient(circle, #fff0f3 0%, #ffe4e9 100%);
    }

    body {
      cursor: url("{{ asset('assets/Images/cursor.png') }}") 0 0, auto;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--bg-gradient);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
    }

    input::-ms-reveal,
    input::-ms-clear {
      display: none;
    }

    .back-to-home {
      position: absolute;
      top: 30px;
      left: 30px;
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: var(--primary-pink);
      font-weight: 600;
      font-size: 14px;
      background: rgba(255, 255, 255, 0.8);
      padding: 12px 20px;
      border-radius: 50px;
    }

    .login-box {
      width: 400px;
      padding: 40px;
      border-radius: 25px;
      background: var(--soft-pink);
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      text-align: center;
    }

    .login-box h2 {
      margin-bottom: 25px;
      font-size: 32px;
      color: var(--primary-pink);
    }

    label {
      display: block;
      text-align: left;
      margin-bottom: 6px;
      font-size: 14px;
      font-weight: 600;
      color: #555;
    }

    input, select {
      width: 100%;
      padding: 12px;
      border-radius: 12px;
      border: 2px solid white;
      margin-bottom: 12px;
      box-sizing: border-box;
      outline: none;    
    }

    .password-wrapper {
      position: relative;
    }

    .toggle-password-icon {
      position: absolute;
      right: 12px;
      top: 40%;
      transform: translateY(-50%);
      font-size: 18px;
      cursor: pointer;
      color: #777;
    }

    .toggle-password-icon:hover {
      color: var(--deep-pink);
    }
    .google-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    margin-top: 30px;
    margin-bottom: 15px;
    padding: 14px;
    border-radius: 50px;
    border: 1px solid #dadce0;
    background: white;
    color: #3c4043;
    font-weight: bold;
    text-decoration: none;
    box-sizing: border-box;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .google-btn:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    border-color: #c6c6c6;
  }

  .google-btn:active {
    transform: translateY(0px) scale(0.98);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  }


    .login-btn {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 50px;
      background: var(--primary-pink);
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .login-btn:hover {
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 10px 25px rgba(255, 105, 180, 0.4);
      filter: brightness(1.1);
    }

    .login-btn:active {
      transform: translateY(0px) scale(0.98);
      box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
    }

        .error {
          background: #fff;
          color: #b00020;
          padding: 10px;
          border-radius: 10px;
          margin-bottom: 20px;
          border-left: 4px solid #b00020;
          text-align: left;
        }
  </style>
</head>

<body>

  <a href="{{ url('/') }}" class="back-to-home">← Back</a>

  <div class="login-box">
    <h2>Log In</h2>

    @if($errors->any())
      <div class="error">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
      @csrf

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <div class="password-wrapper">
        <input id="password" type="password" name="password" required>
        <i id="togglePassword" class="bi bi-eye-slash toggle-password-icon"></i>
      </div>

      <a href="{{ route('google.login') }}" class="google-btn">
        <img src="{{ asset('assets/Images/google.webp') }}" width="18">
        Log in with Google
      </a>

      <button type="submit" class="login-btn">Log In</button>
    </form>
  </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('password');
  const icon  = document.getElementById('togglePassword');

  if (!input || !icon) return;

  icon.addEventListener('click', () => {
    const isHidden = input.type === 'password';

    input.type = isHidden ? 'text' : 'password';

    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
  });
});
</script>

</body>
</html>