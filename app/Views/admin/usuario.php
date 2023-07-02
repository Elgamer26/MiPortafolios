 <main class="app-content">
   <div class="app-title">
     <div>
       <h1><i class="fa fa-th-list"></i> Lista de usuario -
         <button class="btn btn-success" onclick="modal_nuevo_usuario();"><i class="fa fa-plus"></i> Nuevo usuario</button> -
         <a class="btn btn-warning"><i class="fa fa-home"></i> Logs de ingreso</a>
       </h1>
       <!-- <p>Table to display analytical data effectively</p> -->
     </div>
     <ul class="app-breadcrumb breadcrumb side">
       <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
       <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
       <li class="breadcrumb-item">Listado</li>
     </ul>
   </div>
   <div class="row">
     <div class="col-md-12">
       <div class="tile">
         <div class="tile-body">
           <div class="table-responsive">
             <table class="table table-hover table-bordered" id="TableUsuario">
               <thead bg-color="red">
                 <tr>
                   <th>#</th>
                   <th>Nombres</th>
                   <th>Correo</th>
                   <th>Foto</th>
                   <th>Usuario</th>
                   <th>Fecha hora</th>
                   <th>Opciones</th>
                 </tr>
               </thead>
               <tbody>

               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
 </main>

 <div class="modal fade" id="nuevo_usuario" tabindex="-1" role="dialog" aria-labelledby="nuevo_usuarioLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header" style="background: #009688;">
         <h5 class="modal-title" id="nuevo_usuarioLabel" style="color: white;">Nuevo usuario</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">

         <div class="row">
           <div class="col-lg-12">
             <div class="form-group">
               <label for="nombres">Nombres</label> <b><label style="color: red;" id="nombres_obligg"></label></b>
               <input class="form-control" onkeypress="return soloLetras(event)" maxlength="100" id="nombres" autocomplete="off" type="text" placeholder="Ingrese nombres">
             </div>
           </div>

           <div class="col-lg-6">
             <div class="form-group">
               <label for="usuario">Usuario</label> <b><label style="color: red;" id="usuario_obligg"></label></b>
               <input class="form-control" maxlength="50" id="usuario" type="text" autocomplete="off" placeholder="Ingrese usuario">
             </div>
           </div>

           <div class="col-lg-6">
             <div class="form-group">
               <label for="correo">Correo</label> <b><label style="color: red;" id="correo_obligg"></label></b>
               <input class="form-control" id="correo" maxlength="60" type="text" autocomplete="off" placeholder="Ingrese correo">
             </div>
           </div>

           <div class="col-lg-6">
             <div class="form-group">
               <label for="password">Password</label> <b><label style="color: red;" id="password_obligg"></label></b>
               <input class="form-control" id="password" maxlength="50" type="password" autocomplete="off" placeholder="Ingrese password">
             </div>
           </div>

           <div class="col-lg-5">
             <div class="form-group">
               <label for="repetir_password">Repetir Password</label> <b><label style="color: red;" id="password_c_obligg"></label></b>
               <input class="form-control" id="repetir_password" maxlength="50" type="password" autocomplete="off" placeholder="Repetir password">
             </div>
           </div>

           <div class="col-lg-1">
             <div class="form-group text-center">
               <label for="repetir_password">Ver</label>
               <button class="btn btn-warning" onclick="mostrar_usu();"> <b><i class="fa fa-eye"></i></b> </button>
             </div>
           </div>

           <div class="col-lg-12">
             <div class="form-group text-center">
               <label>Foto del usuario</label>
               <img id="img_usuario" height="187" width="200" class="border rounded mx-auto d-block img-fluid" src="<?php echo base_url(); ?>public/img/admin.jpg" />
               <input type="file" class="form-control" id="foto" onchange="mostrar_imagen(this)" />
             </div>
           </div>

         </div>
       </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
         <button type="button" class="btn btn-primary" onclick="RegistrarUsuario();">Registrar usuario</button>
       </div>
     </div>
   </div>
 </div>

 <div class="modal fade" id="nuevo_usuarioEdit" tabindex="-1" role="dialog" aria-labelledby="nuevo_usuarioEditLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header" style="background: #009688;">
         <h5 class="modal-title" id="nuevo_usuarioEditLabel" style="color: white;">Editar usuario</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">

         <div class="row">

           <input type="number" hidden id="id_usaer">

           <div class="col-lg-12">
             <div class="form-group">
               <label for="nombresedit">Nombres</label> <b><label style="color: red;" id="nombres_obliggedit"></label></b>
               <input class="form-control" onkeypress="return soloLetras(event)" maxlength="100" id="nombresedit" autocomplete="off" type="text" placeholder="Ingrese nombres">
             </div>
           </div>

           <div class="col-lg-6">
             <div class="form-group">
               <label for="usuairoedit">Usuario</label> <b><label style="color: red;" id="usuario_obliggedit"></label></b>
               <input class="form-control" maxlength="50" id="usuairoedit" type="text" autocomplete="off" placeholder="Ingrese usuario">
             </div>
           </div>

           <div class="col-lg-6">
             <div class="form-group">
               <label for="correoedit">Correo</label> <b><label style="color: red;" id="correo_obliggedit"></label></b>
               <input class="form-control" id="correoedit" maxlength="60" type="text" autocomplete="off" placeholder="Ingrese correo">
             </div>
           </div>

         </div>
       </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
         <button type="button" class="btn btn-primary" onclick="EditarUsuario();">Editar usuario</button>
       </div>
     </div>
   </div>
 </div>

 <div class="modal fade" id="modal_editar_photo" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
   <div class="modal-dialog xl" role="document">
     <div class="modal-content">
       <div class="modal-header" style="background: #009688;">
         <h5 class="modal-title" id="modal_eitar_rolLabel" style="color: white;">Editar foto</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="container">
           <div class="row">
             <input type="number" id="id_foto" hidden>
             <div class="col-md-12 mb-3 form-group">
               <div class="ibox-body text-center">

                 <img class="img-circle" id="foto_usuar" style="border-radius: 50%;" white="250px" height="250px">
                 <h5 class="font-strong m-b-10 m-t-10"><span>Foto de usuario</span></h5>
                 <div>
                   <input type="file" id="foto_new" class="form-control" onchange="mostrar_imagen_edit(this)">
                   <input type="text" id="foto_actu" hidden>
                   <button class="btn btn-info btn-rounded mb-3" onclick="editar_foto_usuario();"><i class="fa fa-plus"></i> Cambiar foto</button>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>

 <script>
   var correo_usus = false;
   var correo_edit = true;

   var BaseUrl;
   BaseUrl = "<?php echo base_url(); ?>";

   function modal_nuevo_usuario() {

     $("#nombres").val("");
     $("#usuario").val("");
     $("#correo").val("");
     $("#password").val("");
     $("#repetir_password").val("");

     $("#nombres_obligg").html("");
     $("#usuario_obligg").html("");
     $("#correo_obligg").html("");
     $("#password_obligg").html("");
     $("#password_c_obligg").html("");

     $("#correo").css("border", "1px solid grey");

     $("#nuevo_usuario").modal({
       backdrop: "static",
       keyboard: false
     });
     $("#nuevo_usuario").modal("show");

   }

   function mostrar_usu() {
     var ver = document.getElementById("password");
     var con = document.getElementById("repetir_password");

     if (ver.type == "password") {
       ver.type = "text";
       con.type = "text";
     } else {
       ver.type = "password";
       con.type = "password";
     }
   }

   function mostrar_imagen(input) {
     var filename = document.getElementById("foto").value;
     var idxdot = filename.lastIndexOf(".") + 1;
     var extfile = filename.substr(idxdot, filename.length).toLowerCase();
     if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

       if (input.files) {
         var reader = new FileReader();
         reader.onload = function(e) {
           $("#img_usuario").attr("src", e.target.result).height(187).width(200);
         }
         reader.readAsDataURL(input.files[0]);
       }

     } else {
       swal.fire(
         "Mensaje de alerta",
         "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
         "warning"
       );
       $("#img_usuario").attr("src", "<?php echo base_url(); ?>public/img/admin.jpg").height(187).width(200);
       return document.getElementById("foto").value = "";
     }

   }

   function mostrar_imagen_edit(input) {
     var filename = document.getElementById("foto_new").value;
     var idxdot = filename.lastIndexOf(".") + 1;
     var extfile = filename.substr(idxdot, filename.length).toLowerCase();
     if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

       if (input.files) {
         var reader = new FileReader();
         reader.onload = function(e) {
           $("#foto_usuar").attr("src", e.target.result).height(250).width(250);
         }
         reader.readAsDataURL(input.files[0]);
       }

     } else {
       swal.fire(
         "Mensaje de alerta",
         "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
         "warning"
       );
       return document.getElementById("foto_new").value = "";
     }

   }
 </script>