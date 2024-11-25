<?php

namespace App\Controllers;

class Home extends BaseController
{
    /*Funciones para llamar a las paginas*/ 
    /*LLama a la pagina principal*/ 
    public function index()
    {
        $data['titulo'] = 'FrikiVerse';
        return view('plantillas/header', $data).view('plantillas/navbar').view('front/principal').view('plantillas/footer');
    }
    /*LLama a la pagina contacto*/ 
    public function contacto()
    {
        $data['titulo'] = 'Contacto';
        return view('plantillas/header', $data).view('plantillas/navbar').view('front/contacto').view('plantillas/footer');
    }
    /*LLama a la pagina quienes somos*/ 
    public function quienes_somos()
    {
        $data['titulo'] = '¿Quienes Somos?';
        return view('plantillas/header', $data).view('plantillas/navbar').view('front/quienesSomos').view('plantillas/footer');
    }
    /*LLama a la pagina comercializacion*/ 
    public function comercializacion()
    {
        $data['titulo'] = 'Comercializaciòn';
        return view('plantillas/header', $data).view('plantillas/navbar').view('front/comercializacion').view('plantillas/footer');
    }
    /*LLama a la pagina terminos y usos*/ 
    public function terminos_usos()
    {
        $data['titulo'] = 'Terminos y Usos';
        return view('plantillas/header', $data).view('plantillas/navbar').view('front/terminosyUsos').view('plantillas/footer');
    }
}
