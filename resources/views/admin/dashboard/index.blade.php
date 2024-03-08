@extends('admin.layouts.master')
@section('title' , __('admin_localize.Dashboard'))
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>{{__('admin_localize.Dashboard')}}</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.Total News')}}</h4>
            </div>
            <div class="card-body">
              {{$totalNews}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.Not Approved News')}}</h4>
            </div>
            <div class="card-body">
              {{$notApprovedNews}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-user-friends"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.Total Roles')}}</h4>
            </div>
            <div class="card-body">
              {{$totalRoles}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.Total Subscribers')}}</h4>
            </div>
            <div class="card-body">
              {{$totalSubscriber}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-language"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.Active Languages')}}</h4>
            </div>
            <div class="card-body">
              {{$activeLanguages}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-envelope"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.Total Contact Messages')}}</h4>
            </div>
            <div class="card-body">
              {{$totalContactMessages}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-eye-slash"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.Unseen Messages')}}</h4>
            </div>
            <div class="card-body">
              {{$unseenContactMessages}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-paper-plane"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{__('admin_localize.UnReplied Messages')}}</h4>
            </div>
            <div class="card-body">
              {{$unRepliedContactMessages}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
