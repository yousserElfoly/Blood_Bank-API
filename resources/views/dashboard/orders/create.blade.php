@extends('layouts.dashboard.app')

@section('title')
@lang('site.add_new_order')
@endsection

@section('style')
 <!-- Select2 -->
 <link rel="stylesheet" href="{{ asset('dashboard') }}/plugins/select2/css/select2.min.css">
 <!-- daterange picker -->
 <link rel="stylesheet" href="{{ asset('dashboard') }}/plugins/daterangepicker/daterangepicker.css">

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
              <li class="breadcrumb-item active"><a href="{{ route('dashboard.orders.index') }}">@lang('site.orders_list')</a></li>
              <li class="breadcrumb-item active">@lang('site.add_new_order')</li>
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
              <h3 class="card-title">@lang('site.add_new_order')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- start form create -->
                <form action="{{ route('dashboard.orders.store') }}" method="post" class="cp-form" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <!-- start row -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div id="full_name_div">
                                <label>@lang('site.full_name')*</label>
                                <span id="full_name_div_inside"></span>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="age_div">
                                <label>@lang('site.age')*</label>
                                <span id="age_div_inside"></span>
                                <input type="text" name="age" class="form-control" value="{{ old('age') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="blood_type_id_div">
                                    <label>@lang('site.bloodTypes')*</label>
                                    <span id="blood_type_id_div_inside"></span>
                                    <select class="form-control select2" name="blood_type_id" style="width: 100%;">
                                        <option value="">@lang('site.choose')
                                        </option>
                                        @foreach($bloodTypes as $bloodType)
                                        <option value="{{$bloodType->id}}">
                                            {{ $bloodType->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="quantity_div">
                                <label>@lang('site.quantity')*</label>
                                <span id="quantity_div_inside"></span>
                                <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="hospital_name_div">
                                <label>@lang('site.hospital_name')*</label>
                                <span id="hospital_name_div_inside"></span>
                                <input type="text" name="hospital_name" class="form-control" value="{{ old('hospital_name') }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="hospital_address_div">
                                <label>@lang('site.hospital_address')*</label>
                                <span id="hospital_address_div_inside"></span>
                                <input type="text" name="hospital_address" class="form-control" value="{{ old('hospital_address') }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="latitude_div">
                                <label>@lang('site.latitude')*</label>
                                <span id="latitude_div_inside"></span>
                                <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="longitude_div">
                                <label>@lang('site.longitude')*</label>
                                <span id="longitude_div_inside"></span>
                                <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="city_id_div">
                                    <label>@lang('site.cities')*</label>
                                    <span id="city_id_div_inside"></span>
                                    <select class="form-control select2" name="city_id" style="width: 100%;">
                                        <option value="">@lang('site.choose')
                                        </option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">
                                            {{ $city->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="phone_div">
                                <label>@lang('site.phone')*</label>
                                <span id="phone_div_inside"></span>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div id="notes_div">
                                <label>@lang('site.notes')*</label>
                                <span id="notes_div_inside"></span>
                                <textarea name="notes" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="client_id_div">
                                    <label>@lang('site.clients')*</label>
                                    <span id="client_id_div_inside"></span>
                                    <select class="form-control select2" name="client_id" style="width: 100%;">
                                        <option value="">@lang('site.choose')
                                        </option>
                                        @foreach($clients as $client)
                                        <option value="{{$client->id}}">
                                            {{ $client->username }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
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

@section('footer')
<!-- Select2 -->
<script src="{{ asset('dashboard') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="{{ asset('dashboard') }}/plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script src="{{ asset('dashboard') }}/plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="{{ asset('dashboard') }}/plugins/daterangepicker/daterangepicker.js"></script>
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    // Summernote
    $('.textarea').summernote();

    //Datemask dd/mm/yyyy
    //$('.reservation').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    //Money Euro
    //$('[data-mask]').inputmask()

    //Date range picker

    //Date range picker with time picker
    $('.reservation').daterangepicker({
      timePicker: true,
      timePickerIncrement: 31,
      locale: {
        format: 'DD/MM/YYYY'
      }
    })

  })

</script>
@endsection
