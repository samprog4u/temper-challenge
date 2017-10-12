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
                  <p class="custom_error">{{$errors->first('specialization')}}</p>
                  <p class="custom_error">{{$errors->first('job_interest')}}</p>
                  <?php if(Session::get('message')) { ?>
                  <p class="custom_success" align="center"><?php echo Session::get('message'); ?></p>
                  <?php } ?>
                  <?php if(Session::get('error')) { ?>
                  <p class="custom_error" align="center"><?php echo Session::get('error'); ?></p>
                  <?php } ?>
                  <form id="register-form" action="{{action('RegisterController@job_interested')}}" method="post">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="specialization" class="label-material">{{ trans('app_lang.job_specialization') }}</label>
                          <select name="specialization" required class="form-control" id="specialization">
                          <option value="1">{{ trans('app_lang.select') }}</option>
                          <option value="1">Accounting / Audit / Tax</option>
                          <option value="2">Administration &amp; Office Support</option>
                          <option value="3">Agriculture/Farming</option>
                          <option value="4">Banking / Finance / Insurance</option>
                          <option value="5">Building Design/Architecture</option>
                          <option value="6">Construction</option>
                          <option value="7">Consulting/Business Strategy &amp; Planning</option>
                          <option value="8">Creatives(Arts, Design, Fashion)</option>
                          <option value="9">Customer Service</option>
                          <option value="10">Education/Teaching/Training</option>
                          <option value="11">Engineering</option>
                          <option value="12">Executive / Top Management</option>
                          <option value="13">Healthcare / Pharmaceutical </option>
                          <option value="14">Hospitality / Leisure / Travels</option>
                          <option value="15">Human Resources</option>
                          <option value="16">Information Technology</option>
                          <option value="17">Legal</option>
                          <option value="18">Logistics / Transportation</option>
                          <option value="19">Manufacturing / Production</option>
                          <option value="20">Marketing / Advertising / Communications</option>
                          <option value="21">NGO/Community Services &amp; Dev</option>
                          <option value="22">Oil&amp;Gas / Mining / Energy</option>
                          <option value="23">Project / Programme Management </option>
                          <option value="24">QA&amp;QC / HSE</option>
                          <option value="25">Real Estate / Property</option>
                          <option value="26">Research</option>
                          <option value="27">Sales/Business Development</option>
                          <option value="28">Supply Chain / Procurement</option>
                          <option value="29">Telecommunications</option>
                          <option value="30">Vocational Trade and Services</option>
                          </select>
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="job_interest" class="label-material">{{ trans('app_lang.job_interest') }}</label>
                          <textarea name="job_interest" required class="form-control" id="job_interest"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-5">
                        <div class="form-group">
                          <input id="proceed" type="submit" value="Proceed" class="btn btn-primary">
                        </div>
                      </div>
                    </div>
                  </form>
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