<?php
	require 'backend/connect.php';
	require 'backend/data_in.php';
	require 'backend/data_out.php';
	$connect = ConnectDB('localhost', 'root', '', 'trainin');
	$id = '';
	$name = '';
	if( isset($_GET['id'])){
		$result = get($_GET['id'], 'clients', $connect);
		$res = $result->fetch_assoc();
		$id = $res['id'];
		$name = $res['name'];
	}
	if( isset($_POST['client_id']) ){
		$array = array();
		$arrayKeys = array();
		foreach ($_POST as $key => $value) {
			//Guardo los indices y los valores en arreglos separados para poder enviarlos a las funciones
			if( $key != 'id'){
				array_push($array, $value);
				array_push($arrayKeys, $key);
			}
		}
		if( isNotSaved($arrayKeys, $array, 'job_orders', $connect)){
		//verifico si alguno de los datos ya proporcionados ya fue guardado por un cliente
			if(insert($arrayKeys, $array, 'job_orders', $connect)){
			//verifico si la insersion se realizo con exito
				?>
				<script type="text/javascript">
					alert('Registro bien guardado');
					document.location = '/training';
				</script>
				<?php
			}else{
				//la pagina muere con el error
				die($connect->error);
			}
		}else{
			?>
			<script type="text/javascript">
				alert('Valores de campos ya proporcionados por otro usuario');
				document.location = '/training';
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Register form</title>
		<link rel="stylesheet" type="text/css" href="css/style-form.css">
	</head>
	<body>
		<div class="group">
			<h1>Crear una nueva job order</h1>
		</div>
		<hr>
		<form method="POST">
			<input type="hidden" name="client_id" value="<?php echo $id; ?>">
			<div class="group">
				<label><b>Name:</b></label>
				<input type="text" name="name" required>
			</div>
			<br>
			<div class="group">
				<label><b>User Name:</b></label>
				<input type="text" value="<?php echo $name; ?>" disabled>
			</div>
			<br>
			<div class="group">
				<label><b>Job Order Description:</b></label>
				<textarea name="description"></textarea>
			</div>
			<br>
			<div class="group"><button type="submit">Enviar</button></div>
		</form>
	</body>
</html>