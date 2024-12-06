@extends('admin-layouts.master')

@section('title', 'CMS Users')

@section('content')
    <div class="content-wrapper" style="min-height: 1136.28px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('cms.users')}}"><i class="fa fa-users"></i> Users</a></li>
                <li><a href="#">Tambah user</a></li>


            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Data User</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px">Tambah Data</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </section>
    </div>
@endsection
