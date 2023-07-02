var TableUsuario;

listar_usuario();

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
        $("#correo_obligg").html("");
        correo_usus = true;
      } else {
        $(this).css("border", "1px solid red");
        $("#correo_obligg").html("Email incorrecto");
        correo_usus = false;
      }
    });
  } else {
    $(this).css("border", "1px solid green");
    $("#correo_obligg").html("");
    correo_usus = false;
  }
});

$("#correoedit").keyup(function () {
  if (this.value != "") {
    document
      .getElementById("correoedit")
      .addEventListener("input", function () {
        campo = event.target;
        //este codigo me da formato email
        email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        //esto es para validar si es un email valida
        if (email.test(campo.value)) {
          //estilos para cambiar de color y ocultar el boton
          $(this).css("border", "1px solid green");
          $("#correo_obliggedit").html("");
          correo_edit = true;
        } else {
          $(this).css("border", "1px solid red");
          $("#correo_obliggedit").html("Email incorrecto");
          correo_edit = false;
        }
      });
  } else {
    $(this).css("border", "1px solid green");
    $("#correo_obliggedit").html("");
    correo_edit = false;
  }
});

function RegistrarUsuario() {
  let nombres = $("#nombres").val();
  let usuario = $("#usuario").val();
  let correo = $("#correo").val();
  let password = $("#password").val();
  let repetir_password = $("#repetir_password").val();
  let foto = $("#foto").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    usuario.length == 0 ||
    usuario.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    password.length == 0 ||
    password.trim() == "" ||
    repetir_password.length == 0 ||
    repetir_password.trim() == ""
  ) {
    validar_registros(nombres, usuario, correo, password, repetir_password);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_obligg").html("");
    $("#usuario_obligg").html("");
    $("#correo_obligg").html("");
    $("#password_obligg").html("");
    $("#password_c_obligg").html("");
  }

  if (password != repetir_password) {
    $("#password_obligg").html("No coinciden");
    $("#password_c_obligg").html("No coinciden");
    return swal.fire(
      "Password incorrecto",
      "Los password no coinciden",
      "warning"
    );
  } else {
    $("#password_obligg").html("");
    $("#password_c_obligg").html("");
  }

  if (!correo_usus) {
    $("#correo_obligg").html("Correo no valida");
    return swal.fire(
      "Correo no valido",
      "El correo ingresado no es valido",
      "warning"
    );
  } else {
    $("#correo_obligg").html("");
  }

  var f = new Date();
  var extecion = foto.split(".").pop();
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
  foto = $("#foto")[0].files[0];

  $("#nuevo_usuario").LoadingOverlay("show", {
    text: "Cargando...",
  });

  formdata.append("nombres", nombres.trim());
  formdata.append("usuario", usuario.trim());
  formdata.append("correo", correo.trim());
  formdata.append("password", password.trim());

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: BaseUrl + "admin/CrearUsuario",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevo_usuario").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevo_usuario").modal("hide");
          TableUsuario.ajax.reload();
          return swal.fire(
            "Usuario correcto",
            "El usuario se registro con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Correo ya existe",
            "El correo '" + correo + "', ya esta registrado",
            "warning"
          );
        } else if (resp == 3) {
          return swal.fire(
            "Usuario ya existe",
            "El usuario '" + usuario + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al registrar el usuario", "error");
      }
    },
  });
  return false;
}

function validar_registros(
  nombres,
  usuario,
  correo,
  password,
  repetir_password
) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombres_obligg").html(" - Ingrese los nombres");
  } else {
    $("#nombres_obligg").html("");
  }

  if (usuario.length == 0 || usuario.trim() == "") {
    $("#usuario_obligg").html(" - Ingrese el usuario");
  } else {
    $("#usuario_obligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_obligg").html(" - Ingrese el correo");
  } else {
    $("#correo_obligg").html("");
  }

  if (password.length == 0 || password.trim() == "") {
    $("#password_obligg").html(" - Ingrese el password");
  } else {
    $("#password_obligg").html("");
  }

  if (repetir_password.length == 0 || repetir_password == 0) {
    $("#password_c_obligg").html(" - Repita el password");
  } else {
    $("#password_c_obligg").html("");
  }
}

