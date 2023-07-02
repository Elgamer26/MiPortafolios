<footer id="footer">
	<!-- top footer -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">SOBRE MÍ</h3>
						<p> <?php echo $perfil[7]; ?> </p>
						<p> <?php echo $perfil[8]; ?> </p>
						<ul class="footer-links">
							<li><a href="#"><i class="fa fa-map-marker"></i><?php echo $perfil[5]; ?> - <?php echo $perfil[6]; ?></a></li>
							<li><a href="#"><i class="fa fa-phone"></i><?php echo $perfil[4]; ?></a></li>
							<li><a href="#"><i class="fa fa-envelope-o"></i><?php echo $perfil[3]; ?></a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">Tecnologías</h3>
						<ul class="footer-links">

							<?php foreach ($tecnologia as $rowt) { ?>

								<li><a><?php echo $rowt["nombre"]; ?></a></li>

							<?php } ?>

						</ul>
					</div>
				</div>

				<div class="clearfix visible-xs"></div>

				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">Lenguajes</h3>
						<ul class="footer-links">

							<?php foreach ($lenguaje as $rowt) { ?>

								<li><a><?php echo $rowt["nombre"]; ?></a></li>

							<?php } ?>

						</ul>
					</div>
				</div>

				<div class="col-md-3 col-xs-6">
					<div class="footer">
						<h3 class="footer-title">Proyectos</h3>
						<ul class="footer-links">

							<?php foreach ($tipo_proyecto as $rowt) { ?>

								<li><a><?php echo $rowt["nombre"]; ?></a></li>

							<?php } ?>

						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /top footer -->

	<!-- bottom footer -->
	<div id="bottom-footer" class="section">
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12 text-center">

					<span class="copyright">
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> Todos los derechos reservados | Esta plantilla está hecha con <i class="fa fa-heart-o" aria-hidden="true"></i> por el Ing. Jorge Ramirez
					</span>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /bottom footer -->
</footer>

<script src="<?php echo base_url(); ?>public/tienda/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/tienda/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/tienda/js/slick.min.js"></script>
<script src="<?php echo base_url(); ?>public/tienda/js/nouislider.min.js"></script>
<script src="<?php echo base_url(); ?>public/tienda/js/jquery.zoom.min.js"></script>
<script src="<?php echo base_url(); ?>public/tienda/js/main.js"></script>

</body>

</html>

<script>
	var BaseUrl;
	BaseUrl = "<?php echo base_url(); ?>";

	$(document).ready(function() {
		PaginarTienda(1);
	});

	$("#buscarproducto").on("click", function(event) {
		event.preventDefault();
		// resto de tu codigo
	});

	//////////// PAGINADOR

	$(document).on("keyup", "#BuscarImput", function() {
		let valor = $(this).val();
		if (valor != "") {
			PaginarTienda(1, valor);
		} else {
			PaginarTienda(1);
		}
	});

	function PaginarTienda(partida, valor) {
		$.ajax({
			url: BaseUrl + "TiendaController/PaginarTienda",
			type: "POST",
			data: {
				partida: partida,
				valor: valor,
			},
		}).done(function(response) {
			var array = eval(response);
			if (array[0]) {
				$("#UnirProyectos").html(array[0]);
				// $("#unir_paguinador_oferta").html(array[1]);
			} else {
				$("#UnirProyectos").html(`<div class="col-12" style="text-align: center; justify-content: center; align-items: center"><br>
											<label style="font-size: 20px;"></i>.:No se encontro proyectos:.<label>
										</div>`);
				// $("#unir_paguinador_oferta").html("");
			}
		});
	}

	function VerDetalleProducto(id) {
		location.href = BaseUrl + "DetalleProducto/Producto/" + id;
	}
</script>