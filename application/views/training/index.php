
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data Training</h1>
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
					<a href="<?= base_url('training/hitung') ?>" class="btn btn-primary">Hitung</a>
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
						foreach($inisial as $key=>$value):
						?>
							<tr>
								<td><?= $key+1 ?></td>
								<td><?= $value['alpha'] ?></td>
								<td><?= $value['variasi_hidden'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td><?= $value['max_epoch'] ?></td>
								<td><?= $value['koridor'] ?></td>
								<td class="text-center"><a href="<?= base_url('training/lihat/'.$value['id']) ?>" class="btn btn-sm btn-primary">Lihat</a></td>
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
