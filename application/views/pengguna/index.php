
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data Koridor</h1>
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
						<hr>
						<table class="table table-bordered" id="example3" style="width: 100%">
							<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Nama</th>
								<th><i class="fa fa-gears"></i></th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($pengguna as $key=>$value):
								?>
								<tr>
									<td><?= ($key+1) ?></td>
									<td><?= $value['pengguna_username'] ?></td>
									<td><?= $value['pengguna_nama'] ?></td>
									<td>
										<a href="<?= base_url('pengguna/edit/'.$value['pengguna_id']) ?>" class="btn btn-success btn-sm">Edit</a>
										<a href="<?= base_url('pengguna/delete/'.$value['pengguna_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data?')">Hapus</a>
									</td>
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
