<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

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
