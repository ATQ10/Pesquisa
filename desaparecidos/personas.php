<?php
	/*
		Web Service RESTful en PHP con MySQL (CRUD)
	*/
	include 'conexion.php';
	$pdo = new Conexion();
	//Listar registros y consultar registro
	if($_SERVER['REQUEST_METHOD'] == 'GET'){

		// DELETE
		//Eliminar registro
		if(isset($_GET['metodo'])== 'DELETE')
		{
			$sql = "DELETE FROM rnpedff WHERE id=:id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $_GET['id']);
			$count=$stmt->execute();
			if($count)
			{
				header("HTTP/1.1 200 Ok");
				echo json_encode($count);
			}else{
				header("HTTP/1.1 400 Fail");
			}
			exit;
		}

		//Consultas GET con filtros
		if(!isset($_GET['estados']) && (isset($_GET['nombre']) || isset($_GET['entidad']) || isset($_GET['municipio'])))
		{
			if(isset($_GET['nombre']) && isset($_GET['entidad']) && isset($_GET['municipio'])){
				$sql = $pdo->prepare("SELECT * FROM rnpedff WHERE CONCAT(' ' , nombre , ' ' , ape_pat,  ' ', ape_mat, ' ' ) LIKE '%".$_GET['nombre']."%' AND ultimaEntidad=:entidad AND ultimoMunicipio=:municipio");
				$sql->bindValue(':entidad', $_GET['entidad']);
				$sql->bindValue(':municipio', $_GET['municipio']);
			}
			else if(isset($_GET['entidad']) && isset($_GET['municipio'])){
				$sql = $pdo->prepare("SELECT * FROM rnpedff WHERE ultimaEntidad=:entidad AND ultimoMunicipio=:municipio");
				$sql->bindValue(':entidad', $_GET['entidad']);
				$sql->bindValue(':municipio', $_GET['municipio']);
			}
			else if(isset($_GET['nombre']) && isset($_GET['entidad'])){
				$sql = $pdo->prepare("SELECT * FROM rnpedff WHERE CONCAT(' ' , nombre , ' ' , ape_pat,  ' ', ape_mat, ' ' ) LIKE '%".$_GET['nombre']."%' AND ultimaEntidad=:entidad");
				$sql->bindValue(':entidad', $_GET['entidad']);
			}
			else if(isset($_GET['entidad'])){
				$sql = $pdo->prepare("SELECT * FROM rnpedff WHERE ultimaEntidad=:entidad");
				$sql->bindValue(':entidad', $_GET['entidad']);
			}
			else if(isset($_GET['nombre'])){
				$sql = $pdo->prepare("SELECT * FROM rnpedff WHERE CONCAT(' ' , nombre , ' ' , ape_pat,  ' ', ape_mat, ' ' ) LIKE '%".$_GET['nombre']."%'");
			}
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 Ok");
			echo json_encode($sql->fetchAll());
			exit;				
		}

		//Consultas GET para estados con filtros para municipios
		if(isset($_GET['estados']))
		{
			$sql = $pdo->prepare("SELECT DISTINCT ultimaEntidad FROM rnpedff ORDER BY ultimaEntidad");
			if(isset($_GET['entidad'])){
				$sql = $pdo->prepare("SELECT DISTINCT ultimoMunicipio FROM rnpedff WHERE ultimaEntidad=:entidad ORDER BY ultimoMunicipio");
				$sql->bindValue(':entidad', $_GET['entidad']);
			}
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 Ok");
			echo json_encode($sql->fetchAll());
			exit;				
		}



		//Consultas GET por id
		if(isset($_GET['id']))
		{
			$sql = $pdo->prepare("SELECT * FROM rnpedff WHERE id=:id");
			$sql->bindValue(':id', $_GET['id']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 Ok");
			echo json_encode($sql->fetchAll());
			exit;				
		}

		if(isset($_GET['all']))
		{
			$sql = $pdo->prepare("SELECT * FROM rnpedff");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 Ok");
			echo json_encode($sql->fetchAll());
			exit;				
		}

	}
	
	//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//Actualizar registro
		if(isset($_GET['metodo']) == 'UPDATE')
		{		
			$sql = "UPDATE rnpedff SET ultimaFecha=:ultimaFecha, nombre=:nombre, ape_pat=:ape_pat, ape_mat=:ape_mat, ultimoPais=:ultimoPais, ultimaEntidad=:ultimaEntidad, claveEntidad=:claveEntidad, ultimoMunicipio=:ultimoMunicipio, origen=:origen, nacionalidad=:nacionalidad, sexo=:sexo, edad=:edad, ultimoLugar=:ultimoLugar, autoridadDenuncia=:autoridadDenuncia, denunciaFecha=:denunciaFecha, entidadDenuncia=:entidadDenuncia WHERE id=:id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $_POST['id']);
			$stmt->bindValue(':ultimaFecha', $_POST['ultimaFecha']);
			$stmt->bindValue(':nombre', $_POST['nombre']);
			$stmt->bindValue(':ape_pat', $_POST['ape_pat']);
			$stmt->bindValue(':ape_mat', $_POST['ape_mat']);
			$stmt->bindValue(':ultimoPais', $_POST['ultimoPais']);
			$stmt->bindValue(':ultimaEntidad', $_POST['ultimaEntidad']);
			$stmt->bindValue(':claveEntidad', $_POST['claveEntidad']);
			$stmt->bindValue(':ultimoMunicipio', $_POST['ultimoMunicipio']);
			$stmt->bindValue(':origen', $_POST['origen']);
			$stmt->bindValue(':nacionalidad', $_POST['nacionalidad']);
			$stmt->bindValue(':sexo', $_POST['sexo']);
			$stmt->bindValue(':edad', $_POST['edad']);
			$stmt->bindValue(':ultimoLugar', $_POST['ultimoLugar']);
			$stmt->bindValue(':autoridadDenuncia', $_POST['autoridadDenuncia']);
			$stmt->bindValue(':denunciaFecha', $_POST['denunciaFecha']);
			$stmt->bindValue(':entidadDenuncia', $_POST['entidadDenuncia']);
			$status=$stmt->execute();
			if($status){
				header("HTTP/1.1 200 Ok");
				echo json_encode($status);
			}else{
				header("HTTP/1.1 400 Fail");
			}
			exit;
		}

		//Insertar POST
		$sql = "INSERT INTO rnpedff (ultimaFecha, nombre, ape_pat, ape_mat, ultimoPais, ultimaEntidad, claveEntidad, ultimoMunicipio, origen, nacionalidad, sexo, edad, ultimoLugar, autoridadDenuncia, denunciaFecha, entidadDenuncia) VALUES(:ultimaFecha, :nombre, :ape_pat, :ape_mat, :ultimoPais, :ultimaEntidad, :claveEntidad, :ultimoMunicipio, :origen, :nacionalidad, :sexo, :edad, :ultimoLugar, :autoridadDenuncia, :denunciaFecha, :entidadDenuncia)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':ultimaFecha', $_POST['ultimaFecha']);
		$stmt->bindValue(':nombre', $_POST['nombre']);
		$stmt->bindValue(':ape_pat', $_POST['ape_pat']);
		$stmt->bindValue(':ape_mat', $_POST['ape_mat']);
		$stmt->bindValue(':ultimoPais', $_POST['ultimoPais']);
		$stmt->bindValue(':ultimaEntidad', $_POST['ultimaEntidad']);
		$stmt->bindValue(':claveEntidad', $_POST['claveEntidad']);
		$stmt->bindValue(':ultimoMunicipio', $_POST['ultimoMunicipio']);
		$stmt->bindValue(':origen', $_POST['origen']);
		$stmt->bindValue(':nacionalidad', $_POST['nacionalidad']);
		$stmt->bindValue(':sexo', $_POST['sexo']);
		$stmt->bindValue(':edad', $_POST['edad']);
		$stmt->bindValue(':ultimoLugar', $_POST['ultimoLugar']);
		$stmt->bindValue(':autoridadDenuncia', $_POST['autoridadDenuncia']);
		$stmt->bindValue(':denunciaFecha', $_POST['denunciaFecha']);
		$stmt->bindValue(':entidadDenuncia', $_POST['entidadDenuncia']);
		$count = $stmt->execute();
		$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("HTTP/1.1 200 Ok");
			echo json_encode($idPost);
			exit;
		}
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");
?>