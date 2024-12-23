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
                <li><a href="{{ route('cms.users') }}"><i class="fa fa-users"></i> Users</a></li>
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
                <form class="form-horizontal" action="{{ route('cms.store-user') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" placeholder="Username"
                                    name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="role_user" id="role_user">
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px">Tambah
                            Data</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
