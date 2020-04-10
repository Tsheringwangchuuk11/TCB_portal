<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <ul class="navbar-nav ml-auto">
        <!-- profile -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
            <span>{{ auth()->user()->user_name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="{{ asset(auth()->user()->avatar ? get_image(auth()->user()->avatar, 80, 80) : asset('img/user-photo/no-image.jpg')) }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                        {{ auth()->user()->user_name }}
                    </h3>
                    <p class="text-sm">Last Login {{ auth()->user()->last_login }}</p>
                  </div>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ url('profile') }}" class="btn btn-success btn-sm btn-flat">
                <i class="fas fa-user"></i> Profile
            </a>
            <span class="float-right">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-flat"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out"></i> Sign Out
                </a>
            </span>
          </div>
        </li>
      </ul>
  </nav>
  <!-- /.navbar -->