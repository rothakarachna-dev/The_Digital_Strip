<head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
:root {
  --primary-pink: #F875AA;
  --soft-pink: #FFCDC9;
  --bg-gradient: radial-gradient(circle, #fff0f3 0%, #ffe4e9 100%);
}

body {
  cursor: url("{{ asset('assets/Images/cursor.png') }}"), auto;
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: var(--bg-gradient);
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
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

.signup-box {
  width: 430px;
  padding: 40px;
  background: var(--soft-pink);
  border-radius: 25px;
  text-align: center;
}

h2 {
  color: var(--primary-pink);
}

label {
  display: block;
  text-align: left;
  font-weight: 600;
  margin-bottom: 6px;
}

input {
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

.password-wrapper input {
  padding-right: 42px;
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
  color: var(--primary-pink);
}

.signup-btn {
  width: 100%;
  padding: 14px;
  background: var(--primary-pink);
  color: white;
  border: none;
  border-radius: 50px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.signup-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(248,117,170,0.3);
}

/* ERROR BOX */
.error-box {
  color: #d00000;
  font-size: 13px;
  text-align: left;
  margin-bottom: 15px;
  background: rgba(255,0,0,0.05);
  padding: 10px;
  border-radius: 10px;
}
</style>
</head>

<body>

<a href="{{ url('/') }}" class="back-to-home">← Back</a>

<div class="signup-box">

<h2>Sign Up</h2>

<!-- ERRORS -->
@if ($errors->any())
    <div class="error-box">
        <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/signup" enctype="multipart/form-data">
@csrf

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<div class="password-wrapper">
  <input id="password" type="password" name="password" minlength="8" required>
  <i id="togglePassword" class="bi bi-eye-slash toggle-password-icon"></i>
</div>

<label>Confirm Password</label>
<div class="password-wrapper">
  <input id="password_confirmation" type="password" name="password_confirmation" minlength="8" required>
  <i id="toggleConfirmPassword" class="bi bi-eye-slash toggle-password-icon"></i>
</div>

<label>Profile Image</label>
<input type="file" name="profile_image">

<button type="submit" class="signup-btn">Sign Up</button>

</form>

</div>

<script>
function toggle(inputId, iconId) {
  const input = document.getElementById(inputId);
  const icon = document.getElementById(iconId);

  icon.addEventListener('click', () => {
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';

    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
  });
}

toggle('password', 'togglePassword');
toggle('password_confirmation', 'toggleConfirmPassword');
</script>

</body>
</html>