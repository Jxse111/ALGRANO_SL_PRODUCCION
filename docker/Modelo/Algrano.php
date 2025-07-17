<?php
/**
 * Clase que implementa métodos de conexión a la base de datos Algrano.
 *
 * @author José Martínez Estrada
 */
class Algrano
{

    private static $conexionBD = null;

    /**
     * Método que establece  una conexión con la base de datos mediante MySQLi
     * @return object Devuelve el objeto con la conexión establecida
     */
    public static function conectarAlgranoMySQLi()
    {
        $host = "localhost";
        $usuario = "root";
        $contrasena = "root";
        $bd = "algrano";

        if (is_null(self::$conexionBD)) {
            try {
                self::$conexionBD = new mysqli("mysql", "root", "root", "algrano");
            } catch (Exception $ex) {
                // Verificar si la conexión falló
                echo "ERROR: " . $ex->getMessage();
            }
        }
        return self::$conexionBD;
    }

    /**
     * Método que establece una coneión con la base de datos mediante PDO
     * @return object el objeto con la conexión establecida
     */
    public static function conectarAlgranoPDO()
    {
        $driver = "mysql";
        $host = "localhost";
        $usuario = "root";
        $contrasena = "root";
        $bd = "algrano";
        if (is_null(Algrano::$conexionBD)) {
            try {
                Algrano::$conexionBD = new PDO("$driver:host=$host;dbname=$bd", $usuario, $contrasena);
                Algrano::$conexionBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $ex) {
                self::$conexionBD = null;
                echo "ERROR:" . $ex->getMessage();
            }
        }
        return Algrano::$conexionBD;
    }

    /**
     * Método que cierra la conexión con la base de datos mediante MySQLi
     */
    public static function desconectarAlgranoMySQLi()
    {
        if (!is_null(self::$conexionBD)) {
            self::$conexionBD->close();
            self::$conexionBD = null;
        }
    }

    /**
     * Método que cierra la conexión con la base de datos mediante PDO
     */
    public static function desconectarAlgranoPDO()
    {
        if (!is_null(Algrano::$conexionBD)) {
            Algrano::$conexionBD = null;
        }
    }

    /**
     * Método que cierra la conexión con la base de datos si está abierta
     */
    public static function desconectar()
    {
        self::desconectarAlgranoMySQLi();
        self::desconectarAlgranoPDO();
    }
}