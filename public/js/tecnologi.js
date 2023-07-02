var TablaLenguaje, TablaTecnologia;

$(document).ready(function () {
  ListarLenguajes();
  ListarTecnologia();
});

// LENGUAJES

function RegistraLenguaje() {
  let nombres = $("#nombresLenguaje").val();
  let foto = $("#fotoLenguaje").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    foto.length == 0 ||
    foto.trim() == ""
  ) {
    validarLenguaje(nombres, foto);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombresLenguaje_obligg").html("");
    $("#fotoLenguaje_obligg").html("");
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
  foto = $("#fotoLenguaje")[0].files[0];

  $("#nuevoLenguaje").LoadingOverlay("show", {
    text: "Cargando...",
  });

  formdata.append("nombres", nombres.trim());
  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: BaseUrl + "admin/CrearLenguaje",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevoLenguaje").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevoLenguaje").modal("hide");
          TablaLenguaje.ajax.reload();
          return swal.fire(
            "Lenguaje correcto",
            "El lenguaje se registro con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Lenguaje ya existe",
            "El lenguaje '" + nombres + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al registrar el lenguaje", "error");
      }
    },
  });
  return false;
}

function validarLenguaje(nombres, foto) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombresLenguaje_obligg").html(" - Ingrese el nombre");
  } else {
    $("#nombresLenguaje_obligg").html("");
  }

  if (foto.length == 0 || foto.trim() == "") {
    $("#fotoLenguaje_obligg").html(" - Ingrese la foto");
  } else {
    $("#fotoLenguaje_obligg").html("");
  }
}

