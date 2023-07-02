<?php

class ModeloConection
{
    private $host;
    private $db;
    private $contraseña;
    private $usuario;
    public $pdo;

    //esto es para la conexion habrir la conexion la base de datos
    public function conexionPDO()
    {
        $this->host = "localhost";
        $this->usuario = "root";
        $this->contraseña = "elgamer1";
        $this->db = "miportafolio";

        try {
            $pdo =  new PDO("mysql:host=$this->host;dbname=$this->db", $this->usuario, $this->contraseña);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            return $pdo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //esto es para cerrar la conexion de la base de datos
    public function cerrar_conexion()
    {
        $this->pdo = null;
    }
}

// class ModeloConection
// {
//     private $servidor;
//     private $usuario;
//     private $contraseña;
//     private $basedatos;
//     private $conexion;

//     public function __construct()
//     {
//         $this->servidor = "localhost";
//         $this->usuario = "root";
//         $this->contraseña = "elgamer1";
//         $this->basedatos = "miportafolio";
//     }

//     function conectar()
//     {
//         $this->conexion = new mysqli($this->servidor, $this->usuario, $this->contraseña, $this->basedatos);
//         $this->conexion->set_charset("utf8");
//     }

//     function cerrar()
//     {
//         $this->conexion->close();
//     }
// }