function listar_usuario() {
  TableUsuario = $("#TableUsuario").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: BaseUrl + "admin/ListarUsuario",
      type: "GET",
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },

      { data: "nombres" },
      { data: "correo" },
      {
        data: "foto",
        render: function (data, type, row) {
          return (
            "<img style='border-radius: 50px;' src=" +
            BaseUrl +
            "public/img/usuario/" +
            data +
            " width='45px' />"
          );
        },
      },
      { data: "usuario" },
      { data: "fecha" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button class='inactivar btn btn-danger btn-sm' title='Inactivar el usuario'><i class='fa fa-times'></i></button>-
            <button class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></button>-
            <button class='editarfoto btn btn-warning btn-sm' title='Editar foto'><i class='fa fa-photo'></i></button>`;
          } else {
            return `<button class='activar btn btn-success btn-sm' title='Activar el usuario'><i class='fa fa-check'></i></button>-
            <button class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></button>-
            <button class='editarfoto btn btn-warning btn-sm' title='Editar foto'><i class='fa fa-photo'></i></button>`;
          }
        },
      },
    ],

    language: {
      rows: "%d fila seleccionada",
      processing: "Tratamiento en curso...",
      search: "Buscar&nbsp;:",
      lengthMenu: "Agrupar en _MENU_ items",
      info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
      infoEmpty: "No existe datos.",
      infoFiltered: "(filtrado de _MAX_ elementos en total)",
      infoPostFix: "",
      loadingRecords: "Cargando...",
      zeroRecords: "No se encontro resultados en tu busqueda",
      emptyTable: "No hay datos disponibles en la tabla",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Ultimo",
      },
      select: {
        rows: "%d fila seleccionada",
      },
      aria: {
        sortAscending: ": active para ordenar la columa en orden ascendente",
        sortDescending: ": active para ordenar la columna en orden descendente",
      },
    },

    select: true,
    responsive: "true",
    // dom: "Bfrtilp",
    // buttons: [
    //   {
    //     extend: "excelHtml5",
    //     text: "Excel",
    //     titleAttr: "Exportar a Excel",
    //     className: "badge badge-success greenlover",
    //   },
    //   {
    //     extend: "pdfHtml5",
    //     text: "PDF",
    //     titleAttr: "Exportar a PDF",
    //     className: "badge badge-danger redfule",
    //   },
    //   {
    //     extend: "print",
    //     text: "Imprimir",
    //     titleAttr: "Imprimir",
    //     className: "badge badge-primary azuldete",
    //   },
    // ],
    order: [[0, "ASC"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  TableUsuario.on("draw.dt", function () {
    var pageinfo = $("#TableUsuario").DataTable().page.info();
    TableUsuario.column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#TableUsuario").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TableUsuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TableUsuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TableUsuario.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del usuario se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

$("#TableUsuario").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TableUsuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TableUsuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TableUsuario.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del usuario se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

function cambiar_estado_usuario(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  $.ajax({
    url: BaseUrl + "admin/EstadoUsuario",
    type: "POST",
    data: { id: id, dato: dato },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        TableUsuario.ajax.reload();
        return swal.fire(
          "Estado del usuario",
          "EL estado se " + res + " con exito",
          "success"
        );
      }
    } else {
      return swal.fire(
        "Estado del usuario",
        "No se pudo cambiar el estado",
        "error"
      );
    }
  });
}

$("#TableUsuario").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TableUsuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TableUsuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TableUsuario.row(this).data();
  }

  $("#id_usaer").val(data.id);
  $("#nombresedit").val(data.nombres);
  $("#usuairoedit").val(data.usuario);
  $("#correoedit").val(data.correo);

  $("#correoedit").css("border", "1px solid grey");

  $("#nombres_obliggedit").html("");
  $("#usuario_obliggedit").html("");
  $("#correo_obliggedit").html("");

  correo_usus_edit = true;

  $("#nuevo_usuarioEdit").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#nuevo_usuarioEdit").modal("show");
});

function EditarUsuario() {
  let nombres = $("#nombresedit").val();
  let usuario = $("#usuairoedit").val();
  let correo = $("#correoedit").val();
  let id = $("#id_usaer").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    usuario.length == 0 ||
    usuario.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == ""
  ) {
    validar_editar(nombres, usuario, correo);
    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_obliggedit").html("");
    $("#usuario_obliggedit").html("");
    $("#correo_obliggedit").html("");
  }

  if (!correo_edit) {
    $("#correo_obliggedit").html("Correo no valida");
    return swal.fire(
      "Correo no valido",
      "El correo ingresado no es valido",
      "warning"
    );
  } else {
    $("#correo_obliggedit").html("");
  }

  $("#nuevo_usuarioEdit").LoadingOverlay("show", {
    text: "Cargando...",
  });

  var formdata = new FormData();
  formdata.append("nombres", nombres.trim());
  formdata.append("usuario", usuario.trim());
  formdata.append("correo", correo.trim());
  formdata.append("id", id.trim());

  $.ajax({
    url: BaseUrl + "admin/EditarUsuario",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevo_usuarioEdit").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevo_usuarioEdit").modal("hide");
          TableUsuario.ajax.reload();
          return swal.fire(
            "Usuario correcto",
            "El usuario se edito con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Correo ya existe",
            "El correo '" + correo + "', ya esta registrado",
            "warning"
          );
        } else if (resp == 3) {
          return swal.fire(
            "Usuario ya existe",
            "El usuario '" + usuario + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al editar el usuario", "error");
      }
    },
  });
  return false;
}

function validar_editar(nombres, usuario, correo) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombres_obliggedit").html(" - Ingrese los nombres");
  } else {
    $("#nombres_obliggedit").html("");
  }

  if (usuario.length == 0 || usuario.trim() == "") {
    $("#usuario_obliggedit").html(" - Ingrese el usuario");
  } else {
    $("#usuario_obliggedit").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_obliggedit").html(" - Ingrese el correo");
  } else {
    $("#correo_obliggedit").html("");
  }
}

$("#TableUsuario").on("click", ".editarfoto", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TableUsuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TableUsuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TableUsuario.row(this).data();
  }

  var id = data.id;
  var foto = data.foto;

  $("#id_foto").val(id);
  $("#foto_actu").val(foto);
  $("#foto_usuar").attr("src", BaseUrl + "public/img/usuario/" + foto);

  $("#modal_editar_photo").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_photo").modal("show");
});

function editar_foto_usuario() {
  var id = document.getElementById("id_foto").value;
  var foto = document.getElementById("foto_new").value;
  var ruta_actual = document.getElementById("foto_actu").value;

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
  var foto = $("#foto_new")[0].files[0];

  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  $("#modal_editar_photo").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "admin/EditarFotoUser",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#modal_editar_photo").LoadingOverlay("hide");

      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_new").value = "";
          TableUsuario.ajax.reload();
          $("#modal_editar_photo").modal("hide");
          return swal.fire(
            "Foto usuario",
            "La foto de usuario se edito con exito",
            "success"
          );
        }
      } else {
        return swal.fire(
          "Error",
          "No se pudo editar la foto de usuario",
          "error"
        );
      }
    },
  });
  return false;
}
