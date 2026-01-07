<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\MainController;

// Tutorial das rotas

// basicamente sempre é

// Route::verbo(get,post[...])('url',callback)
// Sendo o call back a ação que vai ser executada pós chamar esse arquivo

//verbos são get,post,put

//rota com função anonima

Route::get('/rota',function(){
    return 'Oie';
});

Route::get('/insert',function(Request $request){
    // $request é basicamente um get post das variaveis
    var_dump($request);
});

Route::match(['get','post'],'/insert',function(Request $request){
    // $request é basicamente um get post das variaveis
    echo 'Aceita get e post';
});

Route::any('/any', function (Request $request) {
    return 'aceita qualquer coisa';
});


// ---------------

Route::get('/index', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);

//da para redrecionar uma rota a outra

Route::redirect('saltar','index');
Route::permanentRedirect('saltar','index');

//Manda a vbiew
Route::view('view','home');

//mandar a view com variaveis
Route::view('viewComDados','home',['nome'=>'joao']);


// Aula 76

Route::get('/valor/{value}',[MainController::class,'mostrarValorRota']);
Route::get('/valor/{value1}/{value2}',[MainController::class,'mostrarValoresRota']);
Route::get('/valor/{value1}/{value2}',[ MainController::class,'mostrarValoresRota2']);
Route::get('/valorOpcional/{value?}',[ MainController::class,'valorOpcional']);
//o primeiro valor é obrigatorio, mas o segundo n!
Route::get('/valorOpcional2/{value1}/valorOpcional2/{value2}',[MainController::class,'mostrarOpcional2']);
Route::get('/user/{user_id}/post/{post_id}',[ MainController::class,'mostrarPosts']);



/* 77. Route Parameters with Constraints - 
basicamente falar como que deseja que essa variavel venha

a-z = aceita todas letras minuscular,
A-Z=maisculas 
0-9= numeros
*/

Route::get('/valor/{value}', function($value){echo $value})->where('value','[a-zA-z0-9]');
Route::get('/user/{user_id}/post/{post_id}', function ($user_id, $post_id) {
    return "User: $user_id | Post: $post_id";
})->where([
    'user_id' => '[0-9]+',
    'post_id' => '[a-zA-Z]+'
]);


