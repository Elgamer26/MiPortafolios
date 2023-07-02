<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;
use App\Models\ModelTienda;

class DetalleProducto extends BaseController
{
    protected $tienda;
    protected $tipos_;
    public function __construct()
    {
        session_start();
        $this->tienda = new ModelTienda();
        $this->tipos_ = new ModeloUsuario();
    }

    public function Producto($id)
    {

        $proyecto = $this->tienda->ProyectoDetalle($id);
        $imagen = $this->tienda->ProyectoDetalleImagen($id);
       
        $perfil = $this->tienda->PerfilDesarrollo();
        $lenguaje = $this->tipos_->TraerLenguaje();
        $tecnologia = $this->tipos_->TraerTecnologia();
        $tipo_proyecto = $this->tipos_->TraerTipoProyecto();

        $data = [
            'proyecto' => $proyecto,
            'imagen' => $imagen,

            'perfil' => $perfil,
            'lenguaje' => $lenguaje,
            'tecnologia' => $tecnologia,
            'tipo_proyecto' => $tipo_proyecto
        ];

        echo view('tienda/header', $data);
        echo view('tienda/product', $data);
        echo view('tienda/footer', $data);
    }
}
