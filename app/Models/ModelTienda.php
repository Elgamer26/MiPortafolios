<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModelTienda
{
    private $conexion;
    function __construct()
    {
        require_once 'ModeloConection.php';
        $this->conexion = new ModeloConection();
        //abrir conexion
        $this->conexion->conexionPDO();
        //cerra conexion
        $this->conexion->cerrar_conexion();
    }

    function PaginarTienda($partida, $valor)
    {
        try {

            $c = $this->conexion->conexionPDO();
            $paginaactual = htmlspecialchars($partida, ENT_QUOTES, 'UTF-8');

            if (!empty($valor)) {
                $datos = $valor;
                $sql = "SELECT
                            COUNT(*) 
                        FROM
                            proyectos
                            INNER JOIN proyectos_imagen ON proyectos.id = proyectos_imagen.id_proyecto
                            INNER JOIN lenguaje ON proyectos.idlenguaje = lenguaje.id
                            INNER JOIN tecnologia ON proyectos.idtecnologia = tecnologia.id
                            INNER JOIN tipo_proyecto ON proyectos.id_tipo_proyecto = tipo_proyecto.id 
                        WHERE
                            proyectos.estado = 1 
                            AND lenguaje.nombre LIKE '%" . $datos . "%'
                            OR tecnologia.nombre LIKE '%" . $datos . "%'
                            OR tipo_proyecto.nombre LIKE '%" . $datos . "%'
                            OR proyectos.nombre LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                            COUNT(*) 
                        FROM
                            proyectos
                            INNER JOIN proyectos_imagen ON proyectos.id = proyectos_imagen.id_proyecto
                            INNER JOIN lenguaje ON proyectos.idlenguaje = lenguaje.id
                            INNER JOIN tecnologia ON proyectos.idtecnologia = tecnologia.id
                            INNER JOIN tipo_proyecto ON proyectos.id_tipo_proyecto = tipo_proyecto.id 
                        WHERE
                            proyectos.estado = 1";
            }
            $query = $c->prepare($sql);
            $query->execute();
            $data = $query->fetch();
            $arreglo = array();
            //
            foreach ($data as $respuesta) {
                $arreglo[] = $respuesta;
            }
            //
            $numlotes = 12;
            $nropaguinas = ceil($arreglo[0] / $numlotes);
            $lista = "";
            $tabla = "";
            //
            if ($paginaactual > 1) {
                $lista = $lista . ' <li class="page-item">
                                        <a class="page-link" href="javascript:PaginarTienda(' . ($paginaactual - 1) . ');" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Anterior</span>
                                        </a>
                                    </li>';
            }
            //
            for ($i = 1; $i <= $nropaguinas; $i++) {
                if ($i == $paginaactual) {
                    $lista = $lista . '<li class="page-item active"><a class="page-link" href="javascript:PaginarTienda(' . ($i) . ');">' . $i . '</a></li>';
                } else {
                    $lista = $lista . '<li class="page-item"><a class="page-link" href="javascript:PaginarTienda(' . ($i) . ');">' . $i . '</a></li>';
                }
            }
            //
            if ($paginaactual < $nropaguinas) {
                $lista = $lista . ' <li class="page-item">
                                        <a class="page-link" href="javascript:PaginarTienda(' . ($paginaactual + 1) . ');" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Próximo</span>
                                        </a>
                                    </li>';
            }
            //
            if ($paginaactual <= 1) {
                $limit = 0;
            } else {
                $limit = $numlotes * ($paginaactual - 1);
            }
            //
            if (!empty($valor)) {
                $datos = $valor;
                $sql_p = "SELECT DISTINCT
                            proyectos.nombre as nombre_proyecto,
                            proyectos.precio as precio_proyecto,
                            proyectos.estado as estado_proyecto,
                            lenguaje.nombre as nombre_lenguaje,
                            tecnologia.nombre as nombre_tecnologia,
                            tipo_proyecto.nombre as tipo_proyecto,
                            ( SELECT foto FROM proyectos_imagen WHERE proyectos_imagen.id_proyecto = proyectos.id LIMIT 1 ) AS imagen,
                            proyectos.id
                        FROM
                            proyectos
                            INNER JOIN proyectos_imagen ON proyectos.id = proyectos_imagen.id_proyecto
                            INNER JOIN lenguaje ON proyectos.idlenguaje = lenguaje.id
                            INNER JOIN tecnologia ON proyectos.idtecnologia = tecnologia.id
                            INNER JOIN tipo_proyecto ON proyectos.id_tipo_proyecto = tipo_proyecto.id 
                        WHERE
                            proyectos.estado = 1 
                            AND lenguaje.nombre LIKE '%" . $datos . "%' 
                            OR tecnologia.nombre LIKE '%" . $datos . "%' 
                            OR tipo_proyecto.nombre LIKE '%" . $datos . "%' 
                            OR proyectos.nombre LIKE '%" . $datos . "%'
                            ORDER BY proyectos.id DESC LIMIT $limit, $numlotes";
            } else {
                $sql_p = "SELECT DISTINCT
                        proyectos.nombre as nombre_proyecto,
                        proyectos.precio as precio_proyecto,
                        proyectos.estado as estado_proyecto,
                        lenguaje.nombre as nombre_lenguaje,
                        tecnologia.nombre as nombre_tecnologia,
                        tipo_proyecto.nombre as tipo_proyecto,
                        ( SELECT foto FROM proyectos_imagen WHERE proyectos_imagen.id_proyecto = proyectos.id LIMIT 1 ) AS imagen ,
                        proyectos.id
                    FROM
                        proyectos
                        INNER JOIN proyectos_imagen ON proyectos.id = proyectos_imagen.id_proyecto
                        INNER JOIN lenguaje ON proyectos.idlenguaje = lenguaje.id
                        INNER JOIN tecnologia ON proyectos.idtecnologia = tecnologia.id
                        INNER JOIN tipo_proyecto ON proyectos.id_tipo_proyecto = tipo_proyecto.id 
                    WHERE
                        proyectos.estado = 1  
                    ORDER BY proyectos.id DESC LIMIT $limit, $numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll();

            foreach ($result as $respuesta) {

                $tabla = $tabla . '<div class="col-md-3">
                                    <div class="product">
                                        <div class="product-img">
                                         <img src="' . base_url() . 'public/img/proyectos/' . $respuesta[6] . '" alt="Proyecto img" style="object-fit: cover; height: 333px;">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">' . $respuesta[5] . '</p>
                                            <h3 class="product-name"> ' . $respuesta[4] . ' </h3>
                                            <h3 class="product-name"> ' . $respuesta[3] . ' </h3>
                                            <h4 class="product-price">$' . $respuesta[1] . '</h4>
                                            <div class="product-btns">
                                                <button onclick="VerDetalleProducto(' . $respuesta[7] . ');" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Vista rapida</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Agregar carrito</button>
                                        </div>
                                    </div>
                                </div>';
            }

            $array = array(0 => $tabla, 1 => $lista);
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $array;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function ProyectoDetalle($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT DISTINCT
            proyectos.nombre AS nombre_proyecto,
            proyectos.precio AS precio_proyecto,
            lenguaje.nombre AS nombre_lenguaje,
            tecnologia.nombre AS nombre_tecnologia,
            tipo_proyecto.nombre AS tipo_proyecto,
            proyectos.id,
            proyectos.detalle,
            proyectos.descuento,
            proyectos.tipo_des 
            FROM
                proyectos
                INNER JOIN lenguaje ON proyectos.idlenguaje = lenguaje.id
                INNER JOIN tecnologia ON proyectos.idtecnologia = tecnologia.id
                INNER JOIN tipo_proyecto ON proyectos.id_tipo_proyecto = tipo_proyecto.id
            WHERE
            proyectos.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch(); 
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function ProyectoDetalleImagen($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            proyectos_imagen.id_proyecto,
            proyectos_imagen.foto 
            FROM
                proyectos_imagen 
            WHERE
            proyectos_imagen.id_proyecto = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(); 
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function PerfilDesarrollo()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            perfil.id, 
            perfil.nombre, 
            perfil.apellidois, 
            perfil.correo, 
            perfil.telefono, 
            perfil.pais, 
            perfil.direccion, 
            perfil.profesion, 
            perfil.sobremi, 
            perfil.foto, 
            perfil.hojavida
            FROM
            perfil WHERE perfil.id = 1";
            $query = $c->prepare($sql); 
            $query->execute();
            $result = $query->fetch(); 
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}
