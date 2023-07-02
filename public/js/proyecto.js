var TablaTipo;

$(document).ready(function () {
  ListarTipos();
});

//esto muestra la imagen de forma previsualizada
(function () {
  var file = document.getElementById("file");
  var preload = document.querySelector(".preload");
  var publish = document.getElementById("publish");
  var formData = new FormData();

  file.addEventListener("change", function (e) {
    for (var i = 0; i < file.files.length; i++) {
      var thumbnail_id = Math.floor(Math.random() * 30000) + "_" + Date.now();
      createThumbnail(file, i, thumbnail_id);
      formData.append(thumbnail_id, file.files[i]);
    }
  });

  var createThumbnail = function (file, iterator, thumbnail_id) {
    var thumbnail = document.createElement("div");
    thumbnail.classList.add("thumbnail", thumbnail_id);
    thumbnail.dataset.id = thumbnail_id;

    thumbnail.setAttribute(
      "style",
      `background-image: url(${URL.createObjectURL(file.files[iterator])})`
    );

    var nombre = file.files[iterator].name;
    var ext = nombre.substring(nombre.lastIndexOf("."));
    if (ext != ".png" && ext != ".jpg" && ext != ".jpeg") {
      var valida = false;
    } else {
      var valida = true;
    }

    if (!valida) {
      //en caso de que no sean validos las extensiones manda alert y limpio el file
      return alert(
        "este archivo: " +
          nombre +
          " no es valido o no se ha seleccionado archvio"
      );
    }

    document.getElementById("preview-images").appendChild(thumbnail);
    createCloseButton(thumbnail_id);
  };

  var createCloseButton = function (thumbnail_id) {
    var closeButton = document.createElement("div");
    closeButton.classList.add("close-button");
    closeButton.innerText = "x";
    document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton);
  };

  document.body.addEventListener("click", function (e) {
    if (e.target.classList.contains("close-button")) {
      e.target.parentNode.remove();
      formData.delete(e.target.parentNode.dataset.id);
    }
  });
})();

function RegistrarTipo() {
  let nombres = $("#nombre_tipo_").val();

  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombre_tipo__obligg").html("Ingrese el tipo");
    return swal.fire(
      "Campo vacio",
      "El campo no debe quedar vacio, complete el dato",
      "warning"
    );
  } else {
    $("#nombre_tipo__obligg").html("");
  }

  $("#nuevo_tipo").LoadingOverlay("show", {
    text: "Cargando...",
  });

  var formdata = new FormData();
  formdata.append("nombres", nombres.trim());

  $.ajax({
    url: BaseUrl + "admin/CrearTipos",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevo_tipo").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevo_tipo").modal("hide");

          TablaTipo.ajax.reload();

          return swal.fire(
            "Tipo correcto",
            "El Tipo se registro con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Tipo ya existe",
            "El tipo '" + nombres + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al registrar el tipo", "error");
      }
    },
  });
  return false;
}

