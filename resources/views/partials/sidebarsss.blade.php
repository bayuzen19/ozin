<aside class="main-sidebar">
    <div class="sidebar-wrapper">
        <!-- Logo and toggle section -->
        <div class="sidebar-header">
            <a href="./index.html" class="logo-container">
                <img src="../assets/images/logos/logo-spbe.png" alt="SPBE Logo" class="brand-logo">
            </a>
            <button class="toggle-sidebar d-xl-none" id="sidebarCollapse">
                <i class="ti ti-x"></i>
            </button>
        </div>

        <!-- Navigation container -->
        <div class="navigation-container">
            <nav class="sidebar-navigation">
                <div class="menu-category">
                    <span class="category-title">Menu Utama</span>
                </div>

                <ul class="nav-menu">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a href="c" class="nav-link">
                            <span class="icon-container">
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('indikator') ? 'active' : '' }}">
                        <a href="{{ url('/indikator') }}" class="nav-link">
                            <span class="icon-container">
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="menu-title">Aspek & Indikator</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('aplikasi') ? 'active' : '' }}">
                        <a href="{{ url('/aplikasi') }}" class="nav-link">
                            <span class="icon-container">
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="menu-title">SPBE</span>
                        </a>
                    </li>

                    @if (implode(' ', Session::get('role')) == 'admin')
                    <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                        <a href="{{ url('/users') }}" class="nav-link">
                            <span class="icon-container">
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="menu-title">Data Karyawan</span>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item logout-item">
                        <a href="{{ url('/logout') }}" class="nav-link">
                            <span class="icon-container">
                                <i class="ti ti-logout"></i>
                            </span>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>

<style>
    .main-sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: linear-gradient(180deg, #2c5eb4 0%, #1a3a8f 100%);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        z-index: 999;
        transition: all 0.3s ease;
    }

    .sidebar-wrapper {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .brand-logo {
        width: auto;
        height: 90px;
        transition: transform 0.3s ease;
    }

    .brand-logo:hover {
        transform: scale(1.05);
    }

    .toggle-sidebar {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.25rem;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .toggle-sidebar:hover {
        color: #ffffff;
    }

    .navigation-container {
        flex: 1;
        overflow-y: auto;
        padding: 1rem 0;
    }

    .sidebar-navigation {
        width: 100%;
    }

    .menu-category {
        padding: 0.75rem 1.5rem;
        margin-top: 0.5rem;
    }

    .category-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.6);
    }

    .nav-menu {
        list-style: none;
        padding: 0;
        margin: 0.5rem 0;
    }

    .nav-item {
        margin: 4px 0;
        border-radius: 0;
        position: relative;
    }

    .nav-item.active {
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: #ffffff;
        border-radius: 0 4px 4px 0;
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.8rem 1.5rem;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: all 0.2s ease;
        border-radius: 8px;
        margin: 0 0.5rem;
    }

    .nav-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.08);
    }

    .icon-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        margin-right: 10px;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.2s ease;
    }

    .nav-link:hover .icon-container {
        background: rgba(255, 255, 255, 0.2);
    }

    .menu-title {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .logout-item {
        margin-top: 2rem;
    }

    .logout-item .nav-link {
        color: rgba(255, 255, 255, 0.7);
    }

    .logout-item .icon-container {
        background: rgba(255, 100, 100, 0.2);
    }

    .logout-item .nav-link:hover {
        color: #ffffff;
    }

    .logout-item .nav-link:hover .icon-container {
        background: rgba(255, 100, 100, 0.3);
    }

    /* For smaller screens */
    @media (max-width: 1200px) {
        .main-sidebar {
            transform: translateX(-100%);
        }

        .main-sidebar.show {
            transform: translateX(0);
        }
    }

    /* Simplebar scrollbar styling */
    .sidebar-navigation::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-navigation::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar-navigation::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }

    .sidebar-navigation::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>


