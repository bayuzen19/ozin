<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern SPBE Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/tabler-icons@1.35.0/icons-sprite.svg" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }

        .main-sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            z-index: 999;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
        }

        .main-sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .sidebar-wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            z-index: 2;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
            backdrop-filter: blur(10px);
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }

        .logo-container:hover {
            transform: translateY(-2px);
        }

        .brand-logo-placeholder {
            /* height: 70px; */
            object-fit: cover;
            background: linear-gradient(135deg, #efeff0, rgb(217, 216, 221));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 12px;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
            padding: 10px;
            transition: all 0.3s ease;
        }




        .brand-logo-placeholder:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }
        .brand-logo-placeholder img{
            width: 150px;
            object-fit: cover;

        }
        .brand-text {
            color: #f1f5f9;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .toggle-sidebar {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.25rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            backdrop-filter: blur(10px);
        }

        .toggle-sidebar:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        .navigation-container {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 0 2rem;
        }

        .sidebar-navigation {
            width: 100%;
        }

        .menu-category {
            padding: 0 1.5rem;
            margin-bottom: 1rem;
        }

        .category-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.4);
            position: relative;
            padding-bottom: 8px;
        }

        .category-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, transparent);
            border-radius: 1px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 6px 0;
            position: relative;
        }

        .nav-item.active .nav-link {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(139, 92, 246, 0.1));
            color: #ffffff;
            transform: translateX(4px);
            border-left: 3px solid #3b82f6;
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
        }

        .nav-item.active .icon-container {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 1.5rem;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0 25px 25px 0;
            margin-right: 1rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(2px);
        }

        .nav-link:hover .icon-container {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.1);
        }

        .icon-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            margin-right: 14px;
            background: rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .menu-title {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .logout-section {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin-top: auto;
        }

        .logout-item .nav-link {
            color: rgba(248, 113, 113, 0.8);
            margin-right: 0;
            border-radius: 12px;
            background: rgba(248, 113, 113, 0.05);
        }

        .logout-item .icon-container {
            background: rgba(248, 113, 113, 0.15);
            color: #f87171;
        }

        .logout-item .nav-link:hover {
            color: #ffffff;
            background: rgba(248, 113, 113, 0.15);
        }

        .logout-item .nav-link:hover .icon-container {
            background: #f87171;
            color: white;
        }

        /* User info section */
        .user-info {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #10b981, #059669);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-details h6 {
            color: #f1f5f9;
            font-size: 13px;
            font-weight: 600;
            margin: 0;
        }

        .user-details p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
            margin: 2px 0 0;
        }

        /* Badge for notifications */
        .nav-badge {
            position: absolute;
            top: 8px;
            right: 1.5rem;
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: 600;
            min-width: 18px;
            text-align: center;
        }

        /* Mobile responsive */
        @media (max-width: 1200px) {
            .main-sidebar {
                transform: translateX(-100%);
            }

            .main-sidebar.show {
                transform: translateX(0);
            }

            .toggle-sidebar {
                display: flex;
            }
        }

        @media (max-width: 768px) {
            .main-sidebar {
                width: 100%;
            }
        }

        /* Custom scrollbar */
        .navigation-container::-webkit-scrollbar {
            width: 6px;
        }

        .navigation-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }

        .navigation-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .navigation-container::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Demo content area */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            background: #f8fafc;
            min-height: 100vh;
            transition: margin-left 0.4s ease;
        }

        .demo-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .demo-card h2 {
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .demo-card p {
            color: #64748b;
            line-height: 1.6;
        }

        @media (max-width: 1200px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <aside class="main-sidebar" id="sidebar">
        <div class="sidebar-wrapper">
            <!-- Header section -->
            <div class="sidebar-header">
                <a href="#" class="logo-container">
                    <div class="brand-logo-placeholder">
                        {{-- SPBE --}}
                        {{-- <img src="" alt=""> --}}

                        <img src="../assets/images/logos/logo-spbe.png" alt="SPBE Logo" class="brand-logo">

                    </div>
                    <div class="brand-text">SPBE Portal</div>
                </a>
                <button class="toggle-sidebar" id="sidebarCollapse">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
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
                            <a href="{{ url('/') }}" class="nav-link">
                                <span class="icon-container">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            {{-- <span class="nav-badge">2</span> --}}
                        </li>

                        <li class="nav-item {{ Request::is('indikator') ? 'active' : '' }}">
                            {{-- <a href="#" class="nav-link"> --}}
                            <a href="{{ url('/indikator') }}" class="nav-link">

                                <span class="icon-container">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                                        <polyline points="14,2 14,8 20,8"/>
                                        <line x1="16" y1="13" x2="8" y2="13"/>
                                        <line x1="16" y1="17" x2="8" y2="17"/>
                                        <polyline points="10,9 9,9 8,9"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Aspek & Indikator</span>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('aplikasi') ? 'active' : '' }}">
                            {{-- <a href="#" class="nav-link"> --}}
                        <a href="{{ url('/aplikasi') }}" class="nav-link">

                                <span class="icon-container">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="9" cy="9" r="2"/>
                                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                                    </svg>
                                </span>
                                <span class="menu-title">SPBE</span>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('users') ? 'active' : '' }}" >
                            {{-- <a href="#" class="nav-link"> --}}
                        <a href="{{ url('/users') }}" class="nav-link">

                                <span class="icon-container">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Data Karyawan</span>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="icon-container">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                        <polyline points="16,17 21,12 16,7"/>
                                        <line x1="21" y1="12" x2="9" y2="12"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Laporan</span>
                            </a>
                        </li> --}}
                    </ul>

                    {{-- <div class="menu-category" style="margin-top: 2rem;">
                        <span class="category-title">Pengaturan</span>
                    </div> --}}

                    {{-- <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="icon-container">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <circle cx="12" cy="12" r="3"/>
                                        <path d="m12 1 2.09 6.26L22 9l-5.74 2.09L15 19l-3-3-3 3-.26-7.91L3 9l7.91-1.74L12 1z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Konfigurasi</span>
                            </a>
                        </li>
                    </ul> --}}
                </nav>

                <!-- User info section -->
                <div class="user-info">
                    <div class="user-avatar">AD</div>
                    <div class="user-details">
                        <h6>Admin SPBE</h6>
                        <p>Administrator</p>
                    </div>
                </div>

                <!-- Logout section -->
                <div class="logout-section">
                    <ul class="nav-menu">
                        <li class="nav-item logout-item">
                        <a href="{{ url('/logout') }}" class="nav-link">

                            {{-- <a href="#" class="nav-link" onclick="handleLogout()"> --}}
                                <span class="icon-container">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                        <polyline points="16,17 21,12 16,7"/>
                                        <line x1="21" y1="12" x2="9" y2="12"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>

    <!-- Demo main content -->
      <!-- <main class="main-content">
        <div class="demo-card">
            <h2>Modern SPBE Sidebar</h2>
            <p>Ini adalah contoh tampilan sidebar yang telah didesain ulang dengan style modern. Sidebar ini dilengkapi dengan:</p>
            <ul style="margin-top: 1rem; padding-left: 1.5rem; color: #64748b;">
                <li>Design glassmorphism dengan backdrop blur</li>
                <li>Animasi micro-interactions yang smooth</li>
                <li>Icon yang lebih modern dan konsisten</li>
                <li>Color scheme yang lebih contemporary</li>
                <li>Badge notifications untuk menu aktif</li>
                <li>User profile section</li>
                <li>Responsive design untuk mobile</li>
                <li>Hover effects yang engaging</li>
            </ul>
        </div>
    </main> -->

    <script>
        // Toggle sidebar functionality
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarCollapse');

            if (window.innerWidth <= 1200) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Active menu management
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from all items
                document.querySelectorAll('.nav-item').forEach(item => {
                    item.classList.remove('active');
                });

                // Add active class to clicked item (except logout)
                if (!this.closest('.logout-item')) {
                    this.closest('.nav-item').classList.add('active');
                }
            });
        });

        // Logout function
        function handleLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                // Add loading animation
                const logoutLink = document.querySelector('.logout-item .nav-link');
                logoutLink.style.opacity = '0.6';
                logoutLink.style.pointerEvents = 'none';

                // Simulate logout process
                setTimeout(() => {
                    alert('Logout berhasil!');
                    logoutLink.style.opacity = '1';
                    logoutLink.style.pointerEvents = 'auto';
                }, 1000);
            }
        }

        // Responsive sidebar handling
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 1200) {
                sidebar.classList.remove('show');
            }
        });

        // Add smooth scroll for navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading animation on page load
            document.querySelector('.main-sidebar').style.transform = 'translateX(-20px)';
            document.querySelector('.main-sidebar').style.opacity = '0';

            setTimeout(() => {
                document.querySelector('.main-sidebar').style.transform = 'translateX(0)';
                document.querySelector('.main-sidebar').style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>
