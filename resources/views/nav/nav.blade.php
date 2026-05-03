<!-- NAVBAR -->

<style>
/* Header */
.header {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-family: Arial, sans-serif;
}

/* Login|Sign Up */
.utility-links {
    width: 1000px;
    max-width: 90%;
    display: flex;
    justify-content: flex-end;
    padding: 20px 0 5px 0;
    font-size: 15px;
}

.utility-links a {
    color: #333;
    text-decoration: none;
}

.utility-links .divider {
    margin: 0 8px;
}

.utility-links a:hover {
    text-decoration: underline;
}

/* Hamburger */
.nav-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 26px;
    cursor: pointer;
    margin: 5px 12px 8px auto;
}

/* navbar*/
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

/* Responsive */
@media (max-width: 768px) {

    .nav-toggle {
        display: block;
    }

    .nav-bar {
        display: none;
        flex-direction: column;
        height: auto;
        background: #FEC1D5;
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

    <!-- Login|Sign Up -->
    <div class="utility-links">
        <a href="{{ url('/login') }}">Log In</a>
        <span class="divider"> | </span>
        <a href="{{ url('/signup') }}">Sign Up</a>
    </div>

    <!-- Hamburger -->
    <button class="nav-toggle" id="nav-toggle">☰</button>

    <!-- Nav -->
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
document.addEventListener('DOMContentLoaded', () => {

    const navToggle = document.getElementById('nav-toggle');
    const navBar = document.getElementById('nav-bar');

    if (!navToggle || !navBar) return;

    navToggle.addEventListener('click', () => {
        navBar.classList.toggle('open');
    });

});
</script>