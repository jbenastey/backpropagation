
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data Prediksi</h1>
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
						<table class="table table-bordered">
							<thead>
							<tr>
								<th>No</th>
								<th>Alpha</th>
								<th>Max Epoch</th>
								<th>Koridor</th>
								<th>Akurasi (MSE)</th>
								<th>Prediksi</th>
								<th class="text-center"><i class="fa fa-gear"></i></th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($prediksi as $key=>$value):
								?>
								<tr>
									<td><?= $key+1 ?></td>
									<td><?= $value['alpha'] ?></td>
									<td><?= $value['max_epoch'] ?></td>
									<td><?= $value['koridor'] ?></td>
									<td>
										<?php
										if($value['mses'] == null):
											?>
											<span class="badge badge-danger">Belum dihitung</span>
										<?php
										else:
											echo $value['mses'];
										endif
										?>
									</td>
									<td><?= round($value['denormalisasi_hasil']) ?></td>
									<td class="text-center"><a href="<?= base_url('prediksi/lihat/'.$value['id_inisial']) ?>" class="btn btn-sm btn-primary">Lihat</a></td>
								</tr>
							<?php
							endforeach;
							?>
							</tbody>
						</table>

					</div>
				</div>
			</div>

			<div class="clearfix"></div>

		</div>
	</div>
</div>
