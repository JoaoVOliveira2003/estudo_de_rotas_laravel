<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return 'index';
    }

    public function about()
    {
        return 'about';
    }

    public function mostrarValorRota($valor)
    {
        echo "veio da rota" + $valor;
    }

    public function mostrarValoresRota($valor1, $valor2)
    {
        echo "valor1" + $valor1;
        echo "valor2" + $valor2;
    }

    public function mostrarValoresRota2(Request $request, $valor1, $valor2)
    {
        echo "valor1" + $valor1;
        echo "valor2" + $valor2;
    }

    public function valorOpcional($valor = null)
    {
        echo "veio da rota" + $valor;
    }

    public function mostrarPosts($user_id, $post_id)
    {
        echo "valor1" + $user_id;
        echo "valor2" + $post_id;
    }
}
