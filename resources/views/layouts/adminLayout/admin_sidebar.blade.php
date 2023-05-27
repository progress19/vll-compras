       
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">

              <div class="logo-login">
                  <h3>COMPRAS - VLL</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/default-user.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Hola!</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menú</h3>
                <ul class="nav side-menu">
                  
                  <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-home"></i> Home </a></li>

                  <li><a><i class="fa fa-building-o" aria-hidden="true"></i> Solicitudes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/admin/agregar-sector') }}">Nueva solicitud</a></li>
                      <li><a href="{{ url('/admin/ver-sectores') }}">Listado</a></li>
                    </ul>
                  </li>

                  @if(Auth::user()->rol == 1) 
                  <li><a><i class="fa fa-building-o" aria-hidden="true"></i> Centros de costos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/admin/agregar-sector') }}">Nuevo centro</a></li>
                      <li><a href="{{ url('/admin/ver-sectores') }}">Listado</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/admin/agregar-usuario') }}">Nuevo usuario</a></li>
                      <li><a href="{{ url('/admin/ver-usuarios') }}">Listados</a></li>
                    </ul>
                  </li>
                  @endif


                </ul>
              </div>

            </div> 
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}" style="width: 100%;">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

