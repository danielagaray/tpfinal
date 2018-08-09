<li class="header">MENU PROFESIONAL</li>

<li><a href="{{url('/home')}}"><i class="fa fa-home"></i><span>Inicio</span></a></li>
<li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-bullhorn"></i>
    <span>Alertas</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{url('/alert/new')}}"><i class="fa fa-plus-square"></i> Generar Alerta</a></li>
    <li><a href="{{url('/alert/list')}}"><i class="fa fa-list"></i> Listado</a></li>
    <li><a href="{{url('/alert/map')}}"><i class="fa fa-map"></i> Ver Mapa</a></li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-user"></i>
    <span>Asistidos</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">    
    <li><a href="{{url('/asistido/new')}}"><i class="fa fa-user-plus"></i> Dar de alta Asistido</a></li>
    <li><a href="{{url('/asistido/list')}}"><i class="fa fa-list"></i> Listado</a></li>
  </ul>
</li>
