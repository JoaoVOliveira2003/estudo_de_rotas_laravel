<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ExemploMiddleware;


/*
|--------------------------------------------------------------------------
| Tutorial das rotas
|--------------------------------------------------------------------------
|
| basicamente sempre é:
| Route::verbo(get, post, ...)('url', callback)
| Sendo o callback a ação que vai ser executada após chamar essa rota
|
| verbos são get, post, put...
|
*/


/*
|--------------------------------------------------------------------------
| Rotas com função anônima
|--------------------------------------------------------------------------
*/

Route::get('/rota', function () {
    return 'Oie';
});

Route::get('/insert', function (Request $request) {
    // $request é basicamente um get post das variaveis
    var_dump($request);
});

Route::match(['get', 'post'], '/insert', function (Request $request) {
    // $request é basicamente um get post das variaveis
    echo 'Aceita get e post';
});

Route::any('/any', function (Request $request) {
    return 'aceita qualquer coisa';
});


/*
|--------------------------------------------------------------------------
| Rotas chamando controllers
|--------------------------------------------------------------------------
*/

Route::get('/index', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);


/*
|--------------------------------------------------------------------------
| Redirects e Views
|--------------------------------------------------------------------------
*/

// da para redirecionar uma rota a outra
Route::redirect('saltar', 'index');
Route::permanentRedirect('saltar', 'index');

// Manda a view
Route::view('view', 'home');

// mandar a view com variaveis
Route::view('viewComDados', 'home', ['nome' => 'joao']);


/*
|--------------------------------------------------------------------------
| Aula 76 - Parâmetros de rota
|--------------------------------------------------------------------------
*/

Route::get('/valor/{value}', [MainController::class, 'mostrarValorRota']);
Route::get('/valor/{value1}/{value2}', [MainController::class, 'mostrarValoresRota']);
Route::get('/valor/{value1}/{value2}', [MainController::class, 'mostrarValoresRota2']);

Route::get('/valorOpcional/{value?}', [MainController::class, 'valorOpcional']);

// o primeiro valor é obrigatorio, mas o segundo n!
Route::get(
    '/valorOpcional2/{value1}/valorOpcional2/{value2}',
    [MainController::class, 'mostrarOpcional2']
);

Route::get('/user/{user_id}/post/{post_id}', [MainController::class, 'mostrarPosts']);


/*
|--------------------------------------------------------------------------
| Aula 77 - Route Parameters with Constraints
|--------------------------------------------------------------------------
|
| a-z  = aceita todas letras minusculas
| A-Z  = maiusculas
| 0-9  = numeros
|
*/

Route::get('/valor/{value}', function ($value) {
    echo $value;
})->where('value', '[a-zA-z0-9]');

Route::get('/user/{user_id}/post/{post_id}', function ($user_id, $post_id) {
    return "User: $user_id | Post: $post_id";
})->where([
    'user_id' => '[0-9]+',
    'post_id' => '[a-zA-Z]+'
]);


/*
|--------------------------------------------------------------------------
| Aula 78 - Rotas nomeadas
|--------------------------------------------------------------------------
|
| se colocar rota_nomeada n acha, tem que ser rota 1, a questão é que
| esse name é usado em outros lugares como uma variavel
|
*/

Route::get('/rota1', function () {
    return 'Rota nomeada';
})->name('rota_nomeada');

// Manda a rota1
Route::get('/rota_referenciada', function () {
    return redirect()->route('rota_nomeada');
});


/*
|--------------------------------------------------------------------------
| Prefixo de rotas
|--------------------------------------------------------------------------
|
| /admin/rotaA
| /admin/rotaB
| /admin/rotaC
|
*/

Route::prefix('admin')->group(function () {
    Route::get('/rotaA', function () {
        return 'rotaA';
    });

    Route::get('/rotaB', function () {
        return 'rotaB';
    });

    Route::get('/rotaC', function () {
        return 'rotaC';
    });
});


/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
|
| Middleware é uma camada/interceptador que executa código antes
| e/ou depois da rota (controller) ser executada
|
*/

Route::get('apenasAdm', function () {
    echo ('só sai esse echo se a pessoa fosse adm por exemplo');
})->middleware([ExemploMiddleware::class]);

// Mas vc pode colocar isso num grupo

Route::middleware([ExemploMiddleware::class])->group(function () {
    Route::get('/rotaA', function () {
        return 'rotaA';
    });

    Route::get('/rotaB', function () {
        return 'rotaB';
    });
});


/*
|--------------------------------------------------------------------------
| Rotas para controllers agrupados
|--------------------------------------------------------------------------
|
| em vez de fazer:
|
| Route::get('/user/new', [UserController::class, 'new']);
| Route::get('/user/edit', [UserController::class, 'edit']);
| Route::get('/user/delete', [UserController::class, 'delete']);
|
*/

Route::controller(UserController::class)->group(function () {
    Route::get('/user/new', 'new');
    Route::get('/user/edit', 'edit');
    Route::get('/user/delete', 'delete');
});


/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/

// Se n achar a rota, manda para esse fallback
Route::fallback(function () {
    echo 'pag n encontrada';
});