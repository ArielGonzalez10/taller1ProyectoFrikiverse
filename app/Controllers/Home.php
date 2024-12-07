<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{

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

    public function modificarDatos()
    {
        $data['titulo'] = 'MisDatos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/misDatos') . view('plantillas/footer');
    }

    public function inicio_sesion()
    {
        $correo = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Conexión a la base de datos
        $db = \Config\Database::connect();

        // Consulta para verificar usuario y obtener datos
        $query = $db->table('usuario')
            ->select('idUsuario, nombre, apellido, idRol') // Asegúrate de seleccionar idUsuario
            ->where('correoElectronico', $correo)
            ->where('contrasenia', $password)
            ->get();


        // Validación de usuario
        if ($query->getNumRows() > 0) {
            $usuario = $query->getRow();

            // Almacenar datos en la sesión
            session()->set([
                'idUsuario' => $usuario->idUsuario, // Asegúrate de que este campo exista y tenga un valor válido
                'rol' => $usuario->idRol == 1 ? 'Administrador' : 'Cliente',
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
            ]);


            // Redirigir al usuario a la página principal
            return redirect()->to('principal');
        } else {
            // Redirigir con mensaje de error
            session()->setFlashdata('error', 'Credenciales inválidas');
            return redirect()->to('iniciarSesion');
        }
    }
    public function cerrar_sesion()
    {
        // Verifica si hay una sesión activa
        if (session()->get('rol')) {
            // Destruir la sesión
            session()->destroy();
        }

        // Redirigir a la página de inicio de sesión
        return redirect()->to('iniciarSesion');
    }

    public function modificar()
    {
        // Obtener el ID del usuario desde la sesión
        $idUsuario = session('idUsuario');

        if (!$idUsuario) {
            return redirect()->to('iniciarSesion')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }

        // Obtener datos del formulario
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $profileImage = $this->request->getFile('profileImage');

        // Validar y procesar la imagen (si fue enviada)
        $imagePath = null;
        if ($profileImage && $profileImage->isValid()) {
            $imagePath = 'uploads/perfiles/' . $profileImage->getRandomName();
            $profileImage->move('uploads/perfiles', $imagePath);
        }

        // Conectar a la base de datos
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');

        // Datos a actualizar
        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correoElectronico' => $email,
        ];

        // Si hay imagen, agregarla al array
        if ($imagePath) {
            $data['foto_perfil'] = $imagePath;
        }

        // Solo actualizar la contraseña si se ha ingresado una nueva
        if (!empty($password)) {
            // Aquí puedes decidir si quieres que se haga el hashing o no
            $data['contrasenia'] = $password; // Solo actualizar si se proporciona una nueva contraseña
        }

        // Actualizar datos en la base de datos
        $builder->where('idUsuario', $idUsuario);
        $actualizado = $builder->update($data);

        // Validar si se realizó la actualización
        if ($actualizado) {
            // Actualizar los datos de la sesión
            session()->set('nombre', $nombre);
            session()->set('apellido', $apellido);

            return redirect()->to('principal')->with('mensaje', 'Datos actualizados correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar los datos.');
        }
    }

    public function productos()
    {
        $data['titulo'] = 'Productos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/productos') . view('plantillas/footer');
    }
}