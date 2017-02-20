<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('home');
});
Route::get('/admin', function () {
    return view('home');
});
Route::group(['prefix'=>'admin'],function(){

    Route::get('Principal','HomeController@admin');
    Route::resource('usuarios','UsuariosController');
    Route::post('consultauser',['as'=>'consultauser','uses'=>'UsuariosController@ComprobarUser']);
    Route::get('getUser','UsuariosController@getUser');
    Route::resource('areas','AreasController');
    Route::get('getArea','AreasController@getArea');
    Route::resource('personal','PersonasController');
    Route::get('getPersonal','PersonasController@getPersonal');
    Route::get('personal/{personal}/edit2',['as'=>'personal.edit2','uses'=>'PersonasController@edit2']);
    Route::resource('equipos','FichaTecnicasController');
    Route::get('getEquipos','FichaTecnicasController@getEquipos');
    Route::post('update2/{id}','FichaTecnicasController@update2');
    Route::resource('asignacion','AsignarMaquinariasController');
    Route::get('getAsignacion','AsignarMaquinariasController@getAsignacion');
    Route::get('asignacion/{asignacion}/edit2',['as'=>'asignacion.edit2','uses'=>'AsignarMaquinariasController@edit2']);
    Route::resource('mantenimientos','MantenimientosController');
    Route::get('getMantenimientos','MantenimientosController@getMantenimientos');
    Route::get('getMantenimientos_historial','MantenimientosController@getMantenimientos_historial');
    Route::get('getMantenimientos_Interno','MantenimientosController@getMantenimientos_Interno');
    Route::get('getMantenimientos_Proveedor','MantenimientosController@getMantenimientos_Proveedor');
    Route::post('altaMantenimientos', 'MantenimientosController@altaMantenimientos');
    Route::get('HistorialMantenimientos','MantenimientosController@historialMantenimientos');
    Route::post('AddMantenimientoCorrectivo','MantenimientosController@AddMantenimientoCorrectivo');
    Route::get('calendario','EventCalendarioController@index');
    Route::get('calendario/{id}','EventCalendarioController@getNequipo');
    Route::get('cargaEventos{id?}','EventCalendarioController@eventos');
    Route::get('prueba','EventCalendarioController@prueba');
    Route::get('prueba2','EventCalendarioController@prueba2');
    Route::post('enviarCorreo','EventCalendarioController@enviarCorreo');
    Route::resource('Proveedores','ProveedoresController');
    Route::get('getProveedores','ProveedoresController@getProveedores');
    Route::resource('ordenTrabajo','OrdenTrabajoController');
    Route::get('getOrdenTrabajo','OrdenTrabajoController@getOrdenTrabajo');
    Route::get('OrdenTrabajoPDF/{id}','ReportesController@ImprimirOrdenTrabajo');
    Route::get('MantenimientoPDF/{id}','ReportesController@ImprimirMantenimiento');
    Route::get('Certificado/{id}','ReportesController@DescargarCertificado');


});
Route::group(['prefix'=>'operario'],function(){
    Route::get('Home','HomeController@operario');
    Route::resource('asignado','OperarioController');
    Route::get('reporteUso','OperarioController@reporteUso');
    Route::get('calendario','OperarioController@calendario');
    Route::get('cargaEvento{id?}','OperarioController@eventos');
    Route::get('getReportes','OperarioController@getReportes');
    Route::get('reporteUso/{reporteUso}/edit',['as'=>'reporteUso.edit','uses'=>'OperarioController@edit']);
    //Route::get('usoMaquinaria','UsoMaquinariaController@index');
});
Route::resource('usoMaquinaria','UsoMaquinariaController');


Route::get('/Inicio', 'HomeController@index');
Route::get('logout',[
    'as'=>'logout',
    'uses'=>'Auth\LoginController@logout']);

Route::post('login', 'Auth\LoginController@login');
Route::get('login',[
    'as'=>'login',
    'uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/vistaPDF', function () {

    //return view('reportesPDF.ReporteMantenimientos');
    return \PDF::loadView('reportesPDF.ReporteMantenimientos')->download('nombre-archivo.pdf');
});

//return view('reportesPDF.ReporteOrdenTrabajo');
//return \PDF::loadView('reportesPDF.ReporteOrdenTrabajo')->download('OrdenTrabajo.pdf');
