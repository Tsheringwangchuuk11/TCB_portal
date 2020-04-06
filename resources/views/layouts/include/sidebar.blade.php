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
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i>Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('change-password') }}" class="nav-link"><i class="nav-icon fas fa-key"></i> Change Password</a>
          </li>
          @php $lastTopMenu = ""; @endphp
          @foreach ($menus->where('display_type', 'side') as $menu)
              @foreach ($menu->systemSubMenus as $systemSubMenu)
                  @if($menu->name != $lastTopMenu)
                      @if($lastTopMenu != "")
                          </ul></li>
                      @endif
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas {{ $menu->icon }}"></i>
                            <span>{{ $menu->name }}</span>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                      <ul class="nav nav-treeview">
                  @endif
                  <li class="nav-item">
                      <a href="{{ url($systemSubMenu->route) }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>{{ $systemSubMenu->name }}
                      </a>
                  </li>
                  @php $lastTopMenu = $menu->name; @endphp
              @endforeach
            @endforeach
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>