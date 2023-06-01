<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\SectorController; 
use App\Http\Controllers\SolicitudController; 

Auth::routes();

//Route::match(['get', 'post'], '/admin', 'AdminController@login');
//Route::match(['get', 'post'], '/admin/login', 'AdminController@login');
//Route::match(['get', 'post'], '/login', 'AdminController@login')->name('login');

//Route::get('login', [AdminController::class, 'login']);
//Route::get('admin', [AdminController::class, 'login']);

Route::match(['get', 'post'], 'admin', [AdminController::class, 'login']);
Route::match(['get', 'post'], 'login', [AdminController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'logout', [AdminController::class, 'logout']);

Route::group(['middleware' => ['auth']], function () {
    
	Route::get('/', function () { return view('admin/dashboard'); });
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

	// Rutas solo para usuarios con rol 0
		Route::group(['middleware' => ['role:0']], function () {
	});

    
	/* ADMINISTRADOR */
	Route::group(['middleware' => ['role:1']], function () {

		/* DATATABLES */

		Route::get('dataUsuarios', [UsuarioController::class, 'getData'])->name('dataUsuarios');
		Route::get('dataSectores', [SectorController::class, 'getData'])->name('dataSectores');
		Route::get('dataSolicitudes', [SolicitudController::class, 'getData'])->name('dataSolicitudes');

		Route::get('/admin/settings', 'AdminController@settings');
		Route::get('/admin/edit-user', 'AdminController@editUser');
		Route::get('/admin/check-pwd','AdminController@chkPassword');
		Route::match(['get','post'], '/admin/update-pwd', 'AdminController@updatePassword');
		
		Route::get( 'admin/reset-pwd', [AdminController::class, 'resetPassword']);
	
		// Usuarios 
		Route::match(['get', 'post'], 'admin/agregar-usuario', [UsuarioController::class, 'addUsuario']);
		Route::match(['get','post'],'/admin/editar-usuario/{id}', [UsuarioController::class, 'editarUsuario']);
		Route::match(['get','post'],'/admin/eliminar-usuario/{id}', [UsuarioController::class, 'eliminarUsuario']);
		Route::get('/admin/ver-usuarios', [UsuarioController::class, 'viewUsuarios']);

        // Sectores 
        Route::match(['get', 'post'], 'admin/agregar-sector', [SectorController::class, 'addSector']);
        Route::match(['get', 'post'], '/admin/editar-sector/{id}', [SectorController::class, 'editSector']);
        Route::match(['get', 'post'], '/admin/eliminar-sector/{id}', [SectorController::class, 'deleteSector']);
        Route::get('/admin/ver-sectores', [SectorController::class, 'verSectores']);

		// Solicitudes
        Route::match(['get', 'post'], 'admin/nueva-solicitud', [SolicitudController::class, 'addSolicitud']);
        Route::match(['get', 'post'], '/admin/editar-solicitud/{id}', [SolicitudController::class, 'editSolicitud']);
        Route::match(['get', 'post'], '/admin/eliminar-solicitud/{id}', [SolicitudController::class, 'deleteSolicitud']);
        Route::get('/admin/ver-solicitudes', [SolicitudController::class, 'verSolicitudes']);

    });

});

