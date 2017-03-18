<?php


if (!isset($_POST["form_id"])) {
	die("doslo je do greske.");
}

include_once ('conectdb.php');

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = str_replace("'", "", $data);
	$data = str_replace("<", "", $data);
	$data = str_replace(">", "", $data);
	$data = htmlspecialchars($data);
	if (empty($data)) {
		return false;
	}
	return $data;
}

var_dump($_POST);


switch ($_POST["form_id"]) {
	case "login":
		if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['login'])) {
			die("Nisu dostavljeni svi podaci za login");
		}

		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);

		if (!$username) {
			die("ne valja username");
		}
		if (!$password) {
			die("ne valja password");
		}

		$password = md5($password);
		$sql = "select * from users where email='$email' and password='$password'";
		$result = mysqli_query($conn, $sql);
		$exists = mysqli_num_rows($result);
		if ($exists != 1) {
			die("korisnik sa unetim podacima nije registrovan");
		}

		$user = mysqli_fetch_assoc($result);

		session_start();
		$_SESSION['user_data'] = $user;
		setcookie("user_id", $user['id'], time()+86400, "/");
		
		header("Location: ../index.php");

		break;

	case "adduser":


		if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password1']) || !isset($_POST['password2']) || !isset($_POST['group_id']) || !isset($_POST['adduser'])) {
			die("nisu dostavljeni svi podaci za dodavanje user-a");
		}

		$username = test_input($_POST['username']);
		$email = test_input($_POST['email']);
		$password1 = test_input($_POST['password1']);
		$password2 = test_input($_POST['password2']);

		if (!$username) {
			die("ne valja username");
		}

		if (!$email) {
			die("ne valja email");
		}

		//ukoliko nakon velidacije username i email bude prazan string funkicja test_input vraca false i ispisuje se ne valja email, 
		//treba uraditi dodatnu validaciju sa email


		$password1 = md5($password1);
		$password2 = md5($password2);
		$password = "";

		if ($password1==$password2) {
			$password=$password1;
			echo 	"Uspesno ste se registrovali, Vas email je: ".$email;
		}else {
			die("Lozinke se ne poklapaju, pokusajte ponovo");
		}


		$sql = "select * from users where username='$username'";
		$result = mysqli_query($conn, $sql);
		$exists = mysqli_num_rows($result);
		if ($exists != 0) {
			die("korisnik sa zeljenim username je vec registrovan");
		}

		$sql1 = "SELECT * FROM groups WHERE id=".$_POST['group_id'];
		$result1 = mysqli_query($conn, $sql1);
		$rw1 = mysqli_fetch_assoc($result1);
		
		$sql2 = "SELECT * FROM roles WHERE role_id=".$_POST['role_id'];
		$result2 = mysqli_query($conn, $sql2);
		$rw2 = mysqli_fetch_assoc($result2);


		$sql = "INSERT INTO users (username, email, password, role_id, role_name, group_id, group_name) VALUES ('".$username."', '".$email."', '".$password."', '".$rw2['role_id']."', '".$rw2['name']."', '".$rw1['id']."', '".$rw1['name']."')";
		$insert = mysqli_query($conn, $sql);


		break;


	case "assignment":
		if (!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['group']) || !isset($_FILES['download_url'])) {
			die("nisu dostavljeni svi podaci");
		}

		$default_file_url = '';

		$title = test_input($_POST['title']);
		$description = test_input($_POST['description']);
		$group = test_input($_POST['group']);
		

		if (!$title) {
			die("ne valja title");
		}
		if (!$description) {
			die("ne valja description");
		}
		if (!$group) {
			die("ne valja group");
		}

		$sql = "SQL";
		$insert = mysqli_query($conn, $sql);
		$last_id = mysqli_insert_id($conn);

		if ($_FILES['download_url']['size'] < 0) {
			die("invalid file size");
		} else {
			move_uploaded_file($_FILES['download_url']['tmp_name'], '../uploads/'.$_FILES['download_url']['name']);
			$download_url = '../uploads/'. $_FILES['download_url']['name'];

			$sql = "update movies set download_url='$picture_url' where id=$last_id";
			$update = mysqli_query($conn, $sql);
		}

		break;

	
	case "group":

		$name = $_POST['name']."-".$_POST['group']."-".$_POST['generation'];
		echo $name;
		echo "<br>";


		if ($_POST['name']=='PHP Development') {
			$code_name = 'PHP';
		} elseif ($_POST['name']=='Java Development'){
			$code_name = 'Java';
		} elseif ($_POST['name']=='Software Development'){
			$code_name = 'SD';
		} elseif ($_POST['name']=='Microsoft Windows Development'){
			$code_name = 'MWD';
		} elseif ($_POST['name']=='Microsoft Development'){
			$code_name = 'MD';
		} elseif ($_POST['name']=='Software Engineering'){
			$code_name = 'SE';
		} 

		$code = $code_name."-".$_POST['group']."-".$_POST['generation'];
		echo $code;
		echo "<br>";


		break;

	case "edituser":

		
		break;
}














?>