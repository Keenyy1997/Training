<?php
	require 'backend/connect.php';
	require 'backend/data_in.php';
	require 'backend/data_out.php';
	$connect = ConnectDB('localhost', 'root', '', 'trainin');
	if( isset($_GET['id']) ){
		delete($_GET['id'], 'clients', $connect);
		?>
		<script type="text/javascript">
			alert('elemento exitosamente eliminado');
			document.location = '/training';
		</script>
		<?php
	}
	$results = showAll('clients', $connect);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta lang="es">
		<title>Training</title>
		<link rel="stylesheet" type="text/css" href="css/home-fonts.css">
	</head>
	<body>
		<button class="new" title="Crear un nuevo cliente" onclick="document.location='/training/form.php'">Crear nuevo Cliente</button>
		<hr>
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>DNI</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php while( $row = $results->fetch_assoc() ) {?>
				<tr>
					<td><?php echo $row['name'];?></td>	
					<td><?php echo $row['DNI'];?></td>	
					<td><?php echo $row['address'];?></td>
					<td>
						<button class="edit" title="Editar este registro" onclick="document.location='/training/form.php?id=<?php echo $row["id"]; ?>'">Editar</button>
						<button class="delete" title="Eliminar este registro" onclick="document.location='/training/?id=<?php echo $row["id"]; ?>'">Eliminar</button>
						<button class="new" title="Agregar nueva job order" onclick="document.location='/training/job_orders_add.php?id=<?php echo $row['id']; ?>'">Nueva Job order</button>
					</td>	
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>
</html>