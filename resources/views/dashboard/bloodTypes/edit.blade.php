@extends('layouts.dashboard.app')

@section('title')
@lang('site.edit_bloodTypes')
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
              <li class="breadcrumb-item active"><a href="{{ route('dashboard.bloodTypes.index') }}">@lang('site.bloodTypes_list')</a></li>
              <li class="breadcrumb-item active">@lang('site.edit_bloodTypes')</li>
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
              <h3 class="card-title">@lang('site.edit_bloodTypes')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- start form create -->
                <form action="{{ route('dashboard.bloodTypes.update', $bloodType->id) }}" method="post" class="cp-form">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <!-- start row -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div id="name_div">
                                <label>@lang('site.name')*</label>
                                <span id="name_div_inside"></span>
                                <input type="text" name="name" class="form-control" value="{{ $bloodType->name }}">
                            </div>
                        </div>

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
