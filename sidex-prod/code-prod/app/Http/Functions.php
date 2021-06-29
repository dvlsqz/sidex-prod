<?php
    function getUnitsArray(){
        $a = [
            '0' => 'Unidad Hospitalaria',
            '1' => 'Unidad Departamental'
        ];

        return $a;
    }

    function getRoleUserArray($mode, $id){
        $roles = [
            '0' => 'Administrador del Sistema',
            '1' => 'Administrador de Unidad',
            '2' => 'Digitador'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getUserStatusArray($mode, $id){
        $status = [
            '0' => 'Suspendido',
            '1' => 'Activo'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Key Value From JSON
    function kvfj($json, $key){
        if($json == null):
            return null;
        else:
            $json = $json;
            $json = json_decode($json, true);

            if(array_key_exists($key, $json)):
                return $json[$key];
            else:
                return null;
            endif;
        endif;
    }

    function user_permissions(){
        $p = [
            'home' => [
                'icon' => '<i class="fas fa-house-user"></i> ',
                'title' => 'Modulo de Inicio', 
                'keys' => [
                    'home' => 'Puede ver y regresar al apartado publico.'
                ]
            ],
            'dashboard' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Modulo de Dashboard',
                'keys' => [
                    'dashboard' => 'Puede ver el dashboard.',
                    'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.'
                ]
            ],
            'municipalities' => [
                'icon' => '<i class="fas fa-globe-americas"></i>',
                'title' => 'Modulo de Municipios',
                'keys' => [
                    'municipalities' => 'Puede ver el listado de municipios del Pais.'
                ]
            ],
            'units' => [
                'icon' => '<i class="fas fa-hospital-user"></i>',
                'title' => 'Modulo de Unidades Medicas o Departamentales',
                'keys' => [
                    'units' => 'Puede ver el listado de unidades.',
                    'unit_add' => 'Puede agregar nuevas unidades.',
                    'unit_edit' => 'Puede editar unidades.',
                    'unit_delete' => 'Puede eliminar unidades.',
                    'unit_search' => 'Puede buscar unidades.'
                ]
            ],
            'services' => [
                'icon' => '<i class="fas fa-laptop-house"></i>',
                'title' => 'Modulo de Servicios',
                'keys' => [
                    'services' => 'Puede ver el listado de servicios.',
                    'service_add' => 'Puede agregar nuevos servicios.',
                    'service_edit' => 'Puede editar servicios.',
                    'service_delete' => 'Puede eliminar servicios.',
                    'service_search' => 'Puede buscar servicios.'
                ]
            ],
            'telephone_extensions' => [
                'icon' => '<i class="fas fa-phone-square-alt"></i>',
                'title' => 'Modulo de Extensiones Telefonicas',
                'keys' => [
                    'telephone_extensions' => 'Puede ver el listado de extensiones telefonicas.',
                    'telephone_extension_add' => 'Puede agregar nuevas extensiones telefonicas.',
                    'telephone_extension_edit' => 'Puede editar extensiones telefonicas.',
                    'telephone_extension_location_edit' => 'Puede editar la ubicación de las extensiones telefonicas.',
                    'telephone_extension_status_edit' => 'Puede editar el estado de las extensiones telefonicas.',
                    'telephone_extension_delete' => 'Puede eliminar extensiones telefonicas.',
                    'telephone_extension_search' => 'Puede buscar extensiones telefonicas.'
                ]
            ],
            'reports' => [
                'icon' => '<i class="fas fa-house-user"></i> ',
                'title' => 'Modulo de Reportes',
                'keys' => [
                    'reports' => 'Puede ver el listado de reportes.',
                    'report_informatica' => 'Puede generar un reporte de informatica.',
                    'report_user' => 'Puede generar un reporte de extensiones.',
                    'report_bitacora' => 'Puede generar un reporte de bitacora del sistema.'
                ]
            ],
            'bitacoras' => [
                'icon' => '<i class="fas fa-clipboard-list"></i> ',
                'title' => 'Modulo de Bitacoras',
                'keys' => [
                    'bitacoras' => 'Puede ver el listado de bitacoras.'
                ]
            ],
            'users' => [
                'icon' => '<i class="fas fa-user-lock"></i> ',
                'title' => 'Modulo de Usuarios',
                'keys' => [
                    'user_list' => 'Puede ver el listado de usuarios.',
                    'user_add' => 'Puede agregar nuevos usuarios.',
                    'user_edit' => 'Puede editar usuarios.',
                    'user_search' => 'Puede buscar usuarios.',
                    'user_banned' => 'Puede suspender usuarios.',
                    'user_delete' => 'Puede eliminar usuarios.',
                    'user_reset_password' => 'Puede restablecer contraseña de usuarios.',
                    'user_permissions' => 'Puede administrar los permisos de los usuarios.',
                    'user_assignments' => 'Puede administrar las asignacion de los usuarios.',
                    'user_assignments_units' => 'Puede asignar unidades a los usuarios.',
                    'user_assignments_services' => 'Puede asignar servicios a los usuarios.',
                    'user_assignments_delete' => 'Puede eliminar asignaciones de los usuarios.'
                ]
            ],
            'settings' => [
                'icon' => '<i class="fas fa-cogs"></i> ',
                'title' => 'Modulo de Configuraciones',
                'keys' => [
                    'settings' => 'Puede modicar la configuración.'
                ]
            ]

        ];

        return $p;
    }

    function getUserYears(){
        $ya = date('Y');
        $ym = $ya - 18;
        $yo = $ym - 62;

        return [$ym, $yo];
    }

    function getMonths($mode, $key){
        $m = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];

        if($mode == "list"){
            return $m;
        }else{
            return $m[$key];
        }
    }

?>