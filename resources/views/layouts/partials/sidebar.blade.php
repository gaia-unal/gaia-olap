<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            @if (! Auth::guest())

                @if (currentUser()->type == "Admin")
                    
                    <li class="header">Administrador</li>
                    <li class="active"><a href="{{ route('Admin.index') }}"><i class='fa fa-link'></i> <span>Sección Administrador</span></a></li>
                    <li><a href="{{ route('Admin.user.index') }}"><i class='fa fa-link'></i> <span>Usuario</span></a></li>
                @endif

                <li class="header">Creador</li>
                <li><a href="{{ route('Creator.index') }}"><i class='fa fa-link'></i> <span>Sección Creador</span></a></li>
                <li><a href="{{ route('Creator.connection.index') }}"><i class='fa fa-link'></i> <span>Conexiones</span></a></li>

            @endif 

            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Pagina Publica</span> <i class="fa fa-angle-left pull-right"></i></a>


                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
