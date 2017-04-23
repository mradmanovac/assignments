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

switch ($_POST["form_id"]) {
    case "login":
        session_start();
        if (!isset($_POST['username']) || !isset($_POST['password']) && isset($_POST['login_btn'])) {
            die("Nisu dostavljeni svi podaci za login");
        }

        if (isset($_SESSION['usr_id']) != "") {
            header("Location: index.php");
        }

        $username = test_input($_POST['username']);
        $password = test_input($_POST['password']);

        if (!$username) {
            die(header("Location: index.php?errormsg=Ne valja username"));
        }
        if (!$password) {
            die(header("Location: index.php?errormsg=Ne valja password"));
        }


        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "select * from users where username = '" . $username . "' and password = '" . md5($password) . "' and is_active='1'";
        $result = mysqli_query($conn, $sql);


        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['usr_id'] = $row['id'];
            $_SESSION['u_name'] = $row['username'];
            $_SESSION['role'] = $row['role_id'];
            header("Location: index.php");
        } else {
            die(header("Location: index.php?errormsg=Incorrect Username or Password or user is not active!"));
        }

        header("Location: index.php");
        break;


    case "logout":
        session_start();
        if (isset($_SESSION['usr_id'])) {
            session_destroy();
            unset($_SESSION['usr_id']);
            unset($_SESSION['u_name']);
            header("Location: index.php");
        } else {
            header("Location: index.php");
        }
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
            die(header("Location: studenti.php?errormsg=Ne valja username"));
        }

        if (!$email) {
            die(header("Location: studenti.php?errormsg=Ne valja email"));
        }



        $password1 = md5($password1);
        $password2 = md5($password2);
        $password = "";

        if ($password1 == $password2) {
            $password = $password1;
            echo "Uspesno ste se registrovali, Vas email je: " . $email;
            header("Location: studenti.php");
        } else {
            die(header("Location: studenti.php?errormsg=Lozinke se ne poklapaju, pokusajte ponovo"));
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die(header("Location: studenti.php?errormsg=Mejl nije u odgovoarajucem formatu"));
        }

        if (empty($_POST['password1']) && empty($_POST['password2'])) {
            die(header("Location: studenti.php?errormsg=Niste uneli password"));
        }

        $sql = "select * from users where username='" . $username . "'";
        $result = mysqli_query($conn, $sql);
        $exists = mysqli_num_rows($result);
        if ($exists != 0) {
            die(header("Location: studenti.php?errormsg=korisnik sa zeljenim username je vec registrovan"));
        }

        $sql = "INSERT INTO users (username, email, password, role_id, group_id, created_at) VALUES ('" . $username . "', '" . $email . "', '" . $password . "', '" . $_POST['role_id'] . "', '" . $_POST['group_id'] . "', '" . date("Y-m-d H:i:s") . "')";
        $insert = mysqli_query($conn, $sql);


        break;


    case "assignment":
        if (!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['group']) || !isset($_FILES['download_url'])) {
            echo("nisu dostavljeni svi podaci");
        }

        $default_file_url = '';

        $title = test_input($_POST['title']);
        $description = test_input($_POST['description']);
        $group = $_POST['group'];


        if (!$title) {
            die(header("Location: zadaci.php?errormsg=Ne valja naslov"));
        }
        if (!$description) {
            die(header("Location: zadaci.php?errormsg=Ne valja opis"));
        }


        if ($_FILES['download_url']['size'] != 0) {
            //var_dump($_FILES);


            $file = $_FILES['download_url']['name'];
            $file_tmp = $_FILES['download_url']['tmp_name'];
            $ext = pathinfo($file, PATHINFO_EXTENSION); //validacija ekstenzije

            if ($_FILES['download_url']['size'] < 0) {
                die("invalid file size");
            } elseif ($ext !== 'zip' && $ext !== 'rar') {

                die(header("Location: zadaci.php?id=$id&info=fajl nije dozvoljenog formata, dozvoljeni formati su rar i zip"));
            } else {
                $sql = 'INSERT INTO assignments (title, description, created_at, group_id, download_url) VALUES ("' . $title . '", "' . $description . '", "' . date("Y-m-d H:i:s") . '", "' . $group . '", "' . $file . '")';
                $insert = mysqli_query($conn, $sql);
                $save_file = move_uploaded_file($file_tmp, "uploads/$file");

                header("Location: zadaci.php");
            }
        } else {
            $file = "file.php";
            $sql = 'INSERT INTO assignments (title, description, created_at, group_id, download_url) VALUES ("' . $title . '", "' . $description . '", "' . date("Y-m-d H:i:s") . '", "' . $group . '", "' . $file . '")';
            $insert = mysqli_query($conn, $sql);

            header("Location: zadaci.php");
        }

        break;

    case "group":

        if (!isset($_POST['name']) || !isset($_POST['group']) || !isset($_POST['generation'])) {
            die("nisu dostavljeni svi podaci");
            header("Location: grupe.php");
        }

        $name = $_POST['name'] . "-" . $_POST['group'] . "-" . $_POST['generation'];

        if ($_POST['name'] == 'PHP Development') {
            $code_name = 'PHP';
        } elseif ($_POST['name'] == 'Java Development') {
            $code_name = 'Java';
        } elseif ($_POST['name'] == 'Software Development') {
            $code_name = 'SD';
        } elseif ($_POST['name'] == 'Microsoft Windows Development') {
            $code_name = 'MWD';
        } elseif ($_POST['name'] == 'Microsoft Development') {
            $code_name = 'MD';
        } elseif ($_POST['name'] == 'Software Engineering') {
            $code_name = 'SE';
        }

        $code = $code_name . "-" . $_POST['group'] . "-" . $_POST['generation'];

        $sql = "select * from groups where name='$name'";
        $result = mysqli_query($conn, $sql);
        $exists = mysqli_num_rows($result);
        if ($exists != 0) {
            die(header("Location: grupe.php?errormsg=Grupa sa ovim imenom vec postoji"));
        }

        $sql = 'INSERT INTO groups (name,code,created_at) VALUES ("' . $name . '","' . $code . '","' . date("Y-m-d H:i:s") . '")';
        $insert = mysqli_query($conn, $sql);
        header("Location: grupe.php");


        break;



    case "editgroup":

        // posto su vrednosti predefinisane, i samnjena mogucnost da se pogresi, na stranici edit user se jedino radi update da li je grupa aktivna ili ne
        $id = $_GET['id'];


        if (isset($_POST['is_active'])) {
            die(header("Location: grupe.php?id=$id&errormsg=checkbox je i dalje cekiran, gupa ostaje aktivna"));
        } else {
            $sql = "UPDATE groups SET is_active='0' WHERE id='" . $id . "'";
            $update = mysqli_query($conn, $sql);
            header("Location: grupe.php?id=$id&errormsg=Izabrana grupa vise nije aktivna");
        }
        break;

    case "editassignment":


        $id = $_GET['id'];


        if (!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['group']) || !isset($_FILES['download_url'])) {
            die("nisu dostavljeni svi podaci");
        }

        $title = test_input($_POST['title']);
        $description = test_input($_POST['description']);


        if (!$title) {
            die(header("Location: zadaci.php?errormsg=Ne valja naslov"));
        }

        if (!$description) {
            die(header("Location: zadaci.php?errormsg=Ne valja description"));
        }








        if ($_FILES['download_url']['size'] != 0) {
            //var_dump($_FILES);

            $file = $_FILES['download_url']['name'];
            $file_tmp = $_FILES['download_url']['tmp_name'];

            $ext = pathinfo($file, PATHINFO_EXTENSION); //validacija ekstenzije

            if ($_FILES['download_url']['size'] < 0) {
                die("invalid file size");
            } elseif ($ext !== 'zip' && $ext !== 'rar') {
                die(header("Location: zadaci.php?id=$id&info=fajl nije dozvoljenog formata, dozvoljeni formati su rar i zip"));
            } else {
                $sql = 'UPDATE assignments SET title="' . $title . '", description="' . $description . '", created_at="' . date("Y-m-d H:i:s") . '", group_id="' . $_POST['group'] . '", download_url="' . $file . '" WHERE id="' . $id . '"';



                $update = mysqli_query($conn, $sql);

                $save_file = move_uploaded_file($file_tmp, "uploads/$file");

                header("Location: zadaci.php?id=$id&info=zadatak je uspesno izmenjen");
            }
        } else {
            $file = "file.php";
            $sql = 'UPDATE assignments SET title="' . $title . '", description="' . $description . '", created_at="' . date("Y-m-d H:i:s") . '", group_id="' . $_POST['group'] . '", download_url="' . $file . '" WHERE id="' . $id . '"';
            $update = mysqli_query($conn, $sql);
            header("Location: zadaci.php?id=$id&info=zadatak je uspesno izmenjen");
        }

        break;




    case "deleteassignment":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM assignments WHERE id='" . $id . "'";
            $update = mysqli_query($conn, $sql);
        }
        header("Location: zadaci.php?errormsg=Zadatak je uspesno izbrisan");
        break;



    case "edituser":

        $id = $_GET['id'];

        if (!isset($_POST['username2']) || !isset($_POST['email2']) || !isset($_POST['password3']) || !isset($_POST['password4']) || !isset($_POST['role_id2']) || !isset($_POST['group_id2'])) {
            //var_dump($_POST);
            die("nisu dostavljeni svi podaci za update user-a");
        }

        $username = test_input($_POST['username2']);
        $email = test_input($_POST['email2']);
        $password1 = test_input($_POST['password3']);
        $password2 = test_input($_POST['password4']);

        if (!$username) {
            die(header("Location: studenti.php?id=$id&errormsg=Ne valja username"));
        }

        if (!$email) {
            die(header("Location: studenti.php?id=$id&errormsg=Ne valja email"));
        }


        $password1 = md5($password1);
        $password2 = md5($password2);
        $password = "";

        if ($password1 == $password2) {
            $password = $password1;
        } else {
            die(header("Location: studenti.php?id=$id&errormsg=Lozinke se ne poklapaju, pokusajte ponovo"));
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die(header("Location: studenti.php?id=$id&errormsg=Mejl nije u odgovoarajucem formatu"));
        }

        if (empty($_POST['password3']) && empty($_POST['password4'])) {
            die(header("Location: studenti.php?id=$id&errormsg=Niste uneli password"));
        }



        $sql1 = "SELECT * FROM groups WHERE id=" . $_POST['group_id2'];
        $result1 = mysqli_query($conn, $sql1);
        $rw1 = mysqli_fetch_assoc($result1);


        $sql2 = "SELECT * FROM roles WHERE id=" . $_POST['role_id2'];
        $result2 = mysqli_query($conn, $sql2);
        $rw2 = mysqli_fetch_assoc($result2);

        if (isset($_POST['is_active'])) {
            $is_active = '1';
        } else {
            $is_active = '0';
        }


        $sql = 'select username from users where id="' . $id . '"';
        $result = mysqli_query($conn, $sql);
        $rw = mysqli_fetch_assoc($result);

        $provera = TRUE;

        if ($rw['username'] == $username) {
            $provera = TRUE;
        } else {

            $sql3 = "select username from users";
            $result3 = mysqli_query($conn, $sql3);
            while ($rw3 = mysqli_fetch_assoc($result3)) {
                if ($rw3['username'] == $username) {
                    $provera = FALSE;
                }
            }
        }


        if ($provera == TRUE) {
            $sql = 'UPDATE users SET username="' . $username . '", email="' . $email . '", password="' . $password . '", role_id="' . $_POST['role_id2'] . '", group_id="' . $_POST['group_id2'] . '", is_active="' . $is_active . '" WHERE id="' . $id . '"';

            $update = mysqli_query($conn, $sql);


            header("Location: studenti.php?errormsg=User je uspesno izmenjen");
        } elseif ($provera == FALSE) {
            header("Location: studenti.php?id=$id&info=User '" . $username . "' vec postoji, pokusajte ponovo");
        } else {
            echo "nesto ne valja";
        }

        break;

    case "deleteuser":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM users WHERE id='" . $id . "'";
            $update = mysqli_query($conn, $sql);
        }
        header("Location: studenti.php?errormsg=Korisnik je uspesno izbrisan");
        break;

    case "edit_neaktivne_grupe":
        $id = $_GET['id'];


        if (isset($_POST['is_active'])) {
            $sql = "UPDATE groups SET is_active='1' WHERE id='" . $id . "'";
            $update = mysqli_query($conn, $sql);
            header("Location: neaktivne_grupe.php?id=$id&errormsg=Grupa je ponovo aktivna");
        } else {
            die(header("Location: neaktivne_grupe.php?id=$id&errormsg=checkbox nije cekiran, gupa ostaje neaktivna"));
        }
        break;

    case "sifra":

        $id = $_GET['id'];

        if (!isset($_POST['password1']) || !isset($_POST['password2'])) {
            die("nisu dostavljeni svi podaci za update password-a");
        }

        $password1 = test_input($_POST['password1']);
        $password2 = test_input($_POST['password2']);

        $password1 = md5($password1);
        $password2 = md5($password2);
        $password = "";

        if ($password1 == $password2) {
            $password = $password1;
        } else {
            die(header("Location: sifra.php?id=$id&errormsg=Lozinke se ne poklapaju, pokusajte ponovo"));
        }

        if (empty($_POST['password1']) && empty($_POST['password2'])) {
            die(header("Location: sifra.php?id=$id&errormsg=Niste uneli lozinku"));
        }

        $sql = 'UPDATE users SET password="' . $password . '" WHERE id="' . $id . '"';

        $update = mysqli_query($conn, $sql);

        header("Location: index.php?file=Šifra je uspešno izmenjena");


        break;
}
?>