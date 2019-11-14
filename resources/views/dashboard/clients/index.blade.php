@extends('layouts.dashboard.app')

@section('title')
@lang('site.clients_list')
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
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@lang('site.home')</a></li>
              <li class="breadcrumb-item active">@lang('site.clients_list')</li>
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
              <h3 class="card-title">@lang('site.clients_list')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if($clients->count() > 0)
            <div class="table table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>##</th>
                        <th>@lang('site.username')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.date_of_birth')</th>
                        <th>@lang('site.blood_type')</th>
                        <th>@lang('site.last_donation')</th>
                        <th>@lang('site.city')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($clients as $index=>$client)
                        <tr id="removable{{$client->id}}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $client->username }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->date_of_birth }}</td>
                            <td>{{ $client->blood_type()->first()->name }}</td>
                            <td>{{ $client->last_donation }}</td>
                            <td>{{ $client->city()->first()->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>
                            @if (auth()->user()->hasPermission('update_clients'))
                            <a href="{{ route('dashboard.clients.edit',$client->id)}}"class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                            @endif
                            @if (auth()->user()->hasPermission('delete_clients'))
                            <button id="{{$client->id}}" data-token="{{ csrf_token() }}"
                                data-route="{{URL::route('dashboard.clients.destroy',$client->id)}}"
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
                        <th>@lang('site.username')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.date_of_birth')</th>
                        <th>@lang('site.blood_type')</th>
                        <th>@lang('site.last_donation')</th>
                        <th>@lang('site.city')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
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
