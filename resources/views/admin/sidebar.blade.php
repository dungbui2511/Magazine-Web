<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="<?= $page_tittle == 'Dashboard' ? 'active-link' : '';?>">
                <a href="{{url('admin')}}"><i class="fa fa-desktop "></i>Dashboard <span class="badge">Dashboard</span></a>
            </li>
            <li class="<?= $page_tittle == 'Posts' ? 'active-link' : '';?>">
                <a href="{{url('admin/posts')}}"><i class="fa fa-table "></i>Posts <span class="badge">Posts</span></a>
            </li>
            <li class="<?= $page_tittle == 'Categories' ? 'active-link' : '';?>">
                <a href="{{url('admin/categories')}}"><i class="fa fa-edit "></i>Categories <span class="badge">Categories</span></a>
            </li>
            <li class="<?= $page_tittle == 'Users' ? 'active-link' : '';?>">
                <a href="{{url('admin/users')}}"><i class="fa fa-user "></i>Users</a>
            </li>
            <!-- <li>
                <a href="#"><i class="fa fa-bar-chart-o"></i>My Link Two</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-edit "></i>My Link Three </a>
            </li>
            <li>
                <a href="#"><i class="fa fa-table "></i>My Link Four</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-edit "></i>My Link Five </a>
            </li> -->
        </ul>
    </div>

</nav>
<!-- /. NAV SIDE  -->