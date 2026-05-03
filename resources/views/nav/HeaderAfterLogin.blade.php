<style>
.profile-link-hover {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: inherit;
    margin-right: auto;
    transition: 0.2s;
}

.profile-link-hover:hover {
    opacity: 0.7;
    cursor: pointer;
}

.utility-links {
    display: flex;
    align-items: center;
    padding: 8px 16px;
}

.nav-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
}

.welcome-text {
    font-weight: 600;
}

.nav-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 26px;
    padding: 8px 16px;
    cursor: pointer;
}

.nav-bar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 15px;
}

.nav-bar a {
    text-decoration: none;
    color: inherit;
}

@media (max-width: 768px) {
    .nav-toggle {
        display: block;
        margin-left: auto;
    }

    .nav-bar {
        display: none;
        background: #FEC1D5;
    }

    .nav-bar.open {
        display: block;
    }

    .nav-bar ul {
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 8px 0;
    }

    .nav-bar li {
        width: 100%;
        text-align: center;
    }

    .nav-bar a {
        display: block;
        padding: 8px 0;
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

            <a href="{{ url('/profile/settings') }}" class="profile-link-hover">

                <img src="{{ $avatar }}" class="nav-avatar" alt="Profile">

                <span class="welcome-text">
                    Welcome, {{ Auth::user()->name }}
                </span>
            </a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;cursor:pointer;">
                    Log Out
                </button>
            </form>
        @endauth

    </div>

    <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation">
        ☰
    </button>

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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const navToggle = document.getElementById('nav-toggle');
    const navBar = document.getElementById('nav-bar');

    if (navToggle && navBar) {
        navToggle.addEventListener('click', function () {
            navBar.classList.toggle('open');
        });
    }

});
</script>