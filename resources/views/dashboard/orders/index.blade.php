@extends('layouts.dashboard.app')

@section('title')
@lang('site.orders_list')
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
              <li class="breadcrumb-item active">@lang('site.orders_list')</li>
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
              <h3 class="card-title">@lang('site.orders_list')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if($orders->count() > 0)
            <div class="table table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>##</th>
                        <th>@lang('site.full_name')</th>
                        <th>@lang('site.age')</th>
                        <th>@lang('site.bloodTypes')</th>
                        <th>@lang('site.quantity')</th>
                        <th>@lang('site.hospital_name')</th>
                        <th>@lang('site.city')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.clients')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($orders as $index=>$order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->full_name }}</td>
                            <td>{{ $order->age }}</td>
                            <td>{{ $order->blood_type()->first()->name }}</td>
                            <td>{{ $order->quantity}}</td>
                            <td>{{ $order->hospital_name }}</td>
                            <td>{{ $order->city()->first()->name }}</td>
                            <td>{{ $order->phone}}</td>
                            <td>{{ $order->client()->first()->username }}</td>
                            <td>
                            @if (auth()->user()->hasPermission('update_orders'))
                            <a href="{{ route('dashboard.orders.edit',$order->id)}}"class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                            @endif
                            @if (auth()->user()->hasPermission('delete_orders'))
                            <form action="{{ route('dashboard.orders.destroy',$order->id)}}" method="post" style="display: inline-block">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                            </form><!-- end of form -->
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>##</th>
                        <th>@lang('site.full_name')</th>
                        <th>@lang('site.age')</th>
                        <th>@lang('site.bloodTypes')</th>
                        <th>@lang('site.quantity')</th>
                        <th>@lang('site.hospital_name')</th>
                        <th>@lang('site.city')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.clients')</th>
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
