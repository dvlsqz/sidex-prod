<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{url('static/imagenes/Isotipo.png')}}" class="img-fluid">
        </div>

        <div class="user">
            <span class="subtitle">Bienvenido: {{ Auth::user()->name }} {{ Auth::user()->lastname }}</span> <br>
            <span class="subtitle">IBM: {{ Auth::user()->ibm }} </span> 
            <div class="salir">
                Salir
                <a href="{{url('/logout')}}" data-toogle="tooltrip" data-placement="top" title="Salir">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions, 'home')) 
                <li>
                    <a href="{{ url('/inicio/todas') }}" class="lk-home"><i class="fas fa-house-user"></i> Inicio</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'dashboard'))
                <li>
                    <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'municipalities'))
                <li>
                    <a href="{{ url('admin/municipalities') }}" class="lk-municipalities"><i class="fas fa-globe-americas"></i> Municipios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'units'))
                <li>
                    <a href="{{ url('admin/units/0') }}" class="lk-units lk-unit_add lk-unit_edit lk-unit_delete"><i class="fas fa-hospital-user"></i> Unidades</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'services'))
                <li>
                    <a href="{{ url('/admin/services') }}" class="lk-services lk-service_add lk-service_edit lk-service_delete"><i class="fas fa-laptop-house"></i> Servicios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'telephone_extensions'))
                <li>
                    <a href="{{ url('/admin/telephone_extensions/1') }}" class="lk-telephone_extensions lk-telephone_extension_add lk-telephone_extension_search lk-telephone_extension_edit lk-telephone_extension_delete "><i class="fas fa-phone-square-alt"></i> Extensiones Telefonicas</a>
                </li>
            @endif

            <!--@if(kvfj(Auth::user()->permissions, 'reports'))
                <li>
                    <a href="{{ url('/admin/reports') }}" class="lk-reports lk-report_informatica lk-report_user lk-report_bitacora "><i class="fas fa-file-pdf"></i> Reportes</a>
                </li>
            @endif -->

            @if(kvfj(Auth::user()->permissions, 'bitacoras'))
                <li>
                    <a href="{{ url('/admin/bitacoras') }}" class="lk-bitacoras "><i class="fas fa-clipboard-list"></i> Bitacoras</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_list'))
                <li>
                    <a href="{{ url('/admin/users/all') }}" class="lk-user_add lk-user_list lk-user_edit lk-user_permissions lk-user_assignments"><i class="fas fa-user-lock"></i> Usuarios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'settings'))
                <li>
                    <a href="{{ url('/admin/settings') }}" class="lk-settings"><i class="fas fa-cogs"></i> Configuraciones</a>
                </li>
            @endif
        </ul>
    </div>

</div>