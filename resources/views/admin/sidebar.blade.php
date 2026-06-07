<aside class="sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <h2 class="sidebar-title">Admin Panel</h2>
    </div>

    <nav class="nav-links">

        {{-- Dashboard --}}
        <a href="{{ route('admin.index') }}"
           class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            Dashboard
        </a>

        {{-- Contact --}}
        <a href="{{ route('admin.contact.index') }}" class="nav-item">
            Contact
        </a>

        {{-- Stickers --}}
        <a href="#" class="nav-item">
            Add New Stickers
        </a>

    </nav>

    <div class="sidebar-footer">
        <a href="#" class="logout-link" id="logoutBtn">
            Log Out
        </a>
    </div>
</aside>

{{-- LOGOUT MODAL --}}
<div class="modal-overlay" id="logoutModal">
    <div class="modal-box">
        <div class="modal-title">Log out</div>
        <div class="modal-text">Are you sure you want to log out?</div>

        <div class="modal-actions">
            <button type="button" class="btn-cancel" id="cancelLogout">Cancel</button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Log Out</button>
            </form>
        </div>
    </div>
</div>

<style>
:root {
    --primary-pink: #e91e63;
    --soft-pink: #fce4ec;
    --sidebar-bg: #ffffff;
    --text-dark: #333;
    --sidebar-width: 260px;
}

/* SIDEBAR FIXED (NO HOVER, ALWAYS OPEN) */
.sidebar {
    width: var(--sidebar-width);
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: var(--sidebar-bg);
    border-right: 1px solid var(--soft-pink);
    display: flex;
    flex-direction: column;
    z-index: 1000;
}

/* HEADER */
.sidebar-header {
    padding: 25px;
    text-align: center;
    border-bottom: 1px solid var(--soft-pink);
}

.sidebar-title {
    margin: 0;
    color: var(--primary-pink);
}

/* NAV */
.nav-links {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.nav-item {
    padding: 12px 15px;
    text-decoration: none;
    color: var(--text-dark);
    border-radius: 10px;
    transition: 0.2s;
}

.nav-item:hover,
.nav-item.active {
    background: var(--soft-pink);
    color: var(--primary-pink);
}

/* FOOTER */
.sidebar-footer {
    padding: 15px;
    border-top: 1px solid var(--soft-pink);
}

.logout-link {
    display: block;
    text-align: center;
    padding: 10px;
    border: 1px solid #ff5252;
    color: #ff5252;
    border-radius: 20px;
    text-decoration: none;
}

/* PUSH CONTENT RIGHT */
body {
    margin-left: var(--sidebar-width);
    font-family: Arial, sans-serif;
}

/* MODAL */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 2000;
}

.modal-box {
    background: white;
    padding: 20px;
    border-radius: 12px;
    width: 320px;
    text-align: center;
}

.modal-title {
    color: var(--primary-pink);
    font-weight: bold;
    margin-bottom: 10px;
}

.modal-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.btn-cancel {
    padding: 8px 16px;
    border: none;
    background: #eee;
    border-radius: 20px;
}

.btn-logout {
    padding: 8px 16px;
    border: none;
    background: #ff5252;
    color: white;
    border-radius: 20px;
}
</style>

<script>
const logoutBtn = document.getElementById('logoutBtn');
const modal = document.getElementById('logoutModal');
const cancel = document.getElementById('cancelLogout');

logoutBtn?.addEventListener('click', (e) => {
    e.preventDefault();
    modal.style.display = 'flex';
});

cancel?.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});
</script>