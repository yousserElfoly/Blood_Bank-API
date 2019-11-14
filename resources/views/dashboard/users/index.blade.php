@extends('layouts.dashboard.app')

@section('title')
@lang('site.users_list')
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('dashboard') }}/plugins/datatables/dataTables.bootstrap4.css">
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
              <li class="breadcrumb-item"><a href="#">@lang('site.home')</a></li>
              <li class="breadcrumb-item active">@lang('site.users_list')</li>
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
              <h3 class="card-title">@lang('site.users_list')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if($users->count() > 0)
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>##</th>
                    <th>@lang('site.name')</th>
                    <th>@lang('site.email')</th>
                    <th>@lang('site.action')</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $index=>$user)
                    <tr id="removable{{$user->id}}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                        @if(auth()->user()->hasPermission('update_users'))
                        <a href="{{ route('dashboard.users.edit',$user->id)}}"class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                        @endif

                        @if(auth()->user()->hasPermission('delete_users'))
                        <button id="{{$user->id}}" data-token="{{ csrf_token() }}"
                            data-route="{{URL::route('dashboard.users.destroy',$user->id)}}"
                            type="button" class="destroy btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>

                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>##</th>
                    <th>@lang('site.name')</th>
                    <th>@lang('site.email')</th>
                    <th>@lang('site.action')</th>
                </tr>
                </tfoot>
              </table>
            @else
                <div class="alert alert-danger">@lang('site.no_data_found')</div>
            @endif
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

@section('footer')
<!-- DataTables -->
<script src="{{ asset('dashboard') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('dashboard') }}/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection
