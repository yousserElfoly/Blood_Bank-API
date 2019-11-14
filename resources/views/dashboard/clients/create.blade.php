@extends('layouts.dashboard.app')

@section('title')
@lang('site.add_new_client')
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
              <li class="breadcrumb-item active"><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients_list')</a></li>
              <li class="breadcrumb-item active">@lang('site.add_new_client')</li>
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
              <h3 class="card-title">@lang('site.add_new_client')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- start form create -->
                <form action="{{ route('dashboard.clients.store') }}" method="post" class="cp-form" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <!-- start row -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div id="username_div">
                                <label>@lang('site.username')*</label>
                                <span id="username_div_inside"></span>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}">
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
                            <div id="date_of_birth_div">
                                <label>@lang('site.date_of_birth')*</label>
                                <span id="date_of_birth_div_inside"></span>
                                <input type="date" name="date_of_birth" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="last_donation_div">
                                <label>@lang('site.last_donation')*</label>
                                <span id="last_donation_div_inside"></span>
                                <input type="date" name="last_donation" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="blood_type_id_div">
                                    <label>@lang('site.blood_type')*</label>
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
    $('.select2').select2()

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
