<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light">TCB-Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><strong>{{ auth()->user()->user_name }}</strong></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('change-password') }}" class="nav-link">Change Password</a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <p>
                Master
              </p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i> Module1</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i> Module2</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i> Module3</a>
              </li>
            </ul>
          </li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @php $lastTopMenu = ""; @endphp
          @foreach ($menus->where('display_type', 'side') as $menu)
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <span>{{ $menu->name }}</span>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                @foreach ($menu->systemSubMenus as $systemSubMenu)
                    <li class="nav-item">
                        <a href="{{ url($systemSubMenu->route) }}" class="nav-link {{ Route::currentRouteNamed($systemSubMenu->route) ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>{{ $systemSubMenu->name }}
                        </a>
                    </li>
                @endforeach
              </ul>
            </li>
          @endforeach
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>