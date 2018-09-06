<?php
	require 'backend/connect.php';
	require 'backend/data_in.php';
	require 'backend/data_out.php';
	$connect = ConnectDB('localhost', 'root', '', 'trainin');
	if( isset($_POST['name'])){
		if( !isset($_POST['id'])) { 
		// Con esto verifico si estoy creando un nuevo cliente o estoy modificando uno ya existente
			$array = array();
			$arrayKeys = array();
			foreach ($_POST as $key => $value) {
				//Guardo los indices y los valores en arreglos separados para poder enviarlos a las funciones
				if( $key != 'id'){
					array_push($array, $value);
					array_push($arrayKeys, $key);
				}
			}
			if( isNotSaved($arrayKeys, $array, 'clients', $connect)){
			//verifico si alguno de los datos ya proporcionados ya fue guardado por un cliente
				if(insert($arrayKeys, $array, 'clients', $connect)){
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
		} else {
			$array = array();
			$arrayKeys = array();
			foreach ($_POST as $key => $value) {
				if( $key != 'id'){
					array_push($array, $value);
					array_push($arrayKeys, $key);
				}
			}
			if(update($_GET['id'], $arrayKeys, $array, 'clients', $connect)){
				//actualizo el elemento con el id proporcionado
				?>
				<script type="text/javascript">
					alert('Registro bien actualizado');
					document.location = '/training';
				</script>
				<?php
			}
		}
	}
	if(isset($_GET['id'])){
		//El elemenot $rest recibe los datos que retorna la base de datos del elemento identificado con el id traido por _GET, esto a su vez me permite saber si voy a crear o a editar
		$result = get($_GET['id'], 'clients', $connect);
		$rest = $result->fetch_assoc();
		$title = 'Editar un cliente';
	} else {
		$title = 'Crear nuevo cliente';
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
			<h1><?php echo $title; ?></h1>
		</div>
		<hr>
		<form method="POST">
			<?php if( isset($_GET['id'])){ ?>
				<input type="hidden" name="id" value="<?php echo (isset($_GET['id']))? $rest['id']:'' ;?>">
			<?php } ?>
			<div class="group">
				<label><b>Name:</b></label>
				<input type="text" name="name" value="<?php echo (isset($_GET['id']))? $rest['name']:'' ;?>" required>
			</div>
			<br>
			<div class="group">
				<label><b>Last Name:</b></label>
				<input type="text" name="last_name" value="<?php echo (isset($_GET['id']))? $rest['last_name']:'' ;?>" required>
			</div>
			<br>
			<div class="group">
				<label><b>DNI:</b></label>
				<input type="number" name="DNI" value="<?php echo (isset($_GET['id']))? $rest['DNI']:'' ;?>" required>
			</div>
			<br>
			<div class="group">
				<label><b>Email:</b></label>
				<input type="text" name="email" value="<?php echo (isset($_GET['id']))? $rest['email']:'' ;?>" required>
			</div>
			<br>
			<div class="group">
				<label><b>Address:</b></label>
				<textarea name="address"><?php echo (isset($_GET['id']))? $rest['address']:'' ;?></textarea>
			</div>
			<br>
			<div class="group"><button type="submit">Enviar</button></div>
		</form>
	</body>
</html>