
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Inisialisasi</h1>
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

					<form id="demo-form2" method="post" action="<?= base_url('training/proseshitung') ?>" data-parsley-validate class="form-horizontal form-label-left">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alpha <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="alpha" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pembagian <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="bagi" id="last-name" class="form-control" required="required">
									<option value="70">70</option>
									<option value="80">80</option>
									<option value="90">90</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Variasi Hidden</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="variasi" id="middle-name" class="form-control" required="required">
									<option value="3">3</option>
									<option value="5">5</option>
									<option value="8">8</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Max Epoch <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="max_epoch" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Koridor</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
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
								<button class="btn btn-primary" type="button">Cancel</button>
								<button class="btn btn-primary" type="reset">Reset</button>
								<button type="submit" class="btn btn-success">Submit</button>
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
