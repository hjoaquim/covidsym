<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
}

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'sim';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
$query = 'SELECT * FROM utl_utilizadores WHERE ID = "'.$_SESSION['id'].'"';
$result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));


if (mysqli_num_rows($result) > 0) {
	$user = mysqli_fetch_row($result);
}

$query = 'SELECT NOME_DISTRITO FROM LOC_DISTRITOS WHERE COD_DISTRITO = '.$user[6].';';
$result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
$dist = mysqli_fetch_row($result);

$query = 'SELECT DESC_UTL FROM UTL_TIPOS_UTILIZADORES WHERE ID='.$user[13].';';
$result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
$tipo = mysqli_fetch_row($result);

$query = 'SELECT nome_distrito FROM loc_distritos';
$result_dist = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
mysqli_close($con);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>

	<style>
		.button {
		background-color: #007bff; /* Green */
		border: none;
		color: white;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
		height: 30px;
		width: 100px;
		border-radius: 10%;
		}

		img {
		border-radius: 50%;
		}
		
		
	</style>


	<body class="loggedin">
		<nav class="navtop"></nav>

		<div> 
			<h2>Profile Page</h2>
			
								<table>
									<form action="change-user.php" method="post"  enctype="multipart/form-data">
												<tr>
													
													<td>	
														<?php
															include("user-menu.php");
														?>
													</td>
													
													
													<td>
													<div class="pricing-entry pb-5 text-center">
															<?php
																echo '<img src="data:image/png;base64,'.base64_encode($user[4]).'" width=100px/>';
															?>
																<table>
																	<tr>
																		<td>Choose Image:</td>
																		<td><input type="file" id="myimage" name="myimage"></td>
																	</tr>
																	<tr>
																		<td>Username:</td>
																		<td><?=$user[1]?></td>
																	</tr>

																	<tr>
																		<td>Nome:</td>
																		<td><input type="text" name="name" value="<?=$user[3]?>" style="width: 300px"></td>
																	<tr>

																	<tr>
																		<td>Password: <input type="checkbox" onclick="showpw()"></td>
																		<td>
																			<input type="password" name="password" style="width: 300px" id=myPw>
																		</td>
																		
																	</tr>
																	<tr>
																		<td>Morada:</td>
																		<td>
																			<input type="text" name="address" value="<?=$user[5]?>" style="width: 300px">
																		</td>
																	</tr>
																	<tr>
																		<td>Distrito:</td>
																		<td>
																		<select name="district" id="district" style="width: 300px">
																		<option><?=$dist[0]?></option>
																		<?php
																		while($row = mysqli_fetch_array($result_dist)){
																			echo "<option>".$row['nome_distrito']."</option>";
																		}
																		?>
																		</select>
																		</td>
																	</tr>
																	<tr>
																		<td>Telemóvel:</td>
																		<td>
																			<input type="tel" name="contact" value="<?=$user[7]?>" id="contact" style="width: 300px">
																		</td>
																	</tr>
																	<tr>
																		<td>Email:</td>
																		<td>
																			<input type="email" name="email" value="<?=$user[8]?>" id="email" style="width: 300px">
																		</td>
																	</tr>
																	<tr>
																		<td>Data de Nascimento:</td>
																		<td>
																			<input type="date" name="birthdate" value="<?=$user[9]?>" id="birthdate" style="width: 300px">
																		</td>
																	</tr>
																	<tr>
																		<td>Nº cartão de utente:</td>
																		<td>
																			<input type="number" name="health-card-number" value="<?=$user[10]?>" id="health-card-number" style="width: 300px">
																		</td>
																	</tr>
																	<tr>
																		<td>NIF:</td>
																		<td>
																			<input type="number" name="nif" value="<?=$user[11]?>" id="nif" style="width: 300px">
																		</td>
																	</tr>
																	<tr>
																		<td>Genero:</td>
																		<td>
																			<select name="gender" id="gender" style="width: 300px">
																			<option value="male">Male</option>
																			<option value="female">Female</option>
																			</select>
																		</td>
																	</tr>
																	<tr>
																		<td>Tipo de utilizador:</td>
																		<td><?=$tipo[0]?></td>
																	</tr>

																	<tr><td><td> <input type="submit" value="Save changes"> <td></td></tr>

																</table>
															</div>
													</td>

												</tr>
								</form>
						</table>

		</div>
	</body>
</html>


<script>
	function showpw() {
	var x = document.getElementById("myPw");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
	}
</script>