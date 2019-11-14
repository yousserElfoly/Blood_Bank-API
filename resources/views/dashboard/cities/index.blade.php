@extends('layouts.dashboard.app')

@section('title')
@lang('site.cities_list')
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
              <li class="breadcrumb-item active">@lang('site.cities_list')</li>
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
              <h3 class="card-title">@lang('site.cities_list')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if($cities->count() > 0)
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>##</th>
                    <th>@lang('site.name')</th>
                    <th>@lang('site.governorate')</th>
                    <th>@lang('site.action')</th>
                </tr>
                </thead>
                <tbody>

                @foreach($cities as $index=>$city)
                    <tr id="removable{{$city->id}}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->governorate()->first()->name }}</td>
                        <td>
                        @if(auth()->user()->hasPermission('update_cities'))
                        <a href="{{ route('dashboard.cities.edit',$city->id)}}"class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                        @endif

                        @if(auth()->user()->hasPermission('delete_cities'))
                        <button id="{{$city->id}}" data-token="{{ csrf_token() }}"
                            data-route="{{URL::route('dashboard.cities.destroy',$city->id)}}"
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
                    <th>@lang('site.governorate')</th>
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
