<style>
    :root {
        --primary-pink: #F875AA;
        --secondary-pink: #FEC1D5;
        --bg-soft-pink: #FFF5F8;
        --white: #ffffff;
        --text-gray: #4A4A4A;
        --success-green: #4CAF50;
        --error-red: #f44336;
    }

    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--bg-soft-pink);
        color: var(--text-gray);
    }

    .settings-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .settings-card {
        background: var(--white);
        width: 100%;
        max-width: 400px;
        padding: 40px;
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(248, 117, 170, 0.15);
        text-align: center;
    }

    .settings-card h2 {
        color: var(--primary-pink);
        margin-bottom: 30px;
        font-size: 26px;
    }

    .profile-pic-wrapper {
        position: relative;
        width: 130px;
        height: 130px;
        margin: 0 auto 30px auto;
    }

    .profile-pic-wrapper img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--secondary-pink);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        background-color: #fff;
        display: block;
    }

    .upload-label {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--primary-pink);
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        border: 3px solid white;
        cursor: pointer;
        transition: 0.3s;
    }

    .upload-label:hover {
        transform: scale(1.1);
    }

    #profile_image {
        display: none;
    }

    .form-group {
        text-align: left;
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--primary-pink);
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--secondary-pink);
        border-radius: 15px;
        outline: none;
        box-sizing: border-box;
        transition: 0.3s;
    }

    .form-group input:focus {
        border-color: var(--primary-pink);
    }

    .btn-save {
        background-color: var(--primary-pink);
        color: white;
        border: none;
        width: 100%;
        padding: 14px;
        border-radius: 15px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-save:hover {
        opacity: 0.9;
    }

    .back-link {
        display: block;
        margin-top: 20px;
        color: #999;
        text-decoration: none;
        font-size: 14px;
    }

    .back-link:hover {
        color: var(--primary-pink);
    }

    .alert {
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .success {
        background: #e8f5e9;
        color: var(--success-green);
        border: 1px solid #c8e6c9;
    }

    .error {
        background: #ffebee;
        color: var(--error-red);
        border: 1px solid #ffcdd2;
    }
</style>

<div class="settings-container">

    <div class="settings-card">

        <h2>Edit Profile</h2>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR MESSAGE --}}
        @if($errors->any())
            <div class="alert error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            @php
                $avatar = Auth::user()->profile_image
                    ? asset(Auth::user()->profile_image)
                    : asset('uploads/profiles/default_avatar.png');
            @endphp

            {{-- PROFILE IMAGE --}}
            <div class="profile-pic-wrapper">

                <img id="preview"
                     src="{{ $avatar }}"
                     alt="Profile">

                <label for="profile_image" class="upload-label">

                    <svg width="20"
                         height="20"
                         fill="currentColor"
                         viewBox="0 0 24 24">

                        <path d="M4 5q-.425 0-.712.288T3 6v12q0 .425.288.713T4 19h16q.425 0 .713-.287T21 18V6q0-.425-.287-.712T20 5H4Zm0 2h16v10H4V7Zm8 2q-1.25 0-2.125.875T9 12q0 1.25.875 2.125T12 15q1.25 0 2.125-.875T15 12q0-1.25-.875-2.125T12 9Zm0 2q.425 0 .713.288T13 12q0 .425-.287.713T12 13q-.425 0-.712-.288T11 12q0-.425.288-.712T12 11Z"/>

                    </svg>

                </label>

                <input type="file"
                       name="profile_image"
                       id="profile_image"
                       accept="image/*"
                       onchange="previewImage(event)">

            </div>

            {{-- USERNAME --}}
            <div class="form-group">

                <label>Username</label>

                <input type="text"
                       name="name"
                       value="{{ old('name', Auth::user()->name) }}"
                       required>

            </div>

            {{-- SAVE BUTTON --}}
            <button type="submit" class="btn-save">
                Save Changes
            </button>

            {{-- BACK BUTTON --}}
            <a href="{{ url('/') }}" class="back-link">
                Back to Home
            </a>

        </form>

    </div>

</div>

<script>
    function previewImage(event) {

        const reader = new FileReader();

        reader.onload = function() {

            const output = document.getElementById('preview');
            output.src = reader.result;

        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
