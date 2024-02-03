<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">ONLINE SHOP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">FIC12</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('/') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('/') }}">General Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('/user') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('/user') }}">All User</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>Categories</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('/category') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('/category') }}">All Category</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-box"></i><span>Products</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('/product') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('/product') }}">All Product</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
