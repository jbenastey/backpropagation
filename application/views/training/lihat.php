<div class="">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Lihat Perhitungan</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<p>Alpha = <?= $inisial['alpha'] ?></p>
					<p>Bagi Data = <?= $inisial['jumlah'] ?></p>
					<p>Variasi Hidden = <?= $inisial['variasi_hidden'] ?></p>
					<p>Max Epoch = <?= $inisial['max_epoch'] ?></p>
					<p>Koridor = <?= $inisial['koridor'] ?></p>
					<hr>
					<div class="row">
						<div class="col-md-9">
							<?php
							$input = json_decode($inisial['input'], true);
							$hidden = json_decode($inisial['hidden'], true);
							?>
							<p>Bobot dan bias dari lapisan input ke lapisan hidden
							</p>
							<table class="table table-bordered">
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
							<a href="<?= base_url('training/hitung-training/'.$inisial['id']) ?>" class="btn btn-primary">Hitung Training</a>
						<?php
						else:
							?>
							<div class="row">
								<div class="col-md-9">
									<?php
									$input = json_decode($training['input'], true);
									$hidden = json_decode($training['hidden'], true);
									?>
									<p>Bobot dan bias dari lapisan input ke lapisan hidden
									</p>
									<table class="table table-bordered">
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