function ListarLenguajes() {
  TablaLenguaje = $("#TablaLenguaje").DataTable({
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
      url: BaseUrl + "admin/ListarLenguaje",
      type: "GET",
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      //{ defaultContent: "" },
      { data: "nombre" },
      {
        data: "foto",
        render: function (data, type, row) {
          return (
            "<img style='border-radius: 50px;' src=" +
            BaseUrl +
            "public/img/lenguaje/" +
            data +
            " width='45px' />"
          );
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<span class="badge badge-success">Activo</span>`;
          } else {
            return `<span class="badge badge-danger">Inactivo</span>`;
          }
        },
      },
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
    order: [[3, "ASC"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  // TablaLenguaje.on("draw.dt", function () {
  //   var pageinfo = $("#TablaLenguaje").DataTable().page.info();
  //   TablaLenguaje.column(0, { page: "current" })
  //     .nodes()
  //     .each(function (cell, i) {
  //       cell.innerHTML = i + 1 + pageinfo.start;
  //     });
  // });
}

$("#TablaLenguaje").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaLenguaje.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaLenguaje.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaLenguaje.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del lenguaje se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_lenguaje(id, dato);
    }
  });
});

$("#TablaLenguaje").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaLenguaje.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaLenguaje.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaLenguaje.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del lenguaje se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_lenguaje(id, dato);
    }
  });
});

function cambiar_estado_lenguaje(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  $.ajax({
    url: BaseUrl + "admin/EstadoLenguaje",
    type: "POST",
    data: { id: id, dato: dato },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        TablaLenguaje.ajax.reload();
        return swal.fire(
          "Estado del lenguaje",
          "EL estado se " + res + " con exito",
          "success"
        );
      }
    } else {
      return swal.fire(
        "Estado del lenguaje",
        "No se pudo cambiar el estado",
        "error"
      );
    }
  });
}

$("#TablaLenguaje").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaLenguaje.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaLenguaje.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaLenguaje.row(this).data();
  }

  $("#idlenguajeedit").val(data.id);
  $("#nombresLenguajeedit").val(data.nombre);

  $("#nombresLenguaje_obliggedit").html("");

  $("#nuevoLenguajeedit").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#nuevoLenguajeedit").modal("show");
});

function EditarLneguaje() {
  let id = $("#idlenguajeedit").val();
  let nombre = $("#nombresLenguajeedit").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombresLenguaje_obliggedit").html("Ingrese nombre");
    return swal.fire(
      "Campo vacio",
      "El campo no debe quedar vacio, complete los datos",
      "warning"
    );
  } else {
    $("#nombresLenguaje_obliggedit").html("");
  }

  $("#nuevoLenguajeedit").LoadingOverlay("show", {
    text: "Cargando...",
  });

  var formdata = new FormData();
  formdata.append("nombres", nombre.trim());
  formdata.append("id", id);

  $.ajax({
    url: BaseUrl + "admin/EditarLenguaje",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevoLenguajeedit").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevoLenguajeedit").modal("hide");
          TablaLenguaje.ajax.reload();
          return swal.fire(
            "Lenguaje correcto",
            "El lenguaje se edito con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Lenguaje ya existe",
            "El lenguaje '" + nombre + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al editar el lenguaje", "error");
      }
    },
  });
  return false;
}

$("#TablaLenguaje").on("click", ".editarfoto", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaLenguaje.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaLenguaje.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaLenguaje.row(this).data();
  }

  var id = data.id;
  var foto = data.foto;

  $("#id_foto_lenguaje").val(id);
  $("#foto_actu_lenguaje").val(foto);
  $("#foto_lenguaje").attr("src", BaseUrl + "public/img/lenguaje/" + foto);

  $("#ModalFotoLenguaje").modal({ backdrop: "static", keyboard: false });
  $("#ModalFotoLenguaje").modal("show");
});

function editar_foto_lenguaje() {
  var id = document.getElementById("id_foto_lenguaje").value;
  var foto = document.getElementById("foto_new_lenguaje").value;
  var ruta_actual = document.getElementById("foto_actu_lenguaje").value;

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
  var foto = $("#foto_new_lenguaje")[0].files[0];

  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  $("#ModalFotoLenguaje").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "admin/EditarFotoLneguaje",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#ModalFotoLenguaje").LoadingOverlay("hide");

      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_new_lenguaje").value = "";
          TablaLenguaje.ajax.reload();
          $("#ModalFotoLenguaje").modal("hide");
          return swal.fire(
            "Foto lenguaje",
            "La foto de lenguaje se edito con exito",
            "success"
          );
        }
      } else {
        return swal.fire(
          "Error",
          "No se pudo editar la foto de lenguaje",
          "error"
        );
      }
    },
  });
  return false;
}

//TECNOLOGIAS

function RegistrarTecnologia() {
  let nombres = $("#nombresTecnologia").val();
  let foto = $("#fototecnologia").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    foto.length == 0 ||
    foto.trim() == ""
  ) {
    validarTecnologia(nombres, foto);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombresTecnologia_obligg").html("");
    $("#fotoTecnologia_obligg").html("");
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
  foto = $("#fototecnologia")[0].files[0];

  $("#nuevaTecnologia").LoadingOverlay("show", {
    text: "Cargando...",
  });

  formdata.append("nombres", nombres.trim());
  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: BaseUrl + "admin/CrearTecnologia",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevaTecnologia").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevaTecnologia").modal("hide");
          TablaTecnologia.ajax.reload();
          return swal.fire(
            "Tecnologia correcto",
            "La tecnologia se registro con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Tecnologia ya existe",
            "La tecnologia '" + nombres + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al registrar la tecnologia", "error");
      }
    },
  });
  return false;
}

function validarTecnologia(nombres, foto) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombresTecnologia_obligg").html(" - Ingrese el nombre");
  } else {
    $("#nombresTecnologia_obligg").html("");
  }

  if (foto.length == 0 || foto.trim() == "") {
    $("#fotoTecnologia_obligg").html(" - Ingrese la foto");
  } else {
    $("#fotoTecnologia_obligg").html("");
  }
}

function ListarTecnologia() {
  TablaTecnologia = $("#TablaTecnologia").DataTable({
    // ordering: true,
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
      url: BaseUrl + "admin/ListarTecnologia",
      type: "GET",
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      //{ defaultContent: "" },
      { data: "nombre" },
      {
        data: "foto",
        render: function (data, type, row) {
          return (
            "<img style='border-radius: 50px;' src=" +
            BaseUrl +
            "public/img/tecnologia/" +
            data +
            " width='45px' />"
          );
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<span class="badge badge-success">Activo</span>`;
          } else {
            return `<span class="badge badge-danger">Inactivo</span>`;
          }
        },
      },
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
    order: [[3, "ASC"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  // TablaTecnologia.on("draw.dt", function () {
  //   var pageinfo = $("#TablaTecnologia").DataTable().page.info();
  //   TablaTecnologia.column(0, { page: "current" })
  //     .nodes()
  //     .each(function (cell, i) {
  //       cell.innerHTML = i + 1 + pageinfo.start;
  //     });
  // });
}

$("#TablaTecnologia").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaTecnologia.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaTecnologia.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaTecnologia.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la tecnologia se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tecnologia(id, dato);
    }
  });
});

