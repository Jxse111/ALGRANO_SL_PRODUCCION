<?php
require_once('Algrano.php');
require_once('funcionesBaseDeDatos.php');
/**
 * Clase que implementa un objeto de tipo Usuario para el acceso a la web.
 *
 * @author José Martínez Estrada
 */
class Usuario
{
    // Atributos
    private $dni;
    private $nombre;
    private $contrasena;
    private $direccion;
    private $correo;
    private $fechaNacimiento;

    private $idRolUsuario;
    /**
     * Constructor que crea un usuario.
     * @param mixed $nombre nombre del usuario
     * @param mixed $contrasena contraseña del usuario
     * @param mixed $direccion dirección de la localización del usuario
     * @param mixed $correo correo electrónico del usuario
     * @param mixed $fechaNacimiento fehca de nacimiento del usuario
     */
    public function __construct($dni, $nombre, $contrasena, $direccion, $correo, $fechaNacimiento, $idRolUsuario = '1')
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idRolUsuario = $idRolUsuario;
    }

    //Métodos getter y setter

    public function getDni()
    {
        return $this->dni;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }
    public function getdireccion()
    {
        return $this->direccion;
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }


    /**
     * Método que elimina un usuario de la base de datos.
     * @param mixed $dniUsuario DNI del usuario a eliminar
     * @return bool Devuelve true si el usuario fue eliminado, false si no fue eliminado
     */
    public static function eliminarUsuario($dniUsuario)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $esValido = false;
        if (existeDni($dniUsuario, $conexionBD)) {
            // Eliminar el usuario de la base de datos
            try {
                $consultaEliminacionUsuario = $conexionBD->prepare('DELETE FROM usuario WHERE DNI = ?');
                $consultaEliminacionUsuario->bind_param('s', $dniUsuario);
                if ($consultaEliminacionUsuario->execute()) {
                    $esValido = true;
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        return $esValido ? true : false;
    }

    /**
     * Método que busca un usuario en la base de datos por su DNI.
     * @param mixed $dniUsuario DNI del usuario a buscar
     * @return array|bool Devuelve un array con los datos del usuario si existe, false si no existe
     */
    public static function buscarUsuario($dniUsuario)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $esValido = false;
        if (existeDni($dniUsuario, $conexionBD)) {
            $consultaBusquedaUsuario = $conexionBD->prepare('SELECT * FROM usuario WHERE DNI = ?');
            $consultaBusquedaUsuario->bind_param('s', $dniUsuario);
            if ($consultaBusquedaUsuario->execute()) {
                $datosUsuario = $consultaBusquedaUsuario->get_result()->fetch_all(MYSQLI_ASSOC);
                $esValido = true;
            }
        }
        return $esValido ? $datosUsuario : false;
    }

    /**
     * Método que busca un usuario en la base de datos por su nombre.
     * @param mixed $nombreUsuario Nombre del usuario a buscar
     * @return array|bool Devuelve un array con los datos del usuario si existe, false si no existe
     */
    public static function buscarUsuarioPorNombre($nombreUsuario)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $esValido = false;
        if (existeUsuario($nombreUsuario, $conexionBD)) {
            $consultaBusquedaUsuario = $conexionBD->prepare('SELECT * FROM usuario WHERE usuario = ?');
            $consultaBusquedaUsuario->bind_param('s', $nombreUsuario);
            if ($consultaBusquedaUsuario->execute()) {
                $datosUsuario = $consultaBusquedaUsuario->get_result()->fetch_all(MYSQLI_ASSOC);
                $esValido = true;
            }
        }
        return $esValido ? $datosUsuario : false;
    }

    /**
     * Método que busca un usuario en la base de datos por su correo.
     * @return array Devuelve un array con los datos del usuario si existe.
     */
    public static function listarUsuarios()
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $usuarios = [];

        $consultaListadoUsuarios = $conexionBD->prepare('SELECT * FROM usuario');
        if ($consultaListadoUsuarios->execute()) {
            $usuarios = $consultaListadoUsuarios->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        return $usuarios;
    }



    /**
     * Método que guarda un usuario en la base de datos.
     * @return bool Devuelve true si el usuario fue guardado, false si no fue guardado
     */
    public function guardarUsuario()
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $esValido = false;
        $dniUsuario = $this->dni;
        $nombreUsuario = $this->nombre;
        $contraseñaUsuario = $this->contrasena;
        $direccionUsuario = $this->direccion;
        $correoUsuario = $this->correo;
        $fechaNacUsuario = $this->fechaNacimiento;
        $idRolUsuario = $this->idRolUsuario;
        if (!existeDni($dniUsuario, $conexionBD)) {
            // Encriptar la contraseña antes de guardarla
            $contraseñaUsuario = hash("sha512", $contraseñaUsuario);
            try {
                $consultaInsercionUsuario = $conexionBD->prepare('INSERT INTO usuario VALUES (?,?,?,?,?,?,?)');
                $consultaInsercionUsuario->bind_param('sssssss', $dniUsuario, $nombreUsuario, $contraseñaUsuario, $direccionUsuario, $correoUsuario, $fechaNacUsuario, $idRolUsuario);
                if ($consultaInsercionUsuario->execute()) {
                    $esValido = true;
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $fechaFormateada = date('Y-m-d', strtotime($fechaNacUsuario));
            $consultaInsercionUsuario = $conexionBD->prepare('UPDATE usuario SET usuario = ? , direccion = ?, correo = ?, fec_nac = ?, id_rol_usuario = ?  WHERE DNI = ?');
            $consultaInsercionUsuario->bind_param('ssssss', $nombreUsuario, $direccionUsuario, $correoUsuario, $fechaFormateada, $idRolUsuario, $dniUsuario);
            if ($consultaInsercionUsuario->execute()) {
                $esValido = true;
            }
        }
        return $esValido ? true : false;
    }


}
