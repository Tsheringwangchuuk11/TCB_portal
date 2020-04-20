<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
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
      <li class="dropdown user user-menu">
          <a href="#" data-toggle="dropdown">
          <img src="{{ URL::to('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
          <span style="color:#f4f6f9;">{{ auth()->user()->user_name }}</span>
          
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
              <!-- User image -->
              <!-- Menu Body -->
              <li class="user-body bg-info text-center">
                <img src="{{ URL::to('dist/img/user2-160x160.jpg') }}" class="img-size-50 mr-3 img-circle" alt="User Image">
                <h5>{{ auth()->user()->user_name }}</h5>
                <p class="text-center">
                   Last Login: {{ auth()->user()->last_login}}
                </p>
                  <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                  <div class="float-left">
                  <a href="{{ url('profile')}}" class="btn btn-success btn-flat">Profile</a>
                  </div>
                  <div class="float-right">
                      <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                      {{ __('Sign out') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          </ul>
      </li>
  </ul>
  </nav>
  <!-- /.navbar -->