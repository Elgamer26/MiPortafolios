<?php
namespace App\Controllers;
use App\Models\ModeloUsuario;
class Admin extends BaseController
{

    protected $usuario;

    public function __construct()
    {
        session_start();
        $this->usuario = new ModeloUsuario();
    }

    public function index()
    {
        if (isset($_SESSION["id_user"])) {
            echo view('admin/header');
            echo view('admin/index');
            echo view('admin/footer');
        } else {
            return redirect()->to(base_url() . 'login');
        }
    }

    public function usuario()
    {
        echo view('admin/header');
        echo view('admin/usuario');
        echo view('admin/footer');
    }

    public function tecnologi()
    {
        echo view('admin/header');
        echo view('admin/tecnologi');
        echo view('admin/footer');
    }

    public function perfil()
    {
        echo view('admin/header');
        echo view('admin/informacion');
        echo view('admin/footer');
    }

    public function tipo_proyecto()
    {
        echo view('admin/header');
        echo view('admin/tipo_proyecto');
        echo view('admin/footer');
    }

    public function new_proyecto()
    {
        $lenguaje = $this->usuario->TraerLenguaje();
        $tecnologia = $this->usuario->TraerTecnologia();
        $tipo = $this->usuario->TraerTipoProyecto();

        $data = [
            'lenguaje' => $lenguaje,
            'tecnologia' => $tecnologia,
            'tipo' => $tipo
        ];

        echo view('admin/header');
        echo view('admin/new_proyecto', $data);
        echo view('admin/footer');
    }

    public function ListaProyectos()
    {
        $lista = $this->usuario->ListaProyectos();

        $data = [
            'lista' => $lista
        ];

        echo view('admin/header');
        echo view('admin/listado_proyectos', $data);
        echo view('admin/footer');
    }

    public function EditarProyecto($id)
    {
        $proyecto = $this->usuario->ListaProyectos_id($id);
        $imagenes = $this->usuario->ListaProyectos_imagenes($id);
        $lenguaje = $this->usuario->TraerLenguaje();
        $tecnologia = $this->usuario->TraerTecnologia();
        $tipo = $this->usuario->TraerTipoProyecto();

        $data = [
            'proyecto' => $proyecto,
            'imagenes' => $imagenes,
            'lenguaje' => $lenguaje,
            'tecnologia' => $tecnologia,
            'tipo' => $tipo
        ];

        echo view('admin/header');
        echo view('admin/editar_proyecto', $data);
        echo view('admin/footer');
    }



    // funcion de ajax USUARIO

    public function CrearUsuario()
    {
        $nombre = $this->request->getPost('nombres');
        $usuario = $this->request->getPost('usuario');
        $correo = $this->request->getPost('correo');
        $password = $this->request->getPost('password');

        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        if (!empty($imageFile)) {
            $valor = $this->usuario->registra_usuario($nombre, $correo, $usuario, $password, $nombrearchivo);
            if ($valor == "1") {
                $imageFile->move(ROOTPATH . 'public/img/usuario/', $nombrearchivo);
                echo $valor;
                exit();
            } else {
                echo $valor;
                exit();
            }
        } else {
            $imagen = "admin.jpg";
            $valor = $this->usuario->registra_usuario($nombre, $correo, $usuario, $password, $imagen);
            echo $valor;
            exit();
        }
    }

