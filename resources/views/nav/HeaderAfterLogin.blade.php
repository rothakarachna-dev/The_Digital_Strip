<style>
.header {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-family: Arial, sans-serif;
}

/* top bar */
.utility-links {
    width: 1000px;
    max-width: 90%;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 20px 0 5px 0;
    font-size: 15px;
}

.utility-links a {
    color: #333;
    text-decoration: none;
}

.utility-links a:hover {
    text-decoration: underline;
}

/* profile */
.nav-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
}

.profile-link-hover {
    display: flex;
    align-items: center;
    margin-right: auto;
    transition: opacity 0.2s ease;
}

.profile-link-hover:hover {
    opacity: 0.7;
}

/* navbar */
.nav-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 26px;
    cursor: pointer;
    margin: 5px 12px 8px auto;
}

.nav-bar {
    width: 1000px;
    max-width: 90%;
    background: rgba(255, 174, 201, 0.85);
    border-radius: 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);

    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;

    border: 1px solid rgba(255,255,255,0.4);
}

.nav-bar ul {
    list-style: none;
    display: flex;
    width: 100%;
    justify-content: center;
    margin: 0;
    padding: 0;
}

.nav-bar a {
    color: white;
    text-decoration: none;
    padding: 0 20px;
    font-size: 1.2em;
    font-weight: bold;
    transition: 0.3s;
}

.nav-bar a:hover {
    transform: scale(1.2);
    text-shadow: 0 0 8px rgba(255,255,255,0.8);
}

.nav-bar a.active {
    border-bottom: 3px solid white;
}

/* logout modal */
.logout-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.4);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.logout-modal-content {
    background: #fff;
    padding: 28px 32px;
    border-radius: 18px;
    max-width: 420px;
    width: 90%;
    text-align: center;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}

.logout-modal-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 16px;
}

.logout-modal-buttons button {
    padding: 10px 22px;
    border-radius: 999px;
    border: none;
    cursor: pointer;
    font-size: 15px;
}

#logout-cancel {
    background: #e0e0e0;
}

#logout-confirm {
    background: #F875AA;
    color: #fff;
}

/* responsive */
@media (max-width: 768px) {

    .nav-toggle {
        display: block;
    }

    .nav-bar {
        display: none;
        flex-direction: column;
        height: auto;
        background: #FEC1D5;
        backdrop-filter: blur(8px);
    }

    .nav-bar ul {
        flex-direction: column;
        gap: 6px;
        padding: 10px 0;
    }

    .nav-bar.open {
        display: flex;
    }
}
</style>


<div class="header">

    <div class="utility-links">

        @auth

            @php
                $avatar = Auth::user()->profile_image
                    ? asset(Auth::user()->profile_image)
                    : asset('uploads/profiles/default_avatar.png');
            @endphp

            {{-- PROFILE LINK --}}
            <a href="{{ route('profile.settings') }}"
               class="profile-link-hover"
               style="display:flex;align-items:center;text-decoration:none;color:inherit;margin-right:auto;">

                <img src="{{ $avatar }}"
                     alt="Profile"
                     class="nav-avatar">

                <span class="welcome-text">
                    Welcome, {{ Auth::user()->name ?? 'User' }}
                </span>

            </a>

            {{-- LOGOUT --}}
            <a href="#" id="logout-link">
                Log Out
            </a>

        @else

            <a href="{{ route('login') }}">
                Log In
            </a>

        @endauth

    </div>

    {{-- MOBILE TOGGLE --}}
    <button class="nav-toggle" id="nav-toggle">
        ☰
    </button>

    {{-- NAVIGATION --}}
    <div class="nav-bar" id="nav-bar">

        <ul>

            <li>
                <a href="{{ url('/') }}"
                   class="{{ request()->is('/') ? 'active' : '' }}">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ url('/about') }}"
                   class="{{ request()->is('about') ? 'active' : '' }}">
                    About
                </a>
            </li>

            <li>
                <a href="{{ url('/contact') }}"
                   class="{{ request()->is('contact') ? 'active' : '' }}">
                    Contact
                </a>
            </li>

            <li>
                <a href="{{ url('/photo') }}"
                   class="{{ request()->is('photo') ? 'active' : '' }}">
                    Photo
                </a>
            </li>

        </ul>

    </div>

</div>

{{-- LOGOUT MODAL --}}
<div id="logout-modal" class="logout-modal">

    <div class="logout-modal-content">

        <h3>Log out?</h3>

        <p>
            Are you sure you want to log out?
        </p>

        <div class="logout-modal-buttons">

            <button id="logout-cancel">
                Cancel
            </button>

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button id="logout-confirm" type="submit">
                    Log Out
                </button>

            </form>

        </div>

    </div>

</div>

<link rel="stylesheet" href="{{ asset('nav/nav.css') }}">

<script>
document.addEventListener('DOMContentLoaded', function () {

    const logoutLink  = document.getElementById('logout-link');
    const logoutModal = document.getElementById('logout-modal');
    const cancel      = document.getElementById('logout-cancel');
    const navToggle   = document.getElementById('nav-toggle');
    const navBar      = document.getElementById('nav-bar');

    // logout popup
    if (logoutLink) {

        logoutLink.addEventListener('click', function(e) {

            e.preventDefault();
            logoutModal.style.display = 'flex';

        });
    }

    // cancel logout
    if (cancel) {

        cancel.onclick = () => {

            logoutModal.style.display = 'none';

        };
    }

    // mobile nav
    if (navToggle) {

        navToggle.onclick = () => {

            navBar.classList.toggle('open');

        };
    }

    // close modal when clicking outside
    logoutModal.addEventListener('click', function(e) {

        if (e.target === logoutModal) {

            logoutModal.style.display = 'none';

        }

    });

});
</script>