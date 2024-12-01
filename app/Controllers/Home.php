<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    /*Funciones para llamar a las paginas*/

    /*LLama a la pagina principal*/
    public function index()
    {
        $data['titulo'] = 'FrikiVerse';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/principal') . view('plantillas/footer');
    }

    /*LLama a la pagina contacto*/
    public function contacto()
    {
        $data['titulo'] = 'Contacto';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/contacto') . view('plantillas/footer');
    }

    /*LLama a la pagina quienes somos*/
    public function quienes_somos()
    {
        $data['titulo'] = '¿Quienes Somos?';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/quienesSomos') . view('plantillas/footer');
    }

    /*LLama a la pagina comercializacion*/
    public function comercializacion()
    {
        $data['titulo'] = 'Comercialización';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/comercializacion') . view('plantillas/footer');
    }

    /*LLama a la pagina terminos y usos*/
    public function terminos_usos()
    {
        $data['titulo'] = 'Términos y Usos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/terminosyUsos') . view('plantillas/footer');
    }

    /*LLama a la pagina iniciar sesión*/
    public function iniciar_sesion()
    {
        $data['titulo'] = 'Iniciar Sesión';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/iniciarSesion') . view('plantillas/footer');
    }

    /*LLama a la pagina de registro*/
    public function registrarse()
    {
        $data['titulo'] = 'Registrarse';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/registrarse') . view('plantillas/footer');
    }
}
