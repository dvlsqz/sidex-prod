<?php

    Route::prefix('/admin')->group(function(){ 

        //Dashboard
        Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');

        //Municipalities
        Route::get('/municipalities','Admin\MunicipalitiesController@getMunicipality')->name('municipalities');

        //Units
        Route::post('/unit/add', 'Admin\UnitsController@postUnitAdd')->name('unit_add');
        Route::get('/units/{type}', 'Admin\UnitsController@getHome')->name('units');        
        Route::get('/unit/{id}/edit', 'Admin\UnitsController@getUnitEdit')->name('unit_edit');
        Route::post('/unit/{id}/edit', 'Admin\UnitsController@postUnitEdit')->name('unit_edit');
        Route::get('/unit/{id}/delete', 'Admin\UnitsController@getUnitDelete')->name('unit_delete');

        //Services
        Route::get('/services', 'Admin\ServicesController@getHome')->name('services'); 
        Route::post('/service/add', 'Admin\ServicesController@postServiceAdd')->name('service_add');
        Route::get('/service/{id}/edit', 'Admin\ServicesController@getServiceEdit')->name('service_edit');
        Route::post('/service/{id}/edit', 'Admin\ServicesController@postServiceEdit')->name('service_edit');
        Route::get('/service/{id}/delete', 'Admin\ServicesController@getServiceDelete')->name('service_delete');

        //Telephone Extensions
        Route::get('/telephone_extension/add', 'Admin\TelephoneExtensionController@getTelephoneExtensionAdd')->name('telephone_extension_add');
        Route::post('/telephone_extension/add', 'Admin\TelephoneExtensionController@postTelephoneExtensionAdd')->name('telephone_extension_add');
        Route::get('/telephone_extensions/{status}', 'Admin\TelephoneExtensionController@getTelephoneExtensions')->name('telephone_extensions');
        Route::post('/telephone_extension/search', 'Admin\TelephoneExtensionController@postTelephoneExtensionSearch')->name('telephone_extension_search');
        Route::get('/telephone_extension/{id}/edit', 'Admin\TelephoneExtensionController@getTelephoneExtensionEdit')->name('telephone_extension_edit');
        Route::post('/telephone_extension/{id}/edit', 'Admin\TelephoneExtensionController@postTelephoneExtensionEdit')->name('telephone_extension_edit');
        Route::get('/telephone_extension/{id}/delete', 'Admin\TelephoneExtensionController@getTelephoneExtensionDelete')->name('telephone_extension_delete');
        Route::get('/telephone_extension/{id}/restore', 'Admin\TelephoneExtensionController@getTelephoneExtensionRestore')->name('telephone_extension_delete');
        
        //Reports
        Route::get('/reports','Admin\ReportController@getReport')->name('reports');
        Route::get('/report_bitacora','Admin\ReportController@getReportBitacora')->name('report_bitacora');
        Route::get('/report_listado_extensiones','Admin\ReportController@getReportUser')->name('report_user');        
        Route::get('/report_informatica','Admin\ReportController@getReporInformatica')->name('report_informatica');

        //Bitacora
        Route::get('/bitacoras','Admin\BitacoraController@getBitacora')->name('bitacoras');

        //Users
        Route::get('/users/add', 'Admin\UserController@getUserAdd')->name('user_add');
        Route::post('/users/add', 'Admin\UserController@postUserAdd')->name('user_add');
        Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');
        Route::get('/user/{id}/edit', 'Admin\UserController@getUserEdit')->name('user_edit');
        Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name('user_edit');
        Route::post('/user/search', 'Admin\UserController@postUserSearch')->name('user_search');
        Route::post('/user/{id}/reset_password','Admin\UserController@postResetPassword')->name('user_reset_password');
        Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
        Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
        Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');
        Route::get('/user/{id}/assignments_units', 'Admin\UserController@getUserAssignmentsUnits')->name('user_assignments');
        Route::post('/user/{id}/assignments_units', 'Admin\UserController@postUserAssignmentsUnits')->name('user_permissions');
        Route::get('/user/assignments/unit/{id}/delete', 'Admin\UserController@getUserAssignmentsUnitDelete')->name('service_delete');
        Route::get('/user/{id}/assignments_services', 'Admin\UserController@getUserAssignmentsServices')->name('user_assignments');        
        Route::post('/user/{id}/assignments_services', 'Admin\UserController@postUserAssignmentsServices')->name('user_permissions');
        Route::get('/user/assignments/service/{id}/delete', 'Admin\UserController@getUserAssignmentsServiceDelete')->name('service_delete');
        
        //Settings
        Route::get('/settings','Admin\SettingsController@getHome')->name('settings');
        Route::post('/settings','Admin\SettingsController@postHome')->name('settings');
    });