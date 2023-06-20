<?php
require_once './interfaces/IApiUsable.php';
require_once './helpers/helpers.php';

class PedidoController extends Pedido implements IApiUsable
{
    public static function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $usr = newPedido($parametros);
        $usr->crearPedido();
        $payload = json_encode(array("mensaje" => "Pedido creado con exito"));
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $usr = $args['id'];
        $Pedido = Pedido::obtenerPedido($usr);
        $payload = json_encode($Pedido);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Pedido::obtenerTodos();
        $payload = json_encode(array("listaPedido" => $lista));

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public static function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $usr = newPedido($parametros);
        $usr->id = $parametros['id'];
        $usr->modificarPedido();

        $payload = json_encode(array("mensaje" => "Pedido modificado con exito"));

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $PedidoId = $args['id'];
        Pedido::borrarPedido($PedidoId);

        $payload = json_encode(array("mensaje" => "Pedido borrado con exito"));

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function Pruebas($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        echo $parametros['id'];

        $payload = json_encode(array("mensaje" => "RECIBI EL PUT"));

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
