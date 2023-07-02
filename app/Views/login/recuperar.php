<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recuperar Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/login.png" type="image/x-icon">
</head>

<body>
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center min-vh-100 enviar_correo_full">
            <div class="col-12 col-md-10 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>¿Has olvidado tu contraseña?</h5>
                            <p class="mb-2">Ingrese su correo electrónico registrada para restablecer la contraseña
                            </p>
                        </div>

                        <div class="col-md-12">
                            <div style="
                                    text-align: center;
                                    background: #ff000094; 
                                    padding: 5px;
                                    display: none;
                                    color: white;" id="correo_fail">
                                <span><b> Correo ingresa no es valido</b></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div style="
                                    text-align: center;
                                    background: green; 
                                    padding: 5px;
                                    display: none;
                                    color: white;" id="password_ok">
                                <span><b> Password restabecido con exito, se envio al correo la nueva password!</b></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div style="
                                    text-align: center;
                                    background: #ff000094; 
                                    padding: 5px;
                                    display: none;
                                    color: white;" id="error_correo">
                                <span><b> Error al enviar el correo</b></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="text" id="email" class="form-control" name="email" placeholder="Ingrese su password">
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="button" id="enviar_correo" class="btn btn-primary">
                                Cambiar Password
                            </button>
                        </div>
                        <span><a href="<?php echo base_url(); ?>login">Volver al login</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="<?php echo base_url(); ?>public/admin/js/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    $(document).on('click', '#enviar_correo', function(event) {
        event.preventDefault();
        var correo = $("#email").val();

        $(".enviar_correo_full").LoadingOverlay("show", {
            image: "",
            text: "Enviando correo..."
        });

        $.ajax({
            type: "POST",
            url: BaseUrl + "login/ValidarCorreo",
            data: {
                correo: correo
            },
            success: function(response) {
                $("#correo_fail").hide();
                $("#error_correo").hide();
                $("#password_ok").hide();
                if (response == 0) {
                    $(".enviar_correo_full").LoadingOverlay("hide");
                    $("#correo_fail").show(2000);
                    return false;
                } else {
                    $.ajax({
                        type: "POST",
                        url: BaseUrl + "login/RestablecerPassword",
                        data: {
                            correo: correo
                        },
                        success: function(resp) {
                            if (resp == 1) {
                                $(".enviar_correo_full").LoadingOverlay("hide");
                                $("#correo").val("");
                                $("#password_ok").show(2000);
                            } else {
                                $(".enviar_correo_full").LoadingOverlay("hide");
                                $("#error_correo").show(2000);
                            }
                        }
                    });

                }
            }
        });
    })
</script>