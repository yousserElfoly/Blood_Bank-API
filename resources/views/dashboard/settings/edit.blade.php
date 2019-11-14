@extends('layouts.dashboard.app')

@section('title')
@lang('site.settings')
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
              <li class="breadcrumb-item active">@lang('site.settings')</li>
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
              <h3 class="card-title">@lang('site.settings')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="cp-form" action="{{ route('dashboard.settings.update', $setting->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}


                    <div class="row">
                        <div class="form-group col-md-6">
                            <div id="title_div">
                                <label>@lang('site.title')*</label>
                                <span id="title_div_inside"></span>
                                <input type="text" name="title" class="form-control" value="{{ $setting->title }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="logo_div">
                                <label>@lang('site.logo')</label>
                                <span id="logo_div_inside"></span>
                                <input type="file" name="logo" class="form-control image">
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="form-group">
                        <div id="about_us_div">
                            <label>@lang('site.about_us')*</label>
                            <span id="about_us_div_inside"></span>
                            <textarea class="textarea" name="about_us" class="form-control">{{ $setting->about_us }}</textarea>
                        </div>
                    </div>

                    <!-- start row -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div id="phone_div">
                                <label>@lang('site.phone')*</label>
                                <span id="phone_div_inside"></span>
                                <input type="number" name="phone" class="form-control" value="{{ $setting->phone }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="facebook_url_div">
                                <label>@lang('site.facebook_url')</label>
                                <span id="facebook_url_div_inside"></span>
                                <input type="text" name="facebook_url" class="form-control" value="{{ $setting->facebook_url }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="twitter_url_div">
                                <label>@lang('site.twitter_url')</label>
                                <span id="twitter_url_div_inside"></span>
                                <input type="text" name="twitter_url" class="form-control" value="{{ $setting->twitter_url }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="instagram_url_div">
                                <label>@lang('site.instagram_url')</label>
                                <span id="instagram_url_div_inside"></span>
                                <input type="text" name="instagram_url" class="form-control" value="{{ $setting->instagram_url }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div id="youtube_url_div">
                                <label>@lang('site.youtube_url')</label>
                                <span id="youtube_url_div_inside"></span>
                                <input type="text" name="youtube_url" class="form-control" value="{{ $setting->youtube_url }}">
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i> @lang('site.setting')
                        </button>
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
