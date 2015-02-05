<?php
	
	include_once('UI_admin.header.php');

	$accounts = array();
	$p = getPagination("SELECT a.id, a.email, x.name FROM account_admin x INNER JOIN account a ON a.id = x.account WHERE validated=0 ORDER BY id");
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $email, $name);
	while($stmt->fetch()) {
		$accounts[] = array('id' => $id, 'email' => $email, 'name' => $name);
	}
	$stmt->close();
?>

	<div class="panel panel-default">
		<ol class="breadcrumb" style="margin-bottom:0px">
			<li><img src="images/logo-small.png" /></li>
			<li><a href="admin.admins.list.php">Administrators</a></li>
			<li class="active">Waiting for validation</li>
		</ol>

		<div class="panel-body text-center">
			<a href="admin.admin.create.php" class="pull-right btn btn-default"><span class="glyphicon glyphicon-plus"></span> New account</a>
		</div>

		<table class="table table-striped table-bordered">
			<tr>
				<th class="col-sm-1">ID</th>
				<th class="col-sm-5">Name</th>
				<th class="col-sm-5">Email</th>
				<th class="col-sm-1"> </th>
			</tr>
			<?php 
				if(count($accounts) == 0) {
			?>
			<tr>
				<td colspan="4">Empty</td>
			</tr>
			<?php
				} else { 
					foreach($accounts as $line) { 
			?>
			<tr>
				<td><?php echo $line['id']; ?></td>
				<td><?php echo $line['name']; ?></td>
				<td><?php echo $line['email']; ?></td>
				<td class="text-center">
					<a href="mailto:<?php echo $line['email']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-envelope"></span></a>&#160;
					<a href="admin.account.validate.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-cloud-upload"></span></a>
					<a href="admin.account.delete.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
			<?php
					}
				}
			?>
		</table>

		<div class="panel-footer">
			<?php UX_Pagination($p); ?>
		</div>
	</div>

<?php include_once('UI_admin.footer.php'); ?>