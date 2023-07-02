<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/login.png" type="image/x-icon">
</head>

<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>

<body style="background-color: black; color: white;">

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="<?php echo base_url(); ?>public/img/logo_clave.jpg" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

                    <div style="
                                text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white;
                                display: none;
                            " id="none_usu">
                        <span><b> Ingrese un usuario para continuar</b></span>
                    </div>

                    <div style="
                                text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white;
                                display: none;
                            " id="none_pass">
                        <span><b> Ingrese un password para continuar</b></span>
                    </div>

                    <br>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="login_usuario"><b>Usuario</b></label>
                        <input type="text" maxlength="20" id="login_usuario" class="form-control form-control-lg" placeholder="Ingrese usuario" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="login_password"><b>Password</b></label>
                        <input type="password" maxlength="20" id="login_password" class="form-control form-control-lg" placeholder="Ingrese password" />
                    </div>

                    <div class="alert alert-danger text-center" id="error_logeo" style="color: white; display:none; text-align: center; background: red; border-radius: 15px; padding: 10px;  text-align: center;">
                        <span> Usuario o contraseña incorrectos</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                                Acuérdate de mí
                            </label>
                        </div>
                        <a style="color: white !important;" href="<?php echo base_url(); ?>login/RecuperarPassword" class="text-body">¿Has olvidado tu contraseña?</a>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" onclick="Inicar_Login();" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Ingresar!</button> -  <button type="button" onclick="Tienda();" class="btn btn-danger btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Tienda</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-2 px-2 px-xl-2 bg-primary" style="    position: fixed;
            width: 100%;
            float: inherit; top: 94%;">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © <?php echo date("Y"); ?>.
            </div>
            <!-- Copyright -->
        </div>
    </section>
</body>

</html>

<script src="<?php echo base_url(); ?>public/admin/js/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    function Inicar_Login() {

        var usuario = $("#login_usuario").val();
        var password = $("#login_password").val();

        if (parseInt(usuario.length) <= 0 || usuario == "") {
            $("#none_pass").hide();
            $("#none_usu").hide();
            $("#none_usu").show(2000);
        } else if (parseInt(password.length) <= 0 || password == "") {
            $("#none_usu").hide();
            $("#none_pass").hide();
            $("#none_pass").show(2000);
        } else {
            $("#none_usu").hide();
            $("#none_pass").hide();

            $.ajax({
                url: BaseUrl + "login/IngresarLogin",
                type: "POST",
                data: {
                    usuario: usuario,
                    password: password
                },
            }).done(function(responce) {
                if (responce == 0) {
                    $("#none_usu").hide();
                    $("#none_pass").hide();
                    $("#error_logeo").show(2000);
                    return false;
                } else {
                    var data = JSON.parse(responce);
                    if (data[0] == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Usuario inactivo",
                            text: "El usuario se encuentra inactivo!",
                        });
                    } else {
                        $.ajax({
                            url: BaseUrl + "login/ObtenerIdUser",
                            type: "POST",
                            data: {
                                id_usu: data[3]
                            },
                        }).done(function(res) {
                            if (res == 1) {
                                let timerInterval;
                                Swal.fire({
                                    icon: "info",
                                    title: "Bienvenido al sistema!",
                                    html: "Usted sera redireccionado en <b></b> mi.",
                                    allowOutsideClick: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        const b = Swal.getHtmlContainer().querySelector("b");
                                        timerInterval = setInterval(() => {
                                            b.textContent = Swal.getTimerLeft();
                                        }, 100);
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                    },
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                }
            });
        }

    }

    function Tienda(){
        location.href = BaseUrl;
    }
</script>