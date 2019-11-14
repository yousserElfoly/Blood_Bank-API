@extends('layouts.dashboard.app')

@section('title')
@lang('site.edit_article')
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
              <li class="breadcrumb-item active"><a href="{{ route('dashboard.articles.index') }}">@lang('site.articles_list')</a></li>
              <li class="breadcrumb-item active">@lang('site.edit_article')</li>
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
              <h3 class="card-title">@lang('site.edit_article')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- start form create -->
                <form class="cp-form" action="{{ route('dashboard.articles.update',$article->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                       <!-- start row -->
                       <div class="row">
                        <div class="form-group col-md-6">
                            <div id="title_div">
                                <label>@lang('site.title')*</label>
                                <span id="title_div_inside"></span>
                                <input type="text" name="title" class="form-control" value="{{ $article->title }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="image_div">
                                <label>@lang('site.image')*</label>
                                <span id="image_div_inside"></span>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="content_div">
                                <label>@lang('site.content')*</label>
                                <span id="content_div_inside"></span>
                                <textarea name="content" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;">
                                {!! $article->content !!}
                                </textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="category_id_div">
                                    <label>@lang('site.categories')*</label>
                                    <span id="category_id_div_inside"></span>
                                    <select class="form-control select2" name="category_id" style="width: 100%;">
                                        <option value="">@lang('site.choose')
                                        </option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ $category->id == $article->category_id?'selected':'' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.save')</button>
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
