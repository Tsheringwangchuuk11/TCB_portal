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
                <h5></h5>
                <p class="text-center">
                   Last Login: 
                </p>
                  <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                  <div class="float-left">
                      <a class="btn btn-danger btn-flat" href="https://stg-sso.dit.gov.bt/oidc/logout?post_logout_redirect_uri=https://portal.tourism.gov.bt/sso/logout& id_token_hint={{auth()->user()->id_token }}">              
                          {{ __('Sign out') }}
                      </a>
                      <form id="logout-form" action="{{ route('signout') }}" method="POST" style="display: none;">
                          @csrf
                          <input type="hidden" name="id_token" value="{{auth()->user()->id_token }}">
                      </form>
                  </div>
              </li>
          </ul>
      </li>
  </ul>
  </nav>
  <!-- /.navbar -->
