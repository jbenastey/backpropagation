
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Edit Pengguna</h1>
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

						<form id="demo-form2" method="post" action="<?= base_url('pengguna/edit/'.$pengguna['pengguna_id']) ?>" data-parsley-validate class="form-horizontal form-label-left">

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="username" id="first-name" value="<?= $pengguna['pengguna_username'] ?>" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="nama" id="first-name" value="<?= $pengguna['pengguna_nama'] ?>" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="password" name="password" id="first-name" value="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success" name="edit">Submit</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>

			<div class="clearfix"></div>

		</div>
	</div>
</div>
