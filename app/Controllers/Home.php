<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;
use App\Models\ModelTienda;

class Home extends BaseController
{
    protected $tienda; 
    protected $tipos_;
    
    public function __construct()
    { 
        $this->tienda = new ModelTienda();
        $this->tipos_ = new ModeloUsuario();
    }

    public function index()
    {

        $perfil = $this->tienda->PerfilDesarrollo();
        $lenguaje = $this->tipos_->TraerLenguaje();
        $tecnologia = $this->tipos_->TraerTecnologia();
        $tipo_proyecto = $this->tipos_->TraerTipoProyecto();

        $data = [
            'perfil' => $perfil,
            'lenguaje' => $lenguaje,
            'tecnologia' => $tecnologia,
            'tipo_proyecto' => $tipo_proyecto
        ];

        echo view('tienda/header', $data);  
        echo view('tienda/index');  
        echo view('tienda/footer', $data);  
    }
}
