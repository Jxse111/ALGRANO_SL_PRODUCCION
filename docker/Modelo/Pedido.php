<?php
require_once 'funcionesBaseDeDatos.php';
/**
 * Clase que implementa un objeto de tipo Pedido para el acceso a la web.
 *
 * @author José Martínez Estrada
 */
class Pedido
{
    // Atributos
    private $codigo;
    private $dniCliente;
    private $idProducto;
    private $tipo;
    private $precioTotal;
    private $fechaPedido;
    private $estado;
    private $codigoDetalle;
    private $subtotal;
    private $cantidad;

    // Constructor
    public function __construct($codigo, $dniCliente, $idProducto, $tipo, $precioTotal, $fechaPedido, $estado, $codigoDetalle, $subtotal, $cantidad)
    {
        $this->codigo = $codigo;
        $this->dniCliente = $dniCliente;
        $this->idProducto = $idProducto;
        $this->tipo = $tipo;
        $this->precioTotal = $precioTotal;
        $this->fechaPedido = $fechaPedido;
        $this->estado = $estado;
        $this->codigoDetalle = $codigoDetalle;
        $this->subtotal = $subtotal;
        $this->cantidad = $cantidad;
    }

    //Getter
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    public function getFechaPedido()
    {
        return $this->fechaPedido;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getCodigoDetalle()
    {
        return $this->codigoDetalle;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    //Setter
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;
    }

    public function setFechaPedido($fechaPedido)
    {
        $this->fechaPedido = $fechaPedido;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    // Métodos
    /**
     * Método que obtiene los pedidos de un cliente
     * @param mixed $dniCliente DNI del cliente
     * @return array Devuelve un array con los pedidos del cliente
     */
    public static function obtenerPedidosCliente($dniCliente)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $pedidos = [];
        $consulta = $conexionBD->prepare('SELECT p.* FROM pedido p INNER JOIN usuario u ON p.DNI_Cliente = u.DNI WHERE u.DNI = ? AND u.id_rol_usuario = 1');
        $consulta->bind_param('i', $dniCliente);
        if ($consulta->execute()) {
            $pedidos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return $pedidos;
    }

    /**
     * Método que obtiene los pedidos por su código
     * @param mixed $codigoPedido Código del pedido
     * @return array Devuelve un array con los pedidos
     */
    public static function obtenerPedidosPorCodigo($codigoPedido)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $pedidos = [];
        $consulta = $conexionBD->prepare('SELECT * FROM pedido WHERE codigo_pedido = ?');
        $consulta->bind_param('s', $codigoPedido);
        if ($consulta->execute()) {
            $pedidos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return $pedidos;
    }

    /**
     * Método que obtiene los detalles de un pedido por su código
     * @param mixed $codigoPedido Código del pedido
     * @return array Devuelve un array con los detalles del pedido
     */
    public static function obtenerPedidosDetalle($codigoPedido)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $pedidos = [];
        $consulta = $conexionBD->prepare('SELECT * FROM pedidos_detalle WHERE codigo_pedido = ?');
        $consulta->bind_param('s', $codigoPedido);
        if ($consulta->execute()) {
            $pedidos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        return $pedidos;
    }
    /**
     * Método que obtiene todos los pedidos
     * @return array Devuelve un array con todos los pedidos
     */
    public static function listarPedidos()
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $pedidos = [];
        $consultaBusquedaPedidos = $conexionBD->prepare('SELECT * FROM pedido');
        if ($consultaBusquedaPedidos->execute()) {
            $pedidos = $consultaBusquedaPedidos->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        return $pedidos;
    }
    /**
     * Método que obtiene todos los detalles de los pedidos
     * @return array Devuelve un array con todos los detalles de los pedidos
     */
    public static function listarPedidosDetalle()
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $pedidos = [];
        $consultaBusquedaPedidos = $conexionBD->prepare('SELECT * FROM pedidos_detalle');
        if ($consultaBusquedaPedidos->execute()) {
            $pedidos = $consultaBusquedaPedidos->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        return $pedidos;
    }

    /**
     * Método que crea un pedido
     * @return bool Devuelve true si se ha creado el pedido, false si no se ha creado
     */
    public function crearPedido()
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $esValido = false;
        $codigo = $this->codigo;
        $dniCliente = $this->dniCliente;
        $idProducto = $this->idProducto;
        $tipo = $this->tipo;
        $precioTotal = $this->precioTotal;
        $fechaPedido = $this->fechaPedido;
        $estado = $this->estado;
        $codigoDetalle = $this->codigoDetalle;
        $subtotal = $this->subtotal;
        $cantidad = $this->cantidad;
        if (!existePedido($codigo, $conexionBD) && existeProducto($idProducto, $conexionBD)) {
            $consultaInsercionPedido = $conexionBD->prepare('INSERT INTO pedido VALUES (?,?,?,?,?)');
            $consultaInsercionPedido->bind_param('ssdss', $codigo, $dniCliente, $precioTotal, $fechaPedido, $estado);
            if ($consultaInsercionPedido->execute()) {
                $esValido = true;
            }
        } else {
            $consultaInsercionPedido = $conexionBD->prepare('UPDATE pedido SET precio_total = ?, fecha_pedido = ?, estado = ?  WHERE codigo_pedido = ?');
            $consultaInsercionPedido->bind_param('dsss', $precioTotal, $fechaPedido, $estado, $codigo);
            if ($consultaInsercionPedido->execute()) {
                $consultaInsercionPedidoDetalle = $conexionBD->prepare('UPDATE pedidos_detalle SET tipo = ?, subtotal = ? , cantidad_descrita = ? WHERE codigo_detalle = ?');
                $consultaInsercionPedidoDetalle->bind_param('sdss', $tipo, $subtotal, $cantidad, $codigoDetalle);
                if ($consultaInsercionPedidoDetalle->execute()) {
                    $esValido = true;
                }
            }
        }
        return $esValido ? true : false;
    }
    /**
     * Método que elimina un pedido
     * @param mixed $codigoPedido Código del pedido
     * @return bool Devuelve true si se ha eliminado el pedido, false si no se ha eliminado
     */
    public static function eliminarPedido($codigoPedido)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $esValido = false;
        if (existePedido($codigoPedido, $conexionBD)) {
            $consultaEliminacionPedido = $conexionBD->prepare('DELETE FROM pedido WHERE codigo_pedido = ?');
            $consultaEliminacionPedido->bind_param('s', $codigoPedido);
            if ($consultaEliminacionPedido->execute()) {
                $esValido = true;
            }
        }
        return $esValido ? true : false;
    }
    /**
     * Método que elimina un pedido detallado
     * @param mixed $codigoPedido Código del pedido
     * @return bool Devuelve true si se ha eliminado el pedido, false si no se ha eliminado
     */
    public static function eliminarPedidoDetallado($codigoPedido)
    {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        $esValido = false;
        if (existePedido($codigoPedido, $conexionBD)) {
            $consultaEliminacionPedido = $conexionBD->prepare('DELETE FROM pedidos_detalle WHERE codigo_pedido = ?');
            $consultaEliminacionPedido->bind_param('s', $codigoPedido);
            if ($consultaEliminacionPedido->execute()) {
                $esValido = true;
            }
        }
        return $esValido ? true : false;
    }
}
