<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class sesionController extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel(); // Instanciar el modelo de Usuario
    }

    public function registrarUsuario()
    {
        // Verificar que el formulario fue enviado
        if ($this->request->getMethod() === 'post') {
            // Capturar los datos del formulario
            $nombre = trim($this->request->getPost('nombre'));
            $apellido = trim($this->request->getPost('apellido'));
            $email = trim($this->request->getPost('email'));
            $telefono = trim($this->request->getPost('telefono'));
            $password = $this->request->getPost('password');
            $idRol = 2; // Rol por defecto para usuarios

            // Validar datos
            $errores = [];
            if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
            if (empty($apellido)) $errores[] = "El apellido es obligatorio.";
            if (empty($email)) $errores[] = "El correo electrónico es obligatorio.";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "El correo electrónico no es válido.";
            if (empty($password)) $errores[] = "La contraseña es obligatoria.";

            // Si hay errores, almacenarlos en la sesión y redirigir
            if (!empty($errores)) {
                session()->setFlashdata('errores', $errores);
                return redirect()->to('registrarse');
            }

            // Verificar si el email ya está registrado
            if ($this->usuarioModel->where('correoElectronico', $email)->countAllResults() > 0) {
                session()->setFlashdata('errores', ["El correo electrónico ya está registrado."]);
                return redirect()->to('registrarse');
            }

            // Insertar datos en la base de datos
            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correoElectronico' => $email,
                'nroTelefono' => $telefono,
                'contrasenia' => password_hash($password, PASSWORD_BCRYPT), // Encriptar la contraseña
                'idRol' => $idRol
            ];

            if ($this->usuarioModel->insert($data)) {
                session()->setFlashdata('mensaje', "Usuario registrado con éxito.");
                return redirect()->to('principal');
            } else {
                session()->setFlashdata('errores', ["Hubo un problema al registrar al usuario. Intenta nuevamente."]);
                return redirect()->to('registrarse');
            }
        }

        // Si no es POST, redirigir al formulario
        return redirect()->to('/registrarse');
    }

    public function iniciarSesion()
{
    // Obtener los datos del formulario
    $correo = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Verificar que se hayan completado ambos campos
    if (!$correo || !$password) {
        session()->setFlashdata('error', 'Debes completar ambos campos.');
        return redirect()->to('iniciarSesion');
    }

    // Buscar al usuario en la base de datos
    $usuario = $this->usuarioModel->where('correoElectronico', $correo)->first();

    // Verificar las credenciales
    if ($usuario && $password === $usuario['contrasenia']) { // Comparar sin hashing
        // Iniciar sesión
        session()->set('idUsuario', $usuario['idUsuario']);
        session()->set('idRol', $usuario['idRol']); // Guardar el idRol
        session()->set('nombre', $usuario['nombre']);
        session()->set('apellido', $usuario['apellido']);
        session()->set('nroTelefono', $usuario['nroTelefono']);
        session()->set('fotoPerfil', $usuario['fotoPerfil']); // Guardar la foto de perfil

        return redirect()->to('principal');
    } else {
        session()->setFlashdata('error', 'Credenciales inválidas.');
        return redirect()->to('iniciarSesion');
    }
}


    public function cerrarSesion()
    {
        // Verifica si hay una sesión activa
        if (session()->get('idUsuario')) {
            // Destruir la sesión
            session()->destroy();
        }

        // Redirigir a la página de inicio de sesión
        return redirect()->to('iniciarSesion');
    }

    public function modificarUsuario()
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
        $nroTelefono = $this->request->getPost('nroTelefono');
        $profileImage = $this->request->getFile('profileImage');

        // Validar el número de teléfono
        if (!ctype_digit($nroTelefono)) {
            return redirect()->back()->with('error', 'El número de teléfono debe contener solo dígitos.');
        }
        $nroTelefono = intval($nroTelefono);

        // Validar y procesar la imagen (si fue enviada)
        $imagePath = null;
        if ($profileImage && $profileImage->isValid()) {
            $imagePath = 'uploads/perfiles/' . $profileImage->getRandomName();
            $profileImage->move('uploads/perfiles', $imagePath);
        }

        // Datos a actualizar
        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correoElectronico' => $email,
            'nroTelefono' => $nroTelefono,
        ];

        // Si hay imagen, agregarla al array
        if ($imagePath) {
            $data['fotoPerfil'] = $imagePath;
        }

        // Solo actualizar la contraseña si se ha ingresado una nueva
        if (!empty($password)) {
            $data['contrasenia'] = password_hash($password, PASSWORD_BCRYPT); // Encriptar la nueva contraseña
        }

        // Actualizar datos en la base de datos
        $this->usuarioModel->update($idUsuario, $data);

        // Actualizar los datos de la sesión
        session()->set('nombre', $nombre);
        session()->set('apellido', $apellido);
        session()->set('nroTelefono', $nroTelefono);
        if ($imagePath) {
            session()->set('fotoPerfil', $imagePath);
        }

        return redirect()->to('principal')->with('mensaje', 'Datos actualizados correctamente.');
    }
}