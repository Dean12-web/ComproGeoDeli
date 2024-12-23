@include('cms.login.header')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b><span class="text-success">GEO</span>DELI</b> CMS</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form action="{{ route('cms.login') }}" method="POST">
            @csrf
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-success btn-block btn-flat"><span
                            class="text-dark">Login</span></button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        @if (session()->has('LoginError'))
            <p class="text-red text-center">{{ session('LoginError') }}</p>
        @endif
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@include('cms.login.footer')
