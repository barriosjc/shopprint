<?php

use App\Models\ProductosNota;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\FormasPagoController;
use App\Http\Controllers\ProductosFotoController;
use App\Http\Controllers\ProductosNotaController;
use App\Http\Controllers\seguridad\RoleController;
use App\Http\Controllers\OrdenesController;
use App\Http\Controllers\ModificadoresTipoController;
use App\Http\Controllers\seguridad\ProfileController;
use App\Http\Controllers\seguridad\UsuarioController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\seguridad\PermisosController;
use App\Http\Controllers\ModificadoresOpcioneController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ProductosAdicionalDefController;
use App\Http\Controllers\ProductosRestriccioneController;
use App\Http\Controllers\ProductosAdicionalDefSelectController;
use App\Models\Tickets;

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

Auth::routes();

Route::get('/wellcome', function () {
    return view('wellcome');
});

Route::get('login/restablecer'            , [ResetPasswordController::class, 'restablecer'])->name('login.restablecer');
Route::post('login/email'                 , [ResetPasswordController::class, 'email'])->name('login.email');
//Route::get('login/register', [RegisterController::class, 'create'])->name('login.register');
Route::get('clientes/create/{origen}'     , [ClienteController::class, 'create'])->name('clientes.create');
Route::post('clientes/{origen}'           , [ClienteController::class, 'store'])->name('clientes.store');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//carrito
    Route::get('/maquetados/{nombre}', [HomeController::class, 'maquetado'])->name('maquetado');


    Route::get('cart/entrega'              , [CartController::class, 'entrega'])->name('cart.entrega');
    Route::post('cart/entrega/store'       , [CartController::class, 'entrega_save'])->name('cart.entrega.save');
    Route::get('cart/confirm'              , [CartController::class, 'confirm'])->name('cart.confirm');
    Route::get('cart/pago'                 , [CartController::class, 'pago'])->name('cart.pago');
    Route::post('cart/pago/formapago'      , [CartController::class, 'forma_pago'])->name('cart.formapago');
    Route::post('cart/pago/envio/{op}'     , [CartController::class, 'stripePost'])->name('cart.post');
    Route::post('cart/pago/store'          , [CartController::class, 'pago_save'])->name('cart.pago.save');
    Route::get('cart/review/{id}'          , [CartController::class, 'review'])->name('cart.review');
    Route::post('cart/descuento'           , [CartController::class, 'descuento'])->name('cart.descuento');

    Route::get('cart'                     , [CartController::class, 'cart'])->name('cart.index');
    Route::post('cart/add'                , [CartController::class, 'add'])->name('cart.store');
    Route::post('cart/update'             , [CartController::class, 'update'])->name('cart.update');
    Route::post('cart/remove'             , [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/clear'              , [CartController::class, 'clear'])->name('cart.clear');
    Route::get('cart/copy/{id}'           , [CartController::class, 'copiarOC'])->name('cart.copy');

    //clientes
    Route::get('clientes'                          , [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('clientes/{producto}'               , [ClienteController::class, 'show'])->name('clientes.show');
    Route::patch('clientes/{id}/{origen}'          , [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('clientes/{producto}'            , [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::get('clientes/{producto}/edit/{origen}' , [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::get('clientes/habilitar/nuevo'          , [ClienteController::class, 'habilitar'])->name('clientes.habilitar');


//Route::group(['middleware' => ['can:abm clientes']], function () {   
    Route::resource('notas'                        , ProductosNotaController::class);
    Route::resource('restricciones'                , ProductosRestriccioneController::class);
    Route::resource('modificadores/opciones'       , ModificadoresOpcioneController::class);
    Route::resource('modificadores/tipos'          , ModificadoresTipoController::class);
    Route::get('modificador/opicones/lista/{id}'     , [ModificadoresOpcioneController::class, 'lista']);
    Route::post('modificador/tipos/update/{id}'      , [ModificadoresTipoController::class, 'update']);
    Route::post('modificador/opciones/update/{id}'   , [ModificadoresOpcioneController::class, 'update']);
    Route::post('restricciones/update/{id}'          , [ProductosRestriccioneController::class, 'update']);
    Route::post('notas/update/{id}'                  , [ProductosNotaController::class, 'update']);

    Route::resource('parametros'                  , ParametroController::class);
    Route::resource('categorias'                  , CategoriaController::class);
    Route::resource('descuentos'                  , DescuentoController::class);
    Route::resource('ProductosAdicionalDef'       , ProductosAdicionalDefController::class);
    Route::resource('ProductosAdicionalDefSelect' , ProductosAdicionalDefSelectController::class);
    Route::resource('formasPagos'                 , FormasPagoController::class);
    Route::post('categorias/{categoria}', [CategoriaController::class, 'restart'])->name('categorias.restart');
    //productos adicionales def 
    Route::get('productosadicionaldef/editar/{id}'      , [ProductosAdicionalDefController::class, 'editar']);
    Route::post('productosadicionaldef/update/{id}'      , [ProductosAdicionalDefController::class, 'update']);
    Route::delete('ProductosAdicionalDefSelect/delete/{id}'      , [ProductosAdicionalDefSelectController::class, 'destroy']);
 
    //productos
    Route::get('productos/index'                , [ProductoController::class, 'index'])->name('productos.index');
    Route::post('productos'                     , [ProductoController::class, 'store'])->name('productos.store');
    Route::get('productos/create'               , [ProductoController::class, 'create'])->name('productos.create');
    Route::get('productos/{producto}'           , [ProductoController::class, 'show'])->name('productos.show');
    Route::patch('productos/{producto}'         , [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('productos/{producto}'        , [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('productos/{producto}/edit'      , [ProductoController::class, 'edit'])->name('productos.edit');
    Route::post('productos/restart/{producto}'  , [ProductoController::class, 'restart'])->name('productos.restart');
   
    //productos vistas fromt
    Route::get('productos/list/{id}'            , [ProductoController::class, 'list'])->name('productos.list');
    Route::get('productos/detail/{id}'          , [ProductoController::class, 'detalle'])->name('productos.detalle');
    
    //fotos
    Route::get('productos/fotos/index/{producto}'          , [ProductosFotoController::class, 'index'])->name('productos.fotos.index');
    Route::post('productos/fotos'                          , [ProductosFotoController::class, 'store'])->name('productos.fotos.store');
    Route::get('productos/fotos/create/{producto}'         , [ProductosFotoController::class, 'create'])->name('productos.fotos.create');
    Route::get('productos/fotos/{producto}'                , [ProductosFotoController::class, 'show'])->name('productos.fotos.show');
    Route::patch('productos/fotos/{producto}'              , [ProductosFotoController::class, 'update'])->name('productos.fotos.update');
    Route::delete('productos/fotos/{id}/{producto}'        , [ProductosFotoController::class, 'destroy'])->name('productos.fotos.destroy');
    Route::get('productos/fotos/{producto}/edit'           , [ProductosFotoController::class, 'edit'])->name('productos.fotos.edit');

    //usuarios y seguridad
    Route::resources([
        'usuario' => UsuarioController::class,
        'roles' => RoleController::class,
        'permisos' => permisosController::class,
    ]);


    Route::get('profile/{id}/editar'  , [ProfileController::class, 'index'])->name('profile');
    Route::post('foto/profile/guardar', [ProfileController::class, 'foto'])->name('profile.foto');
    Route::post('profile'             , [ProfileController::class, 'save'])->name('profile.save');
    Route::get('profile/{id}/readonly', [ProfileController::class, 'readonly'])->name('profile.readonly');

    //grupo de mi perfil
    Route::get('front/profile'          , [ProfileController::class, 'profile'])->name('front.profile');
    Route::get('front/change/pass'      , [ProfileController::class, 'pass_change'])->name('front.change.pass');
    Route::post('pasword/profile'       , [ProfileController::class, 'save_password'])->name('profile.password.save');
    Route::get('front/orders/open'      , [OrdenesController::class, 'abiertas'])->name('front.ordenes.open');
    Route::get('front/orders/history'   , [OrdenesController::class, 'historial'])->name('front.ordenes.history');
    Route::get('front/tickets'          , [TicketsController::class, 'index'])->name('front.tickets');
    
    // ordenes de compras
    Route::get('orders/{tipo}'                   , [OrdenesController::class, 'back_index'])->name('orders.list');
    Route::get('orders/detail/{id}/{activo}'     , [OrdenesController::class, 'details'])->name('orders.detail');
    Route::get('orders/product/{id}/{activo}'    , [OrdenesController::class, 'product_details'])->name('orders.detail.product');
    Route::get('tickets/{activo}/{id}'           , [TicketsController::class, 'index'])->name('tickets');
    Route::post('tickets/save'                   , [TicketsController::class, 'save'])->name('tikets.save');
    Route::get('tickets/cant/{id}/{origen}'      , [TicketsController::class, 'traer_cant_msg'])->name('tickets.cantidad');
    Route::get('tickets/cant/oc/{id}/{origen}'   , [TicketsController::class, 'traer_cant_msg_oc'])->name('tickets.cantidad.orden');
    Route::get('ordenes/filtrar'        , [OrdenesController::class, 'filtrar'])->name('ordenes.filtrar');

    // ordenes back
    // Route::get('orders/{tipo}'                   , [OrdenesController::class, 'back_index'])->name('orders.list');
    Route::get('back/orders/detail/{id}/{activo}'     , [OrdenesController::class, 'back_details'])->name('back.orders.detail');
    Route::get('back/orders/product/{id}/{activo}'    , [OrdenesController::class, 'back_product_details'])->name('back.orders.detail.product');
    Route::get('back/tickets/{activo}/{id}'           , [TicketsController::class, 'back_index'])->name('back.tickets');
    Route::post('back/orden/cambiar/entrega'          , [OrdenesController::class, 'back_entrega'])->name('back.fecha.entrega');
    Route::post('back/orden/cambiar/estado'           , [OrdenesController::class, 'back_estado'])->name('back.orden.estado');
    Route::post('back/orden/cambiar/estado/interno'   , [OrdenesController::class, 'back_estado_int'])->name('back.orden.estado.interno');
    Route::post('back/orden/detalle/cambiar/estado'   , [OrdenesController::class, 'back_detalle_estado'])->name('back.detalle.estado');
    Route::post('back/tickets/save'                   , [TicketsController::class, 'back_save'])->name('back.tikets.save');

    Route::post('usuario/restart/{producto}'  , [UsuarioController::class, 'restart'])->name('usuario.restart');
    // Route::get('usuario/{id}/roles/{rolid}/{tarea}'   , [UsuarioController::class, 'roles']);
    // Route::get('usuario/{id}/roles'                   , [UsuarioController::class, 'roles'])->name('usuarios.grupos');
    // Route::get('usuario/{id}/permisos/{perid}/{tarea}', [UsuarioController::class, 'permisos']);
    // Route::get('usuario/{id}/permisos'                , [UsuarioController::class, 'permisos']);

    // Route::get('roles/{id}/permisos/{perid}/{tarea}', [RoleController::class, 'permisos']);
    // Route::get('roles/{id}/permisos'                , [RoleController::class, 'permisos']);
    // Route::get('roles/{id}/usuarios/{usuid}/{tarea}', [RoleController::class, 'usuarios']);
    // Route::get('roles/{id}/usuarios'                , [RoleController::class, 'usuarios']);

    // Route::get('permisos/{id}/usuarios/{usuid}/{tarea}', [PermisosController::class, 'usuarios']);
    // Route::get('permisos/{id}/usuarios'                , [PermisosController::class, 'usuarios'])->name('permisos.usuarios');
    // Route::get('permisos/{id}/roles/{rolid}/{tarea}'   , [PermisosController::class, 'roles']);
    // Route::get('permisos/{id}/roles'                   , [PermisosController::class, 'roles'])->name('permisos.grupos');

});    
