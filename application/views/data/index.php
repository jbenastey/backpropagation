
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
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						Import
					</button>
					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal1">
						Normalisasi
					</button>
					<button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#exampleModal2">
						Hapus
					</button>
					<hr>
					<table class="table table-bordered" id="example1">
						<thead>
						<tr>
							<th>No</th>
							<th>x1</th>
							<th>x2</th>
							<th>x3</th>
							<th>x4</th>
							<th>x5</th>
							<th>Target</th>
							<th>x1n</th>
							<th>x2n</th>
							<th>x3n</th>
							<th>x4n</th>
							<th>x5n</th>
							<th>TargetN</th>
							<th>Koridor</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach($koridor as $key=>$value):
						?>
							<tr>
								<td><?= ($key+1) ?></td>
								<td><?= $value['x1'] ?></td>
								<td><?= $value['x2'] ?></td>
								<td><?= $value['x3'] ?></td>
								<td><?= $value['x4'] ?></td>
								<td><?= $value['x5'] ?></td>
								<td><?= $value['target'] ?></td>
								<td><?= $value['x1n'] ?></td>
								<td><?= $value['x2n'] ?></td>
								<td><?= $value['x3n'] ?></td>
								<td><?= $value['x4n'] ?></td>
								<td><?= $value['x5n'] ?></td>
								<td><?= $value['targetn'] ?></td>
								<td><?= $value['koridor'] ?></td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="demo-form2" method="post" action="<?= base_url('import') ?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<a href="<?= base_url('assets/excel/format/format.xlsx') ?>" class="btn btn-primary">Format</a><br>

							<input type="file" name="excel" id="first-name" required="required" class="form-control col-md-12 col-xs-12">
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success" name="upload">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Normalisasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="demo-form2" method="post" action="<?= base_url('normalisasi') ?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<label for="middle-name">Pilih Koridor</label>
							<select name="koridor" id="middle-name" class="form-control" required="required">
								<option value="1">1</option>
								<option value="1A">1A</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4A">4A</option>
								<option value="4B">4B</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7A">7A</option>
								<option value="7B">7B</option>
								<option value="8A">8A</option>
								<option value="8B">8B</option>
							</select>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success" name="gas">Proses</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="demo-form2" method="post" action="<?= base_url('hapus-data') ?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<label for="middle-name">Pilih Koridor</label>
							<select name="koridor" id="middle-name" class="form-control" required="required">
								<?php
								foreach($hapus as $key=>$value):
								?>
									<option value="<?= $value['koridor'] ?>"><?= $value['koridor'] ?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success" name="gas">Proses</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
