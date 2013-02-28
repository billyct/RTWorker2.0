<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $title?></title>
		<link rel="shortcut icon" href="<?php echo base_url('favicon.ico') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css') ?>">
	</head>
	<body>
		<div class="container" style="margin-top:20px;">
		    <table class="table table-bordered">
				<thead>
					<tr>
				    	<th>编号</th>
				    	<th>形状</th>
				    	<th>算式</th>
				    	<th>直径</th>
				    	<th>根数</th>
				    </tr>
				</thead>
				<tbody>
					<?php foreach ($typedatas as $typedata) { ?>
						<tr>
							<td></td>
							<td><?php echo $typedata['shapeid'] ?></td>
							<td><?php echo $typedata['formula'] ?></td>
							<td>
								<img src="<?php
										preg_match('/[a-zA-Z]+/', $typedata['type'], $matches);
										switch ($matches[0]) {
											case 'A':
												echo base_url('images/reforced/1ji.png');
												break;
											case 'B':
												echo base_url('images/reforced/2ji.png');
												break;
											case 'C':
												echo base_url('images/reforced/3ji.png');
												break;
											default:
												break;
										}
										?>" />
								<?php preg_match('/\d+/', $typedata['type'], $matches); echo $matches[0] ?>
							</td>
							<td><?php echo $typedata['sum'] ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>