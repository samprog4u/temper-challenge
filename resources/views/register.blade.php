<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Temper Challenge</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('assets/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>{{ trans('app_lang.temper_challenge') }}</h1>
                  </div>
                  <p>{{ trans('app_lang.temper_note') }}</p>
                  <img src="{{asset('assets/img/logo.png')}}" width="300px;" height="150px;">
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <p class="custom_error">{{$errors->first('firstname')}}</p>
                  <p class="custom_error">{{$errors->first('lastname')}}</p>
                  <p class="custom_error">{{$errors->first('email')}}</p>
                  <p class="custom_error">{{$errors->first('password')}}</p>
                  <?php if(Session::get('message')) { ?>
                  <p class="custom_success" align="center"><?php echo Session::get('message'); ?></p>
                  <?php } ?>
                  <?php if(Session::get('error')) { ?>
                  <p class="custom_error" align="center"><?php echo Session::get('error'); ?></p>
                  <?php } ?>
                  <form id="register-form" action="{{action('RegisterController@register')}}" method="post">
                    <div class="row">
                    <div class="col-lg-5">
                      <div class="form-group">
                        <input id="firstname" type="text" name="firstname" required class="input-material">
                        <label for="firstname" class="label-material">{{ trans('app_lang.firstname') }}</label>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      </div>
                      <div class="form-group">
                        <input id="email" type="email" name="email" required class="input-material">
                        <label for="email" class="label-material">{{ trans('app_lang.email') }}</label>
                      </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                      <div class="form-group">
                        <input id="lastname" type="text" name="lastname" required class="input-material">
                        <label for="lastname" class="label-material">{{ trans('app_lang.lastname') }}</label>
                      </div>
                      <div class="form-group">
                        <input id="passowrd" type="password" name="password" required class="input-material">
                        <label for="passowrd" class="label-material">{{ trans('app_lang.password') }}</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group terms-conditions">
                    <input id="license" type="checkbox" required="required" class="checkbox-template">
                    <label for="license">{{ trans('app_lang.agree_term') }}</label>
                  </div>
                  <input id="register" type="submit" value="Register" class="btn btn-primary">
                  </form><small>{{ trans('app_lang.already_member') }}? </small><a href="/auth/login" class="signup">{{ trans('app_lang.login') }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p>Design by <a href="http://squad.com.ng" class="external">Oloruntoba Samson</a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('assets/js/tether.min.js')}}"></script>
    <script src="{{asset('assets/js/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.cookie.js')}}"> </script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/front.js')}}"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>