<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('dashboard') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Blood Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dashboard') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->first()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                @lang('site.users')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_users'))
              <li class="nav-item">
                <a href="{{ route('dashboard.users.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.users_list')</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermission('create_users'))
              <li class="nav-item">
                <a href="{{ route('dashboard.users.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_new_user')</p>
                </a>
              </li>
            @endif
            </ul>
          </li>

        <!-- bloodTypes route -->
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('site.bloodTypes')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_bloodTypes'))
              <li class="nav-item">
                <a href="{{ route('dashboard.bloodTypes.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.bloodTypes_list')</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermission('create_bloodTypes'))
              <li class="nav-item">
                <a href="{{ route('dashboard.bloodTypes.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_new_bloodTypes')</p>
                </a>
              </li>
            @endif
            </ul>
          </li>

          <!-- categories route -->
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('site.categories')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_categories'))
              <li class="nav-item">
                <a href="{{ route('dashboard.categories.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.categories_list')</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermission('create_categories'))
              <li class="nav-item">
                <a href="{{ route('dashboard.categories.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_new_category')</p>
                </a>
              </li>
            @endif
            </ul>
          </li>

          <!-- governorates route -->
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('site.governorates')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_governorates'))
              <li class="nav-item">
                <a href="{{ route('dashboard.governorates.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.governorates_list')</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermission('create_governorates'))
              <li class="nav-item">
                <a href="{{ route('dashboard.governorates.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_new_governorate')</p>
                </a>
              </li>
            @endif
            </ul>
          </li>

          <!-- cities route -->
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('site.cities')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_cities'))
              <li class="nav-item">
                <a href="{{ route('dashboard.cities.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.cities_list')</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->hasPermission('create_cities'))
              <li class="nav-item">
                <a href="{{ route('dashboard.cities.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_new_city')</p>
                </a>
              </li>
            @endif
            </ul>
          </li>

        <!-- clients route -->
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('site.clients')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_clients'))
              <li class="nav-item">
                <a href="{{ route('dashboard.clients.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.clients_list')</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->hasPermission('create_clients'))
              <li class="nav-item">
                <a href="{{ route('dashboard.clients.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_new_client')</p>
                </a>
              </li>
              @endif
            </ul>
          </li>

        <!-- articles route -->
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('site.articles')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_articles'))
              <li class="nav-item">
                <a href="{{ route('dashboard.articles.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.articles_list')</p>
                </a>
              </li>
            @endif

            @if(auth()->user()->hasPermission('create_articles'))
              <li class="nav-item">
                <a href="{{ route('dashboard.articles.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_article')</p>
                </a>
              </li>
            @endif
            </ul>
          </li>

        <!-- orders route -->
        <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('site.orders')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(auth()->user()->hasPermission('read_orders'))
              <li class="nav-item">
                <a href="{{ route('dashboard.orders.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.orders_list')</p>
                </a>
              </li>
            @endif

            @if(auth()->user()->hasPermission('create_orders'))
              <li class="nav-item">
                <a href="{{ route('dashboard.orders.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('site.add_new_order')</p>
                </a>
              </li>
            @endif
            </ul>
        </li>

        <!-- settings -->
        <li class="nav-item">
            <a href="{{ route('dashboard.settings.edit','1') }}" class="nav-link">
                <i class="fa fa-cogs"></i>
                <p>@lang('site.settings')</p>
            </a>
        </li>

        </ul>
      </nav>

    </div>
    <!-- /.sidebar -->
  </aside>
