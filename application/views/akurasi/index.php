<div class="">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Data Akurasi</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>No</th>
							<th>Alpha</th>
							<th>Variasi Hidden</th>
							<th>Bagi Data</th>
							<th>Max Epoch</th>
							<th>Koridor</th>
							<th class="text-center"><i class="fa fa-gear"></i></th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach($akurasi as $key=>$value):
							?>
							<tr>
								<td><?= $key+1 ?></td>
								<td><?= $value['alpha'] ?></td>
								<td><?= $value['variasi_hidden'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td><?= $value['max_epoch'] ?></td>
								<td><?= $value['koridor'] ?></td>
								<td class="text-center"><a href="<?= base_url('akurasi/lihat/'.$value['id']) ?>" class="btn btn-sm btn-primary">Lihat</a></td>
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
