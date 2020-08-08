
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