$("#TablaTecnologia").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaTecnologia.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaTecnologia.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaTecnologia.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la tecnologia se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tecnologia(id, dato);
    }
  });
});

function cambiar_estado_tecnologia(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  $.ajax({
    url: BaseUrl + "admin/EstadoTecnologia",
    type: "POST",
    data: { id: id, dato: dato },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        TablaTecnologia.ajax.reload();
        return swal.fire(
          "Estado de la tecnologia",
          "EL estado se " + res + " con exito",
          "success"
        );
      }
    } else {
      return swal.fire(
        "Estado de la tecnologia",
        "No se pudo cambiar el estado",
        "error"
      );
    }
  });
}

$("#TablaTecnologia").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaTecnologia.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaTecnologia.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaTecnologia.row(this).data();
  }

  $("#idtecnologiaedit").val(data.id);
  $("#nombresTecnologiaeditar").val(data.nombre);

  $("#nombresTecnologiaeditar_obligg").html("");

  $("#nuevaTecnologiaeditar").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#nuevaTecnologiaeditar").modal("show");
});

function EditarTecnologia() {
  let id = $("#idtecnologiaedit").val();
  let nombre = $("#nombresTecnologiaeditar").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombresTecnologiaeditar_obligg").html("Ingrese nombre");
    return swal.fire(
      "Campo vacio",
      "El campo no debe quedar vacio, complete los datos",
      "warning"
    );
  } else {
    $("#nombresTecnologiaeditar_obligg").html("");
  }

  $("#nuevaTecnologiaeditar").LoadingOverlay("show", {
    text: "Cargando...",
  });

  var formdata = new FormData();
  formdata.append("nombres", nombre.trim());
  formdata.append("id", id);

  $.ajax({
    url: BaseUrl + "admin/EditarTecnologia",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevaTecnologiaeditar").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevaTecnologiaeditar").modal("hide");
          TablaTecnologia.ajax.reload();
          return swal.fire(
            "Tecnologia correcto",
            "La tecnologia se edito con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Tecnologia ya existe",
            "La tecnologia '" + nombre + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al editar la tecnologia", "error");
      }
    },
  });
  return false;
}

$("#TablaTecnologia").on("click", ".editarfoto", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaTecnologia.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaTecnologia.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaTecnologia.row(this).data();
  }

  var id = data.id;
  var foto = data.foto;

  $("#id_foto_tecnologia").val(id);
  $("#foto_actu_tecnologia").val(foto);
  $("#foto_tecnologia").attr("src", BaseUrl + "public/img/tecnologia/" + foto);

  $("#ModalFotoTecnologia").modal({ backdrop: "static", keyboard: false });
  $("#ModalFotoTecnologia").modal("show");
});

function editar_foto_tecnologia() {
  var id = document.getElementById("id_foto_tecnologia").value;
  var foto = document.getElementById("foto_new_tecnologia").value;
  var ruta_actual = document.getElementById("foto_actu_tecnologia").value;

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
  var foto = $("#foto_new_tecnologia")[0].files[0];

  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  $("#ModalFotoLenguaje").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "admin/EditarFotoTecnologia",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#ModalFotoTecnologia").LoadingOverlay("hide");

      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_new_lenguaje").value = "";
          TablaTecnologia.ajax.reload();
          $("#ModalFotoTecnologia").modal("hide");
          return swal.fire(
            "Foto tecnologia",
            "La foto de tecnologia se edito con exito",
            "success"
          );
        }
      } else {
        return swal.fire(
          "Error",
          "No se pudo editar la foto de tecnologia",
          "error"
        );
      }
    },
  });
  return false;
}
