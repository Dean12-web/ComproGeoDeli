<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Main Navigation</li>
            <li class="{{ request()->routeIs('cms.dashboard') ? 'active' : '' }}">
                <a href="{{ route('cms.dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.users') ? 'active' : '' }}">
                <a href="{{route('cms.users')}}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.blogs') ? 'active' : '' }}">
                <a href="{{route('cms.blogs')}}">
                    <i class="fa fa-newspaper-o"></i> <span>Blog/News</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.contacts') ? 'active' : '' }}">
                <a href="{{route('cms.contact')}}">
                    <i class="fa fa-phone"></i> <span>Contacts</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.services') ? 'active' : '' }}">
                <a href="{{route('cms.services')}}">
                    <i class="fa fa-file-archive-o"></i> <span>Services</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.info') ? 'active' : '' }}">
                <a href="{{route('cms.info')}}">
                    <i class="fa fa-home"></i> <span>Company info</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.testimony') ? 'active' : '' }}">
                <a href="{{route('cms.testimony')}}">
                    <i class="fa fa-paw"></i> <span>Testimony</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.media') ? 'active' : '' }}">
                <a href="{{route('cms.media')}}">
                    <i class="fa fa-file-image-o"></i> <span>Media</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('cms.faqs') ? 'active' : '' }}">
                <a href="{{route('cms.faqs')}}">
                    <i class="fa fa-question"></i> <span>FAQs</span>
                </a>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
