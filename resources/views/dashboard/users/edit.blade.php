@extends('layouts.dashboard.app')

@section('title')
@lang('site.edit_user')
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@lang('site.home')</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('dashboard.users.index') }}">@lang('site.users_list')</a></li>
              <li class="breadcrumb-item active">@lang('site.edit_user')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">@lang('site.edit_user')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- start form create -->
                <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" class="cp-form" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <!-- start row -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div id="name_div">
                                <label>@lang('site.name')*</label>
                                <span id="name_div_inside"></span>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="email_div">
                                <label>@lang('site.email')*</label>
                                <span id="email_div_inside"></span>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>

                    </div>
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">
                            <i class="fas fa-chart-pie mr-1"></i>
                            @lang('site.permissions')
                            <span id="permissions_div_inside"></span>
                            </h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#permissions-users" data-toggle="tab">@lang('site.users')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#permissions-bloodTypes" data-toggle="tab">@lang('site.bloodTypes')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#permissions-categories" data-toggle="tab">@lang('site.categories')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#permissions-governorates" data-toggle="tab">@lang('site.governorates')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#permissions-cities" data-toggle="tab">@lang('site.cities')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#permissions-clients" data-toggle="tab">@lang('site.clients')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#permissions-articles" data-toggle="tab">@lang('site.articles')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#permissions-orders" data-toggle="tab">@lang('site.orders')</a>
                                </li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">

                                <div class="chart tab-pane active" id="permissions-users">
                                    <label><input type="checkbox" name="permissions[]" value="read_users" {{ $user->hasPermission('read_users') ? 'checked' : '' }}> @lang('site.read_users')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_users" {{ $user->hasPermission('create_users') ? 'checked' : '' }}> @lang('site.create_users')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_users" {{ $user->hasPermission('update_users') ? 'checked' : '' }}> @lang('site.update_users')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_users" {{ $user->hasPermission('delete_users') ? 'checked' : '' }}> @lang('site.delete_users')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-bloodTypes">
                                    <label><input type="checkbox" name="permissions[]" value="read_bloodTypes" {{ $user->hasPermission('read_bloodTypes') ? 'checked' : '' }}> @lang('site.read_bloodTypes')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_bloodTypes" {{ $user->hasPermission('create_bloodTypes') ? 'checked' : '' }}> @lang('site.create_bloodTypes')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_bloodTypes" {{ $user->hasPermission('update_bloodTypes') ? 'checked' : '' }}> @lang('site.update_bloodTypes')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_bloodTypes" {{ $user->hasPermission('delete_bloodTypes') ? 'checked' : '' }}> @lang('site.delete_bloodTypes')</label>
                                </div>

                                <div class="chart tab-pane" id="permissions-categories">
                                    <label><input type="checkbox" name="permissions[]" value="read_categories" {{ $user->hasPermission('read_categories') ? 'checked' : '' }}> @lang('site.read_categories')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_categories" {{ $user->hasPermission('create_categories') ? 'checked' : '' }}> @lang('site.create_categories')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_categories" {{ $user->hasPermission('update_categories') ? 'checked' : '' }}> @lang('site.update_categories')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_categories" {{ $user->hasPermission('delete_categories') ? 'checked' : '' }}> @lang('site.delete_categories')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-governorates">
                                    <label><input type="checkbox" name="permissions[]" value="read_governorates" {{ $user->hasPermission('read_governorates') ? 'checked' : '' }}> @lang('site.read_governorates')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_governorates" {{ $user->hasPermission('create_governorates') ? 'checked' : '' }}> @lang('site.create_governorates')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_governorates" {{ $user->hasPermission('update_governorates') ? 'checked' : '' }}> @lang('site.update_governorates')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_governorates" {{ $user->hasPermission('delete_governorates') ? 'checked' : '' }}> @lang('site.delete_governorates')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-cities">
                                    <label><input type="checkbox" name="permissions[]" value="read_cities" {{ $user->hasPermission('read_cities') ? 'checked' : '' }}> @lang('site.read_cities')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_cities" {{ $user->hasPermission('create_cities') ? 'checked' : '' }}> @lang('site.create_cities')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_cities" {{ $user->hasPermission('update_cities') ? 'checked' : '' }}> @lang('site.update_cities')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_cities" {{ $user->hasPermission('delete_cities') ? 'checked' : '' }}> @lang('site.delete_cities')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-clients">
                                    <label><input type="checkbox" name="permissions[]" value="read_clients" {{ $user->hasPermission('read_clients') ? 'checked' : '' }}> @lang('site.read_clients')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_clients" {{ $user->hasPermission('create_clients') ? 'checked' : '' }}> @lang('site.create_clients')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_clients" {{ $user->hasPermission('update_clients') ? 'checked' : '' }}> @lang('site.update_clients')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_clients" {{ $user->hasPermission('delete_clients') ? 'checked' : '' }}> @lang('site.delete_clients')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-articles">
                                    <label><input type="checkbox" name="permissions[]" value="read_articles" {{ $user->hasPermission('read_articles') ? 'checked' : '' }}> @lang('site.read_articles')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_articles" {{ $user->hasPermission('create_articles') ? 'checked' : '' }}> @lang('site.create_articles')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_articles" {{ $user->hasPermission('update_articles') ? 'checked' : '' }}> @lang('site.update_articles')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_articles" {{ $user->hasPermission('delete_articles') ? 'checked' : '' }}> @lang('site.delete_articles')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-orders">
                                    <label><input type="checkbox" name="permissions[]" value="read_orders" {{ $user->hasPermission('read_orders') ? 'checked' : '' }}> @lang('site.read_orders')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_orders" {{ $user->hasPermission('create_orders') ? 'checked' : '' }}> @lang('site.create_orders')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_orders" {{ $user->hasPermission('update_orders') ? 'checked' : '' }}> @lang('site.update_orders')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_orders" {{ $user->hasPermission('delete_orders') ? 'checked' : '' }}> @lang('site.delete_orders')</label>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- end row -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.save')</button>
                    </div>

                    </form><!-- end of form -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection

