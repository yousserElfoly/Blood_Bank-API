@extends('layouts.dashboard.app')

@section('title')
@lang('site.add_new_user')
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
              <li class="breadcrumb-item active">@lang('site.add_new_user')</li>
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
              <h3 class="card-title">@lang('site.add_new_user')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- start form create -->
                <form action="{{ route('dashboard.users.store') }}" method="post" class="cp-form" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <!-- start row -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div id="name_div">
                                <label>@lang('site.name')*</label>
                                <span id="name_div_inside"></span>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="email_div">
                                <label>@lang('site.email')*</label>
                                <span id="email_div_inside"></span>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <div id="password_div">
                                <label>@lang('site.password')*</label>
                                <span id="password_div_inside"></span>
                                <input type="password" name="password" class="form-control" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="password_confirm_div">
                                <label>@lang('site.password_confirmation')*</label>
                                <span id="password_confirm_div_inside"></span>
                                <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
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
                                    <label><input type="checkbox" name="permissions[]" value="read_users"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_users"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_users"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_users"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-bloodTypes">
                                    <label><input type="checkbox" name="permissions[]" value="read_bloodTypes"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_bloodTypes"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_bloodTypes"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_bloodTypes"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-bloodTypes">
                                    <label><input type="checkbox" name="permissions[]" value="read_bloodTypes"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_bloodTypes"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_bloodTypes"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_bloodTypes"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-categories">
                                    <label><input type="checkbox" name="permissions[]" value="read_categories"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_categories"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_categories"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_categories"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-governorates">
                                    <label><input type="checkbox" name="permissions[]" value="read_governorates"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_governorates"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_governorates"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_governorates"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-cities">
                                    <label><input type="checkbox" name="permissions[]" value="read_cities"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_cities"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_cities"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_cities"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-clients">
                                    <label><input type="checkbox" name="permissions[]" value="read_clients"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_clients"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_clients"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_clients"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-articles">
                                    <label><input type="checkbox" name="permissions[]" value="read_articles"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_articles"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_articles"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_articles"> @lang('site.delete')</label>
                                </div>
                                <div class="chart tab-pane" id="permissions-orders">
                                    <label><input type="checkbox" name="permissions[]" value="read_orders"> @lang('site.read')</label>
                                    <label><input type="checkbox" name="permissions[]" value="create_orders"> @lang('site.create')</label>
                                    <label><input type="checkbox" name="permissions[]" value="update_orders"> @lang('site.update')</label>
                                    <label><input type="checkbox" name="permissions[]" value="delete_orders"> @lang('site.delete')</label>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- end row -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
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
