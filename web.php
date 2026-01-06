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
