@extends('layouts.master')
@section('content')
<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">{{ trans('app_lang.users') }}</h2>
  </div>
</header>
<!-- Breadcrumb-->
<ul class="breadcrumb">
  <div class="container-fluid">
    <?php if($stages){ ?>
    <?php foreach ($stages as $stage) { ?>
    <li class="breadcrumb-item" style="color:#000">Stage {{$stage->stages}} => <strong>{{$stage->description}}</strong></li>
    <?php } ?>
    <?php } ?>
  </div>
</ul>
<section class="tables">   
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">{{ trans('app_lang.list_users') }}</h3>
          </div>
          <div class="card-body">
            <?php
            if(Session::get('error'))
            {
            ?>
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            <?php
            }
            if(Session::get('message'))
            {
            ?>
                <div class="alert alert-success">{{Session::get('message')}}</div>
            <?php
            }
            ?>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>{{ trans('app_lang.date_created') }}</th>
                  <th>{{ trans('app_lang.firstname') }}</th>
                  <th>{{ trans('app_lang.lastname') }}</th>
                  <th>{{ trans('app_lang.email') }}</th>
                  <th>{{ trans('app_lang.stage') }}</th>
                  <th>{{ trans('app_lang.action') }}</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $sn = 1;
                if($users)
                {
                  foreach ($users as $user) {
              ?>
                  <tr>
                    <th scope="row">{{$sn}}</th>
                    <td>{{$user->date_created}}</td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>Stage {{$user->status}}</td>
                    <?php if($user->status == 8) {?>
                    <td><div class="btn btn-sm btn-success">Approved</div></td>
                    <?php } else { ?>
                    <td><?php echo ($user->status == 7 ? "<a onClick=\"return confirm('" . trans('app_lang.alert_x_approve') . "')\" href='approve/$user->id' title='Approve User'><div class='btn btn-sm btn-success'><i class='fa fa-check'></i></div></a>" : "<div class='btn btn-sm btn-danger'>Pending</div>") ?></td>
                    <?php } ?>
                  </tr>
              <?php $sn += 1; }
                }
               ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@stop()