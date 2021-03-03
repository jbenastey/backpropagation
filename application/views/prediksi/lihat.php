<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Lihat Prediksi</h1>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-body">
						<p>Alpha = <?= $bobot['alpha'] ?></p>
<!--						<p>Bagi Data = --><?//= $bobot['jumlah'] ?><!--</p>-->
<!--						<p>Variasi Hidden = --><?//= $bobot['variasi_hidden'] ?><!--</p>-->
						<p>Max Epoch = <?= $bobot['max_epoch'] ?></p>
						<p>Koridor = <?= $bobot['koridor'] ?></p>
						<p><b>Hasil Prediksi = <?= $prediksi['hasil'] ?></b></p>
						<p><b>Denormalisasi Hasil Prediksi = <?= round($prediksi['denormalisasi_hasil']) ?></b></p>
						<hr>

						<div class="">
							<div class="row">
								<div class="col-12">
									<input type="hidden" value="<?= $akurasi['id_bobot'] ?>" id="id">
									<div class="chart">
										<canvas id="akurasi-chart" width="1000" height="280"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="clearfix"></div>

		</div>
	</div>


</div>
