var valor;

$(document).ready(function () {
  ListarDatosPerfil();
});

$("#correo").keyup(function () {
  if (this.value != "") {
    document.getElementById("correo").addEventListener("input", function () {
      campo = event.target;
      //este codigo me da formato email
      email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
      //esto es para validar si es un email valida
      if (email.test(campo.value)) {
        //estilos para cambiar de color y ocultar el boton
        $(this).css("border", "1px solid green");
        $("#correoperfil_oblig").html("");
        correoPerfil = true;
      } else {
        $(this).css("border", "1px solid red");
        $("#correoperfil_oblig").html("Email incorrecto");
        correoPerfil = false;
      }
    });
  } else {
    $(this).css("border", "1px solid green");
    $("#correoperfil_oblig").html("");
    correoPerfil = false;
  }
});

function ListarDatosPerfil() {
  $.ajax({
    type: "GET",
    url: BaseUrl + "admin/ListarPerfil",
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function (response) {
      $("#nombre_perfil").html(
        response["nombre"] + " " + response["apellidois"]
      );
      $("#nombres").val(response["nombre"]);
      $("#apellidos").val(response["apellidois"]);
      $("#correo").val(response["correo"]);
      $("#telefono").val(response["telefono"]);
      $("#pais").val(response["pais"]);
      $("#direccion").val(response["direccion"]);
      $("#sobremi").val(response["sobremi"]);
      $("#profesion").val(response["profesion"]);
      $("#hoja_actual").val(response["hojavida"]);
      $("#verhojavida").attr("href",  BaseUrl + "public/file/HojaVida/" + response["hojavida"]);
      $("#foto_perfil").attr(
        "src",
        BaseUrl + "public/img/usuario/" + response["foto"]
      );
      $("#fotomia_actual").val(response["foto"]);
    },
  });
}

function EditarDatosPerfil() {
  let nombres = $("#nombres").val();
  let apellidos = $("#apellidos").val();
  let correo = $("#correo").val();
  let telefono = $("#telefono").val();
  let pais = $("#pais").val();
  let direccion = $("#direccion").val();
  let sobremi = $("#sobremi").val();
  let profesion = $("#profesion").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == "" ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    sobremi.length == 0 ||
    sobremi.trim() == "" ||
    profesion.length == 0 ||
    profesion.trim() == "" ||
    pais.length == 0 ||
    pais.trim() == ""
  ) {
    validarDatosPerfil(
      nombres,
      apellidos,
      correo,
      telefono,
      direccion,
      sobremi,
      profesion,
      pais
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombresperfil_oblig").html("");
    $("#apellidosperfil_oblig").html("");
    $("#correoperfil_oblig").html("");
    $("#telefonoperfil_oblig").html("");
    $("#direccionperfil_oblig").html("");
    $("#sobremiperfil_oblig").html("");
    $("#profesionperfil_oblig").html("");
    $("#paisperfil_oblig").html("");
  }

  if (!correoPerfil) {
    $("#correoperfil_oblig").html("Correo no valida");
    return swal.fire(
      "Correo no valido",
      "El correo ingresado no es valido",
      "warning"
    );
  } else {
    $("#correoperfil_oblig").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "admin/EditarDatosPerfil",
    data: {
      nombres: nombres,
      apellidos: apellidos,
      correo: correo,
      telefono: telefono,
      pais: pais,
      direccion: direccion,
      sobremi: sobremi,
      profesion: profesion,
    },
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          ListarDatosPerfil();
          return swal.fire(
            "Perfil correcto",
            "El perfil se edito con exito",
            "success"
          );
        }
      } else {
        return swal.fire("Error", "Error al editar el perfil", "error");
      }
    },
  });
}

function validarDatosPerfil(
  nombres,
  apellidos,
  correo,
  telefono,
  direccion,
  sobremi,
  profesion,
  pais
) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombresperfil_oblig").html(" - Ingrese los nombres");
  } else {
    $("#nombresperfil_oblig").html("");
  }

  if (apellidos.length == 0 || apellidos.trim() == "") {
    $("#apellidosperfil_oblig").html(" - Ingrese los apellidos");
  } else {
    $("#apellidosperfil_oblig").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correoperfil_oblig").html(" - Ingrese el correo");
  } else {
    $("#correoperfil_oblig").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefonoperfil_oblig").html(" - Ingrese el telefono");
  } else {
    $("#telefonoperfil_oblig").html("");
  }

  if (direccion.length == 0 || direccion == 0) {
    $("#direccionperfil_oblig").html(" - Repita el password");
  } else {
    $("#direccionperfil_oblig").html("");
  }

  if (sobremi.length == 0 || sobremi == 0) {
    $("#sobremiperfil_oblig").html(" - Repita la dirección");
  } else {
    $("#sobremiperfil_oblig").html("");
  }

  if (profesion.length == 0 || profesion == 0) {
    $("#profesionperfil_oblig").html(" - Repita la profesión");
  } else {
    $("#profesionperfil_oblig").html("");
  }

  if (pais.length == 0 || pais == 0) {
    $("#paisperfil_oblig").html(" - Repita el pais");
  } else {
    $("#paisperfil_oblig").html("");
  }
}

function SubirHojaVida() {
  var pdf = document.getElementById("hoja_vida").value;
  var ruta_actual = document.getElementById("hoja_actual").value;

  if (pdf == "" || ruta_actual.length == 0 || ruta_actual == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un pdf para actualizar",
      "warning"
    );
  }

  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = pdf.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "PDF" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var pdf = $("#hoja_vida")[0].files[0];

  formdata.append("pdf", pdf);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".tile").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "admin/CargarHojaVida",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".tile").LoadingOverlay("hide");

      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("hoja_vida").value = "";

          return swal.fire(
            "Pdf cargado",
            "La hoja de vida se cargo con exito",
            "success"
          );
        }
      } else {
        return swal.fire("Error", "No se pudo cargar la hoja de vida", "error");
      }
    },
  });
  return false;
}

function EditarFotoPerfil() {
  var foto = document.getElementById("fotomia").value;
  var ruta_actual = document.getElementById("fotomia_actual").value;

  if (foto == "" || ruta_actual.length == 0 || ruta_actual == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para actualizar",
      "warning"
    );
  }

  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#fotomia")[0].files[0];

  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".info").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "admin/EditarFotoPerfil",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".info").LoadingOverlay("hide");

      if (resp > 0) {
        if (resp == 1) {
          ListarDatosPerfil();
          document.getElementById("fotomia").value = "";

          return swal.fire(
            "Foto perfil",
            "La foto de perfil se edito con exito",
            "success"
          );
        }
      } else {
        return swal.fire(
          "Error",
          "No se pudo editar la foto de perfil",
          "error"
        );
      }
    },
  });
  return false;
}
