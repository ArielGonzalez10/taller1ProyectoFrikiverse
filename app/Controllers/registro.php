<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function registro()
    {
        $data['titulo'] = 'Registro';
        $errors = [];

        // Verifica si se envió el formulario
        if ($this->request->getMethod() === 'post') {
            // Recoge los datos del formulario
            $nombre = trim($this->request->getPost('nombre'));
            $apellido = trim($this->request->getPost('apellido'));
            $email = trim($this->request->getPost('email'));
            $telefono = trim($this->request->getPost('telefono'));
            $password = trim($this->request->getPost('password'));
            $errors = [];

            // Validación de campos vacíos
            if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono) || empty($password)) {
                $errors[] = "Todos los campos son obligatorios.";
            }

            // Validar número de teléfono (solo números)
            if (!ctype_digit($telefono)) {
                $errors[] = "El número de teléfono debe contener solo números.";
            }

            // Validar longitud y complejidad de la contraseña
            if (
                strlen($password) < 8 ||
                !preg_match('/[A-Z]/', $password) ||
                !preg_match('/[!@#$%^&*]/', $password)
            ) {
                $errors[] = "La contraseña debe tener al menos 8 caracteres, incluir una mayúscula y un carácter especial.";
            }

            // Si no hay errores, muestra un mensaje de éxito (aquí podrías agregar lógica para guardar en la base de datos)
            if (empty($errors)) {
                // Aquí podrías guardar el usuario en la base de datos o hacer lo que sea necesario
                return redirect()->to('/registrarse')->with('mensaje', '¡Registro exitoso! Bienvenido, ' . $nombre . ' ' . $apellido);
            } else {
                // Si hay errores, pasar los errores a la vista
                $data['errores'] = $errors;
            }
        }
        // Cargar la vista con errores si los hay
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/registrarse', $data) . view('plantillas/footer');
    }
}