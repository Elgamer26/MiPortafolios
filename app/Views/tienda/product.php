		<div class="section">
			<div class="container">
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">

							<?php foreach ($imagen as $rowI) { ?>

								<div class="product-preview">
									<img style="object-fit: cover; height: 500px;" src="<?php echo base_url(); ?>public/img/proyectos/<?php echo $rowI["foto"]; ?>" alt="Imagen producto">
								</div>

							<?php } ?>

						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">

							<?php foreach ($imagen as $rowI) { ?>

								<div class="product-preview">
									<img style="object-fit: cover; height: 165px;" src="<?php echo base_url(); ?>public/img/proyectos/<?php echo $rowI["foto"]; ?>" alt="Imagen producto">
								</div>

							<?php } ?>

						</div>
					</div>

					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $proyecto[0]; ?></h2>
							<div>
								<h3 class="product-price">$<?php echo $proyecto[1]; ?> 
								<!-- <del class="product-old-price">$990.00</del> -->
							</h3>
							</div>
							<p><b>Tecnología:</b> <?php echo $proyecto[3]; ?></p>
							<p><b>Lenguaje:</b> <?php echo $proyecto[2]; ?></p>
							<p><b>Tipo proyecto:</b> <?php echo $proyecto[4]; ?></p>
							<p><b>Detalle:</b> <?php echo $proyecto[6]; ?></p>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> AÑADIR A LA CESTA</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>