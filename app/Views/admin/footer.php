   <!-- Essential javascripts for application to work-->
   <script src="<?php echo base_url(); ?>public/admin/js/jquery-3.3.1.min.js"></script>
   <script src="<?php echo base_url(); ?>public/admin/js/popper.min.js"></script>
   <script src="<?php echo base_url(); ?>public/admin/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>public/admin/js/main.js"></script>
   <!-- The javascript plugin to display page loading on top-->
   <script src="<?php echo base_url(); ?>public/admin/js/plugins/pace.min.js"></script>
   <!-- Data table plugin-->
   <script type="text/javascript" src="<?php echo base_url(); ?>public/admin/js/plugins/jquery.dataTables.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>public/admin/js/plugins/dataTables.bootstrap.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <!-- archivos js creados para acciones del sistema -->
   <script>
      $(".select2").select2();

      /////////////////
      function soloLetras(e) {
         key = e.keyCode || e.which;
         tecla = String.fromCharCode(key).toLowerCase();
         letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
         especiales = "8-37-39-46";
         tecla_especial = false;
         for (var i in especiales) {
            if (key == especiales[i]) {
               tecla_especial = true;
               break;
            }
         }
         if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return swal.fire(
               "No se permiten numeros!!",
               "Solo se permiten letras",
               "warning"
            );
         }
      }

      function soloNumeros(e) {
         var key = window.event ? e.which : e.keyCode;
         if (key < 48 || key > 57) {
            return swal.fire(
               "No se permiten letras!!",
               "Solo se permiten numeros",
               "warning"
            );
         }
      }

      function filterfloat(evt, input) {
         var key = window.Event ? evt.which : evt.keyCode;
         var chark = String.fromCharCode(key);
         var tempvalue = input.value + chark;
         if (key >= 48 && key <= 57) {
            if (filter(tempvalue) === false) {
               return false;
            } else {
               return true;
            }
         } else {
            if (key == 8 || key == 13 || key == 0) {
               return false;
            } else if (key === 46) {
               if (filter(tempvalue) === false) {
                  return false;
               } else {
                  return true;
               }
            } else {
               return swal.fire(
                  "No se permiten letras!!",
                  "Solo se permiten numeros decimales, (00.00)",
                  "warning"
               );
            }
         }
      }

      function filter(__val__) {
         var preg = /^([0-9]+\.?[0-9]{0,2})$/;
         if (preg.test(__val__) === true) {
            return true;
         } else {
            return false;
         }
      }
   </script>

   <script src="<?php echo base_url(); ?>public/js/usuario.js"></script>
   <script src="<?php echo base_url(); ?>public/js/tecnologi.js"></script>
   <script src="<?php echo base_url(); ?>public/js/perfil.js"></script>
   <script src="<?php echo base_url(); ?>public/js/producto.js"></script>
   <script src="<?php echo base_url(); ?>public/js/proyecto.js"></script>

   <!-- Page specific javascripts-->


   </body>

   </html>