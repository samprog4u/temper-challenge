@extends('layouts.master')
@section('content')
<!-- Page Header-->
<script type="text/javascript">
  var res;
</script>
<header class="page-header">
<div class="container-fluid">
  <h2 class="no-margin-bottom">{{ trans('app_lang.dashboard') }}</h2>
</div>
</header>
<!-- Dashboard Counts Section-->

<!-- Dashboard Header Section    -->
<section class="dashboard-header">
<div class="container-fluid">
  <div class="row">
    <!-- Statistics -->
    <!-- <div class="statistics col-lg-3 col-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow">
        <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
        <div class="text"><strong>234</strong><br><small>Applications</small></div>
      </div>
      <div class="statistic d-flex align-items-center bg-white has-shadow">
        <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
        <div class="text"><strong>152</strong><br><small>Interviews</small></div>
      </div>
      <div class="statistic d-flex align-items-center bg-white has-shadow">
        <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
        <div class="text"><strong>147</strong><br><small>Forwards</small></div>
      </div>
    </div> -->
    <!-- Line Chart            -->
    <div class="chart col-lg-12 col-12">
      <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow">
        <?php
          $gva = "[";
         foreach($data as $dat) {
           $gva .= $dat->percent . ",";
         } 
         $gva .= "]";
        ?>
        <script type="text/javascript">
            var res = <?php echo $gva; ?>;
        </script>
        <canvas id="lineCahrt"></canvas>
      </div>
    </div>
  </div>
</div>
</section>



@stop()