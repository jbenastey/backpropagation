
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Lihat Perhitungan Training</h1>
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
					<a href="<?= base_url('training/hapus/'.$inisial['id_in']) ?>" class="btn btn-outline-danger float-right" onclick="return confirm('Hapus Training ?')" title="Hapus Training"><i class="fa fa-trash"></i></a>

					<p>Alpha = <?= $inisial['alpha'] ?></p>
					<p>Max Epoch = <?= $inisial['max_epoch'] ?></p>
					<p>Koridor = <?= $inisial['koridor'] ?></p>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<?php
							$input = json_decode($inisial['input'], true);
							$hidden = json_decode($inisial['hidden'], true);
							?>
							<p>Bobot dan bias dari lapisan input ke lapisan hidden
							</p>
							<table class="table table-bordered example2" style="width: 100%">
								<thead>
								<tr>
									<th>vij</th>
									<th colspan="<?= count($input) ?>" class="text-center">j</th>
								</tr>
								<tr>
									<th>i</th>
									<?php
									foreach ($input as $key => $value):
										?>
										<th><?= $key ?></th>
									<?php
									endforeach;
									?>
								</tr>
								</thead>
								<tbody>
								<?php
								for ($i = 0; $i <= 5; $i++):
									?>
									<tr>
										<td><?= $i ?></td>
										<?php
										foreach ($input as $key => $value):
											?>
											<td><?= $value[$i] ?></td>
										<?php
										endforeach;
										?>
									</tr>
								<?php
								endfor;
								?>
								</tbody>
							</table>
							<hr>
						</div>
						<div class="col-md-3">
							<p>Bobot dan bias dari lapisan hidden ke lapisan output
							</p>
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>wjk</th>
									<th>k</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>j</td>
									<td>1</td>
								</tr>
								<?php
								foreach($hidden as $key=>$value):
								?>
								<tr>
									<td><?= $key ?></td>
									<td><?= $value ?></td>
								</tr>
								<?php
								endforeach;
								?>
								</tbody>
							</table>
						</div>
					</div>
					<hr>

					<div class="">
						<?php
						if($training == null):
						?>
							<a href="<?= base_url('training/hitung-training/'.$inisial['id_in']) ?>" class="btn btn-primary">Hitung Training</a>
						<?php
						else:
							?>
							<div class="row">
								<div class="col-md-12">
									<?php
									$input = json_decode($training['input'], true);
									$hidden = json_decode($training['hidden'], true);
									?>
									<p>Bobot dan bias dari lapisan input ke lapisan hidden
									</p>
									<table class="table table-bordered example2">
										<thead>
										<tr>
											<th>vij (baru)</th>
											<th colspan="<?= count($input) ?>" class="text-center">j</th>
										</tr>
										<tr>
											<th>i</th>
											<?php
											foreach ($input as $key => $value):
												?>
												<th><?= $key ?></th>
											<?php
											endforeach;
											?>
										</tr>
										</thead>
										<tbody>
										<?php
										for ($i = 0; $i <= 5; $i++):
											?>
											<tr>
												<td><?= $i ?></td>
												<?php
												foreach ($input as $key => $value):
													?>
													<td><?= $value[$i] ?></td>
												<?php
												endforeach;
												?>
											</tr>
										<?php
										endfor;
										?>
										</tbody>
									</table>
									<hr>
								</div>
								<div class="col-md-3">
									<p>Bobot dan bias dari lapisan hidden ke lapisan output
									</p>
									<table class="table table-bordered">
										<thead>
										<tr>
											<th>wjk (baru)</th>
											<th>k</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>j</td>
											<td>1</td>
										</tr>
										<?php
										foreach($hidden as $key=>$value):
											?>
											<tr>
												<td><?= $key ?></td>
												<td><?= $value ?></td>
											</tr>
										<?php
										endforeach;
										?>
										</tbody>
									</table>
								</div>
							</div>
						<p><b>MSE = <?= $training['mse'] ?></b></p>
							<hr>

							<div class="">
								<?php
								if ($akurasi == null):
									?>
									<a href="<?= base_url('akurasi/hitung-akurasi/' . $bobot['id_inisial']) ?>" class="btn btn-primary">Hitung
										Akurasi</a>
								<?php
								else:
									?>
									<div class="row">
										<div class="col-12">
											<input type="hidden" value="<?= $akurasi['id_bobot'] ?>" id="id">
											<div class="chart">
												<canvas id="akurasi-chart" width="1000" height="280"></canvas>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<table class="table table-bordered">
												<thead>
												<tr>
													<th>Data</th>
													<th>Hasil Prediksi</th>
													<th>Target</th>
													<th>Denormalisasi Hasil Prediksi</th>
													<th>Nilai Target Asli</th>
												</tr>
												</thead>
												<tbody>
												<?php
												$hasil = json_decode($akurasi['hasil_prediksi'], true);
												$target = json_decode($akurasi['target'], true);
												$denormalisasi = json_decode($akurasi['denormalisasi'], true);
												$targeta = json_decode($akurasi['targeta'], true);
												for ($i = 0; $i < count($hasil); $i++):
													?>
													<tr>
														<td><?= $i + 1 ?></td>
														<td><?= $hasil[$i] ?></td>
														<td><?= $target[$i] ?></td>
														<td><?= round($denormalisasi[$i]) ?></td>
														<td><?= $targeta[$i] ?></td>
													</tr>
												<?php
												endfor;
												?>
												<tr>
													<td colspan="4" class="text-center"><b>MSE</b></td>
													<td><b><?= $akurasi['mses'] ?></b></td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								<?php
								endif
								?>
							</div>
						<?php
						endif
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

	</div>
</div>
</div>
