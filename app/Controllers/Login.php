<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;
use App\PhpMail\envio_correo;

class Login extends BaseController
{
    protected $login;
    protected $mail;

    public function __construct()
    {
        session_start();
        $this->login = new ModeloUsuario();
        $this->mail = new envio_correo();
    }

    public function index()
    {
        if (isset($_SESSION["id_user"])) {
            return redirect()->to(base_url() . 'admin');
        } else {
            echo view('login/index');
        }
    }

    public function IngresarLogin()
    {
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $resutado = $this->login->verifcar_usuario($usuario, $password);
        $data = json_encode($resutado, JSON_UNESCAPED_UNICODE);
        if (!empty($resutado)) {
            echo $data;
        } else {
            echo 0;
        }
        exit();
    }

    public function ObtenerIdUser()
    {
        $id_usu = $this->request->getPost('id_usu');
        $_SESSION["id_user"] = $id_usu;
        echo 1;
        exit();
    }

    public function CerraSesion()
    {
        session_destroy();
        return redirect()->to(base_url() . 'login');
    }

    public function RecuperarPassword()
    {
        echo view('login/recuperar');
    }

    public function ValidarCorreo()
    {
        $correo = $this->request->getPost('correo');
        $resutado = $this->login->ValidarCorreo($correo);
        if (!empty($resutado)) {
            echo 1;
        } else {
            echo 0;
        }
        exit();
    }

    public function RestablecerPassword()
    {
        $correo = $this->request->getPost('correo');

        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < 10; $i++) {
            (string)$key .= substr($pattern, mt_rand(0, $max), 1);
        }

        $html = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
        <table style="border: 1px solid black; width: 100%; height: 258px;">
        <thead>
        <tr style="height: 73px;">
        <td style="text-align: center; background: orange; color: white; height: 73px;" colspan="2">
        <h1><strong>.:SISTEMA PORTAFOLIO:.</strong></h1>
        </td>
        </tr>
        <tr style="height: 188px;">
        <td style="height: 134px; text-align: center;" width="20%">Su password se restablecio con exito, la nueva password es: <strong>"' . $key . '"</strong></td>
        </tr>    
        </thead>
        </table>
        </body>
        </html>';

        $sms = "Recuperar password";

        $valuess = $this->mail->enviar_correo($correo, $html, $sms);
        if ($valuess == 1) {
            $respuesta = $this->login->RestablecerPassword($correo,  $key);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        } else {
            echo $valuess;
        }

        exit();
    }
}
