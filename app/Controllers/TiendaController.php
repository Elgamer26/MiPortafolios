<?php
namespace App\Controllers;
use App\Models\ModelTienda;
class TiendaController extends BaseController
{

    protected $tienda;
    public function __construct()
    {
        session_start();
        $this->tienda = new ModelTienda();
    }

    ///PAGINADOR DE TIENDA

    public function PaginarTienda()
    {
        if ($this->request->getMethod() == "post") {

            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');

            $repuesta = $this->tienda->PaginarTienda($partida, $valor);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
        exit();
    }

}