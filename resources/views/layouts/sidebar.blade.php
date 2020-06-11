<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/img/' . auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link :to="'/admin/'" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Home
              </p>
            </router-link>
          </li>
          @if(auth()->user()->hasRole('super-admin'))
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Mangement
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/admin/users" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/permissions" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Permissions</p>
                </router-link>
              </li>
            </ul>
          </li>
          @endif
          
          <!-- @can('control content') -->
          <!-- Use this for writer user -->
          <!-- @endcan -->

          <li class="nav-item">
            <router-link :to="'/admin/profile'" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Profile
                <span class="right badge badge-danger">New</span>
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"
              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-power-off"></i>
                <p>
                  {{ __('Logout') }}
                </p>
              </p>
            </a>
          </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>