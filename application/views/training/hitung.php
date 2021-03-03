
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
						<input type="hidden" name="bagi" value="100">
						<input type="hidden" name="variasi" value="5">
<!--						<div class="form-group">-->
<!--							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pembagian <span class="required">*</span>-->
<!--							</label>-->
<!--							<div class="col-md-6 col-sm-6 col-xs-12">-->
<!--								<select name="bagi" id="last-name" class="form-control" required="required">-->
<!--									<option value="70">70</option>-->
<!--									<option value="80">80</option>-->
<!--									<option value="90">90</option>-->
<!--								</select>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="form-group">-->
<!--							<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Variasi Hidden</label>-->
<!--							<div class="col-md-6 col-sm-6 col-xs-12">-->
<!--								<select name="variasi" id="middle-name" class="form-control" required="required">-->
<!--									<option value="5">5</option>-->
<!--									<option value="8">8</option>-->
<!--									<option value="12">12</option>-->
<!--								</select>-->
<!--							</div>-->
<!--						</div>-->
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
									<option value="senin">senin</option>
									<option value="selasa">selasa</option>
									<option value="rabu">rabu</option>
									<option value="kamis">kamis</option>
									<option value="jumat">jumat</option>
									<option value="sabtu">sabtu</option>
									<option value="minggu">minggu</option>
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
