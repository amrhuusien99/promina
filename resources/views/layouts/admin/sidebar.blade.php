<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <li>
                <a href="{{route('admin/index')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Albums<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin/albums/index')}}/0/{{PAGINATION_COUNT}}">Albums</a>
                    </li>
                    <li>
                        <a href="{{route('admin/albums/create')}}">Add Album</a>
                    </li>
                    <li>
                        <a href="{{route('admin/albums/archives')}}/0/{{PAGINATION_COUNT}}">Archives</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
