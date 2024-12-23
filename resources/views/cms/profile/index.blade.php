@extends('admin-layouts.master')

@section('title', 'CMS Service')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pengaturan akun
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-uaser"></i> Pengaturan akun</li>
            </ol>
        </section>
        <section class="content">

            <div class="box box-success">
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('cms.changepassword') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username" value="{{ $profile->username }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="oldpassword" class="col-sm-2 control-label">Old Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newpassword" class="col-sm-2 control-label">New Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="newpassword" name="newpassword"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="col-sm-2 control-label">Retype Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirmpassword"
                                    name="newpassword_confirmation" placeholder="Confrim password">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </section>
    </div>
@stop