    public function ListarUsuario()
    {
        $data = $this->usuario->ListarUsuario();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
        }
        exit();
    }

    public function EstadoUsuario()
    {
        $id = $this->request->getPost('id');
        $dato = $this->request->getPost('dato');
        $valor = $this->usuario->EstadoUsuario($id, $dato);
        echo $valor;
        exit();
    }

    public function EditarUsuario()
    {
        $nombre = $this->request->getPost('nombres');
        $usuario = $this->request->getPost('usuario');
        $correo = $this->request->getPost('correo');
        $id = $this->request->getPost('id');

        $valor = $this->usuario->EditarUsuario($nombre, $correo, $usuario, $id);
        echo $valor;
        exit();
    }

    public function EditarFotoUser()
    {
        $id = $this->request->getPost('id');
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valor = $this->usuario->EditarFotoUser($id, $nombrearchivo);
        if ($valor == "1") {

            if ($ruta_actual != "admin.jpg") {
                unlink(ROOTPATH . 'public/img/usuario/' . $ruta_actual);
            }

            $imageFile->move(ROOTPATH . 'public/img/usuario/', $nombrearchivo);
            echo $valor;
        } else {
            echo $valor;
        }
        exit();
    }

    // funcion de ajax LENGUAJE

    public function CrearLenguaje()
    {
        $nombre = $this->request->getPost('nombres');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valor = $this->usuario->RegistraLenguaje($nombre, $nombrearchivo);
        if ($valor == "1") {
            $imageFile->move(ROOTPATH . 'public/img/lenguaje/', $nombrearchivo);
            echo $valor;
        } else {
            echo $valor;
        }
        exit();
    }

    public function ListarLenguaje()
    {
        $data = $this->usuario->ListarLenguaje();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
        }
        exit();
    }

    public function EstadoLenguaje()
    {
        $id = $this->request->getPost('id');
        $dato = $this->request->getPost('dato');
        $valor = $this->usuario->EstadoLenguaje($id, $dato);
        echo $valor;
        exit();
    }

    public function EditarLenguaje()
    {
        $nombre = $this->request->getPost('nombres');
        $id = $this->request->getPost('id');

        $valor = $this->usuario->EditarLenguaje($nombre, $id);
        echo $valor;
        exit();
    }

    public function EditarFotoLneguaje()
    {
        $id = $this->request->getPost('id');
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valor = $this->usuario->EditarFotoLneguaje($id, $nombrearchivo);
        if ($valor == "1") {

            if ($ruta_actual != "lenguaje.jpg") {
                unlink(ROOTPATH . 'public/img/lenguaje/' . $ruta_actual);
            }

            $imageFile->move(ROOTPATH . 'public/img/lenguaje/', $nombrearchivo);
            echo $valor;
        } else {
            echo $valor;
        }
        exit();
    }

    // funcion de ajax TECNOLOGIA

    public function CrearTecnologia()
    {
        $nombre = $this->request->getPost('nombres');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valor = $this->usuario->CrearTecnologia($nombre, $nombrearchivo);
        if ($valor == "1") {
            $imageFile->move(ROOTPATH . 'public/img/tecnologia/', $nombrearchivo);
            echo $valor;
        } else {
            echo $valor;
        }
        exit();
    }

    public function ListarTecnologia()
    {
        $data = $this->usuario->ListarTecnologia();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
        }
        exit();
    }

    public function EstadoTecnologia()
    {
        $id = $this->request->getPost('id');
        $dato = $this->request->getPost('dato');
        $valor = $this->usuario->EstadoTecnologia($id, $dato);
        echo $valor;
        exit();
    }

    public function EditarTecnologia()
    {
        $nombre = $this->request->getPost('nombres');
        $id = $this->request->getPost('id');

        $valor = $this->usuario->EditarTecnologia($nombre, $id);
        echo $valor;
        exit();
    }

    public function EditarFotoTecnologia()
    {
        $id = $this->request->getPost('id');
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valor = $this->usuario->EditarFotoTecnologia($id, $nombrearchivo);
        if ($valor == "1") {

            if ($ruta_actual != "tecnologia.jpg") {
                unlink(ROOTPATH . 'public/img/tecnologia/' . $ruta_actual);
            }

            $imageFile->move(ROOTPATH . 'public/img/tecnologia/', $nombrearchivo);
            echo $valor;
        } else {
            echo $valor;
        }
        exit();
    }

    // funcion de ajax perfil

    public function ListarPerfil()
    {
        $valor = $this->usuario->ListarPerfil();
        echo json_encode($valor, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function EditarDatosPerfil()
    {
        $nombre = $this->request->getPost('nombres');
        $apellido = $this->request->getPost('apellidos');
        $correo = $this->request->getPost('correo');
        $telefono = $this->request->getPost('telefono');
        $pais = $this->request->getPost('pais');
        $direccion = $this->request->getPost('direccion');
        $sobremi = $this->request->getPost('sobremi');
        $profesion = $this->request->getPost('profesion');

        $valor = $this->usuario->EditarDatosPerfil($nombre, $apellido, $correo, $telefono, $pais, $direccion, $sobremi, $profesion);
        echo $valor;
        exit();
    }

    public function CargarHojaVida()
    {
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $filePdf = $this->request->getFile('pdf');
        $valor = $this->usuario->CargarHojaVida($nombrearchivo);
        if ($valor == "1") {
            if (file_exists(ROOTPATH . 'public/file/HojaVida/' . $ruta_actual)) {
                unlink(ROOTPATH . 'public/file/HojaVida/' . $ruta_actual);
            }
            $filePdf->move(ROOTPATH . 'public/file/HojaVida/', $nombrearchivo);
            echo $valor;
        } else {

            echo $valor;
        }
        exit();
    }

    public function EditarFotoPerfil()
    {

        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valor = $this->usuario->EditarFotoPerfil($nombrearchivo);
        if ($valor == "1") {

            if (file_exists(ROOTPATH . 'public/img/usuario/' . $ruta_actual)) {
                unlink(ROOTPATH . 'public/img/usuario/' . $ruta_actual);
            }

            $imageFile->move(ROOTPATH . 'public/img/usuario/', $nombrearchivo);
            echo $valor;
        } else {
            echo $valor;
        }
        exit();
    }

    // funcion de ajax TIPO

    public function CrearTipos()
    {
        $nombre = $this->request->getPost('nombres');
        $valor = $this->usuario->CrearTipos($nombre);
        echo $valor;
        exit();
    }

    public function ListarTipos()
    {
        $data = $this->usuario->ListarTipos();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
        }
        exit();
    }

    public function Estadotipo()
    {
        $id = $this->request->getPost('id');
        $dato = $this->request->getPost('dato');
        $valor = $this->usuario->Estadotipo($id, $dato);
        echo $valor;
        exit();
    }

    public function EditaTiposs()
    {
        $nombre = $this->request->getPost('nombres');
        $id = $this->request->getPost('id');
        $valor = $this->usuario->EditaTiposs($nombre, $id);
        echo $valor;
        exit();
    }

    // funcion de ajax registrar tecnologia

    public function RegistrarProyecto()
    {

        $nombre = $this->request->getPost('nombre_proyecto');
        $precio = $this->request->getPost('precio_proyecto');
        $descuento = $this->request->getPost('descuento_proyecto');
        $tipo_des = $this->request->getPost('tipo_descuento');
        $idlenguaje = $this->request->getPost('idlenguaje');
        $idtecnologia = $this->request->getPost('idtecnologia');
        $id_tipo_proyecto = $this->request->getPost('id_tipo_proyecto');
        $fecha_creacion = $this->request->getPost('fecha_creacion');
        $detalle_proyecto = $this->request->getPost('detalle_proyecto');

        $valor = $this->usuario->RegistrarProyecto($nombre, $precio, $descuento, $tipo_des, $idlenguaje, $idtecnologia, $id_tipo_proyecto, $fecha_creacion, $detalle_proyecto);

        if (is_numeric($valor)) {

            $count = 0;
            foreach ($_FILES["img_extra"]["name"] as $key => $value) {
                $extra = explode('.', $_FILES["img_extra"]["name"][$key]);
                $renombrar = sha1($_FILES["img_extra"]["name"][$key]) . time();
                $nombre_final = $renombrar . "" . $count . "." . $extra[1];

                $valor_img = $this->usuario->RegistrarProyectoImagen($valor, $nombre_final);
                
                if ($valor_img == 1) {
                    move_uploaded_file($_FILES["img_extra"]["tmp_name"][$key], ROOTPATH . 'public/img/proyectos/' . $nombre_final);
                }

                $count++;
            }
            echo $valor_img;
        } else {
            echo $valor;
        }
        exit();
    }

    public function EditarFotoProducto()
    {
        $id = $this->request->getPost('id');
        $count = 0;
        if (!empty($_FILES["img_extra"]["tmp_name"])) {
            foreach ($_FILES["img_extra"]["name"] as $key => $value) {
                
                $extra = explode('.', $_FILES["img_extra"]["name"][$key]);
                $renombrar = sha1($_FILES["img_extra"]["name"][$key]) . time();
                $nombre_final = $renombrar . "" . $count . "." . $extra[1];

                $valor_img = $this->usuario->RegistrarProyectoImagen($id, $nombre_final);
                if ($valor_img == 1) {
                    move_uploaded_file($_FILES["img_extra"]["tmp_name"][$key], ROOTPATH . 'public/img/proyectos/' . $nombre_final);
                }
                $count++;
            }
            echo $valor_img;
            exit();
        } else {
            echo 2;
            exit();
        }
    }

    public function QuitarImagenProyecto()
    {
        $id = $this->request->getPost('id');
        $id_proyecto = $this->request->getPost('id_proyecto');
        $foto = $this->request->getPost('foto');

        $valor = $this->usuario->QuitarImagenProyecto($id, $id_proyecto);

        if ($valor == "1") {
            unlink(ROOTPATH . 'public/img/proyectos/' . $foto);
        }

        echo $valor;
        exit();
    }
}