function ListarTipos() {
  TablaTipo = $("#TablaTipo").DataTable({
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
      url: BaseUrl + "admin/ListarTipos",
      type: "GET",
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      { data: "nombre" },
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
                <button class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></button>`;
          } else {
            return `<button class='activar btn btn-success btn-sm' title='Activar el usuario'><i class='fa fa-check'></i></button>-
                <button class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></button>`;
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
  TablaTipo.on("draw.dt", function () {
    var pageinfo = $("#TablaTipo").DataTable().page.info();
    TablaTipo.column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#TablaTipo").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaTipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaTipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaTipo.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo(id, dato);
    }
  });
});

$("#TablaTipo").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaTipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaTipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaTipo.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo(id, dato);
    }
  });
});

function cambiar_estado_tipo(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  $.ajax({
    url: BaseUrl + "admin/Estadotipo",
    type: "POST",
    data: { id: id, dato: dato },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        TablaTipo.ajax.reload();
        return swal.fire(
          "Estado del tipo",
          "EL estado se " + res + " con exito",
          "success"
        );
      }
    } else {
      return swal.fire(
        "Estado del tipo",
        "No se pudo cambiar el estado",
        "error"
      );
    }
  });
}

$("#TablaTipo").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = TablaTipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (TablaTipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = TablaTipo.row(this).data();
  }

  $("#id_tiposs").val(data.id);
  $("#nombre_tipo_edit").val(data.nombre);

  $("#nombre_tipo_edit_obligg").html("");

  $("#nuevo_tipo_edit").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#nuevo_tipo_edit").modal("show");
});

function EditarTipos() {
  let nombres = $("#nombre_tipo_edit").val();
  let id = $("#id_tiposs").val();

  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombre_tipo_edit_obligg").html("Ingrese el tipo");
    return swal.fire(
      "Campo vacio",
      "El campo no debe quedar vacio, complete el dato",
      "warning"
    );
  } else {
    $("#nombre_tipo_edit_obligg").html("");
  }

  $("#nuevo_tipo_edit").LoadingOverlay("show", {
    text: "Cargando...",
  });

  var formdata = new FormData();
  formdata.append("id", id.trim());
  formdata.append("nombres", nombres.trim());

  $.ajax({
    url: BaseUrl + "admin/EditaTiposs",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $("#nuevo_tipo_edit").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#nuevo_tipo_edit").modal("hide");

          TablaTipo.ajax.reload();

          return swal.fire(
            "Tipo correcto",
            "El Tipo se edito con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Tipo ya existe",
            "El tipo '" + nombres + "', ya esta registrado",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error al editar el tipo", "error");
      }
    },
  });
  return false;
}

///////////////registra ek proyecto
function Registra_Proyecto() {
  let nombre_proyecto = $("#nombre_proyecto").val();
  let precio_proyecto = $("#precio_proyecto").val();
  let descuento_proyecto = $("#descuento_proyecto").val();
  let tipo_descuento = $("#tipo_descuento").val();
  let idlenguaje = $("#idlenguaje").val();
  let idtecnologia = $("#idtecnologia").val();
  let id_tipo_proyecto = $("#id_tipo_proyecto").val();
  let fecha_creacion = $("#fecha_creacion").val();
  let detalle_proyecto = $("#detalle_proyecto").val();

  let archivo = document.getElementById("file").files.length;

  if (
    nombre_proyecto.length == 0 ||
    nombre_proyecto.trim() == "" ||
    precio_proyecto.length == 0 ||
    precio_proyecto.trim() == "" ||
    descuento_proyecto.length == 0 ||
    descuento_proyecto.trim() == "" ||
    idlenguaje.length == 0 ||
    idlenguaje.trim() == "" ||
    idtecnologia.length == 0 ||
    idtecnologia.trim() == "" ||
    id_tipo_proyecto.length == 0 ||
    id_tipo_proyecto.trim() == "" ||
    fecha_creacion.length == 0 ||
    fecha_creacion.trim() == "" ||
    detalle_proyecto.length == 0 ||
    detalle_proyecto.trim() == "" ||
    archivo == 0
  ) {
    validar_registros_proyecto(
      nombre_proyecto,
      precio_proyecto,
      descuento_proyecto,
      tipo_descuento,
      idlenguaje,
      idtecnologia,
      id_tipo_proyecto,
      fecha_creacion,
      detalle_proyecto,
      archivo
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombre_proyecto_obligg").html("");
    $("#precio_obligg").html("");
    $("#descuento_obligg").html("");
    $("#lenguaje_oblig").html("");
    $("#tecnologia_oblig").html("");
    $("#tipo_proyecto_obligg").html("");
    $("#fecha_obligg").html("");
    $("#detalle_obligg").html("");
    $("#foto_ogligg").html("");
  }

  var formdatos = new FormData();

  //este for es para obtener las imagenes del del input file[]
  for (let i = 0; i < archivo; i++) {
    var img = document.getElementById("file").files[i];
    formdatos.append("img_extra[" + i + "]", img);
  }

  formdatos.append("nombre_proyecto", nombre_proyecto.trim());
  formdatos.append("precio_proyecto", precio_proyecto.trim());
  formdatos.append("descuento_proyecto", descuento_proyecto.trim());
  formdatos.append("tipo_descuento", tipo_descuento.trim());
  formdatos.append("idlenguaje", idlenguaje.trim());
  formdatos.append("idtecnologia", idtecnologia.trim());
  formdatos.append("id_tipo_proyecto", id_tipo_proyecto.trim());
  formdatos.append("fecha_creacion", fecha_creacion.trim());
  formdatos.append("detalle_proyecto", detalle_proyecto.trim());

  $(".registra_proyecto_class").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "admin/RegistrarProyecto",
    type: "POST",
    data: formdatos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".registra_proyecto_class").LoadingOverlay("hide");
      if (resp > 0) {

        $("#preview-images").empty();
        swal.fire(
          "Proyecto correcto",
          "El proyecto se registro con exito",
          "success"
        );

        return document.getElementById("form_registrar_proyecto").reset();
      } else if (resp == "dos") {
        return swal.fire(
          "Nombre ya existe",
          "El nombre '" + nombre_proyecto + "', ya esta registrado",
          "warning"
        );
      } else {
        return swal.fire("Error", "Error al registrar el proyecto", "error");
      }
    },
  });
  return false;
}

function validar_registros_proyecto(
  nombre_proyecto,
  precio_proyecto,
  descuento_proyecto,
  tipo_descuento,
  idlenguaje,
  idtecnologia,
  id_tipo_proyecto,
  fecha_creacion,
  detalle_proyecto,
  archivo
) {
  if (nombre_proyecto.length == 0 || nombre_proyecto.trim() == "") {
    $("#nombre_proyecto_obligg").html(" - Ingrese nombre del proyecto");
  } else {
    $("#nombre_proyecto_obligg").html("");
  }

  if (precio_proyecto.length == 0 || precio_proyecto.trim() == "") {
    $("#precio_obligg").html(" - Ingrese el precio");
  } else {
    $("#precio_obligg").html("");
  }

  if (descuento_proyecto.length == 0 || descuento_proyecto.trim() == "") {
    $("#descuento_obligg").html(" - Ingrese el descuento");
  } else {
    $("#descuento_obligg").html("");
  }

  if (idlenguaje.length == 0 || idlenguaje == 0) {
    $("#lenguaje_oblig").html(" - Ingrese el lenguaje");
  } else {
    $("#lenguaje_oblig").html("");
  }

  if (idtecnologia.length == 0 || idtecnologia == 0) {
    $("#tecnologia_oblig").html(" - Ingrese la tecnologia");
  } else {
    $("#tecnologia_oblig").html("");
  }

  if (id_tipo_proyecto.length == 0 || id_tipo_proyecto == 0) {
    $("#tipo_proyecto_obligg").html(" - Ingrese el tipo de proyecto");
  } else {
    $("#tipo_proyecto_obligg").html("");
  }

  if (fecha_creacion.length == 0 || fecha_creacion == 0) {
    $("#fecha_obligg").html(" - Ingrese la fecha");
  } else {
    $("#fecha_obligg").html("");
  }

  if (detalle_proyecto.length == 0 || detalle_proyecto == 0) {
    $("#detalle_obligg").html(" - Ingrese el detalle");
  } else {
    $("#detalle_obligg").html("");
  }

  if (archivo == 0) {
    $("#foto_ogligg").html(" - Ingrese las imagenes");
  } else {
    $("#foto_ogligg").html("");
  }
}
