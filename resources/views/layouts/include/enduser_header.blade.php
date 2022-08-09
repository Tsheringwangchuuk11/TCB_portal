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
              <span class="text-dark btn btn-flat btn-info btn-sm"><i class="fas fa-user"></i> {{ auth()->user()->user_name }}</span>

          </a>
          <ul class="dropdown-menu dropdown-menu-right">
              <!-- User image -->
              <!-- Menu Body -->
              <li class="user-body bg-info text-center">
                <h5>{{ auth()->user()->user_name }}</h5>
                <p class="text-center">
                   Last Login:{{ auth()->user()->last_login_at }}
                </p>
                  <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                  <div class="float-left">
                     <a href="#" class="btn btn-success btn-flat" data-dismiss="modal">Cancel</a>
                  </div>
                  <div class="float-right">
                     <a class="btn btn-danger btn-flat" href="{{ route('logout') }}">              
                          {{ __('Sign out') }}
                      </a>
                  </div>
              </li>
          </ul>
      </li>
  </ul>
  </nav>
  <!-- /.navbar -->
