<?php
// $fullname = Session::get('fullname');

// if (is_array($fullname)) {
//     $fullname = implode(' ', $fullname);
// }
?>

{{-- <header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0 d-flex gap-4" id="navbarNav">
            <div class="d-flex flex-column">
                <b>{{$fullname}}</b>
                <span class="justify-content-end">{{implode(' ', Session::get('role'))}}</span>
            </div>
            <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
        </div>
    </nav>
</header> --}}


<?php
$fullname = Session::get('fullname');

if (is_array($fullname)) {
    $fullname = implode(' ', $fullname);
}

$roles = Session::get('role');
if (is_array($roles)) {
    $roles = implode(' ', $roles);
}
?>

<header class="app-header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-3">
        <!-- Sidebar Toggler (mobile) -->
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2 fs-4"></i>
                </a>
            </li>
        </ul>

        <!-- Search Bar -->
        <form class="d-none d-md-flex ms-3 flex-grow-1" role="search" style="max-width: 400px;">
            <div class="input-group">
                <span class="input-group-text bg-light border-0">
                    <i class="ti ti-search text-muted"></i>
                </span>
                <input class="form-control border-0 bg-light" type="search"
                       placeholder="Cari data, aplikasi, dll..." aria-label="Search">
            </div>
        </form>

        <!-- Right Side -->
        <div class="navbar-collapse justify-content-end px-0 d-flex gap-4" id="navbarNav">

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                   id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../assets/images/profile/user-1.jpg" alt="profile"
                         width="35" height="35" class="rounded-circle me-2">
                    <div class="d-none d-sm-block text-start">
                        <b class="d-block">{{$fullname ?? 'Guest'}}</b>
                        <small class="text-muted">{{$roles ?? 'No Role'}}</small>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3" aria-labelledby="profileDropdown">
                    <li><h6 class="dropdown-header">{{$fullname ?? 'Guest'}}</h6></li>
                    <li><span class="dropdown-item-text text-muted">{{$roles ?? 'No Role'}}</span></li>
                    <li><hr class="dropdown-divider"></li>
                    {{-- <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="ti ti-user me-2"></i> Profil Saya</a></li> --}}
                    {{-- <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="ti ti-settings me-2"></i> Pengaturan</a></li> --}}
                    <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}"><i class="ti ti-logout me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

