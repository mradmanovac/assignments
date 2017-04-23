<!doctype html>
<?php
include_once ('conectdb.php');
session_start();
if (isset($_SESSION['usr_id'])) {
    if ($_SESSION['role'] == 1) {
        ?>
        <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width">
                <title>Assignment</title>

                <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
                <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic,100italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
                <link rel="stylesheet" type="text/css" href="css/style.css">
            </head>

            <body>
                <header id="header">
                    <div class="wrapper">
                        <div id="logo">
                            <a href="index.php"><img src="images/logo.png" alt="logo"></a>
                        </div>

                        <nav id="nav">
                            <?php if (isset($_SESSION['usr_id'])) { ?>
                                <form method="post" action="action.php">
                                    <input type="hidden" name="form_id" value="logout">
                                    <input class="logout-btn" type="submit" name="logout_submit" value="IZLOGUJ SE">
                                </form>
                            <?php } ?>
                        </nav>
                    </div> 
                </header>
                <section id="main">
                    <aside id="sidebar">
                        <div id="sidebar-top">
                            <div id="user-name">
                                <?php if (isset($_SESSION['usr_id'])) { ?>
                                    <h5><?php echo $_SESSION['u_name']; ?></h5>
                                <?php } ?>
                            </div>
                        </div>
                        <div id="sidebar-nav">
                            <ul>
                                <li><a href="grupe.php"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; Grupe</a></li>
                                <li><a href="zadaci.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp; Zadaci</a></li>
                                <li><a href="studenti.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;Studenti</a></li>
                                <li><a href="istorija.php"><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Istorija</a></li>
                            </ul>
                        </div>
                    </aside>
                    <aside class="content">
                        <div class="forms">
                            <div class="forms-top">
                                <h4>studenti</h4>
                            </div>
                            <div class="forms-cont">
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];

                                    $sql = 'select * from users where id="' . $id . '"';
                                    $result = mysqli_query($conn, $sql);
                                    $rw = mysqli_fetch_assoc($result);
                                    ?>
                                    <form action="action.php?id=<?= $id ?>" method="post">
                                        <div>
                                            <label for="username">Korisničko ime:</label><br>
                                            <input class="inputs" type="text" id="username" name="username2" maxlength="100" value="<?= $rw['username']; ?>" placeholder="Upišite korisničko ime">
                                        </div>
                                        <div>
                                            <label for="email">Email:</label><br>
                                            <input class="inputs" type="email" id="email" name="email2" maxlength="100" value="<?= $rw['email']; ?>" placeholder="Upišite email adresu">
                                        </div>
                                        <div>
                                            <label for="password1">Šifra:</label><br>
                                            <input class="inputs" type="password" id="password1" name="password4" maxlength="10" value="" placeholder="Upisite novu šifru">
                                        </div>
                                        <div>
                                            <label for="password2">Ponovite šifru:</label><br>
                                            <input class="inputs" type="password" id="password1" name="password3" maxlength="10" value="" placeholder="Ponovite  novu šifru">
                                        </div>
                                        <div>
                                            <select class="selects" name='role_id2' id='role_id'>
                                                <?php
                                                $sql = "SELECT * FROM roles where is_active = 1";
                                                $result = mysqli_query($conn, $sql);

                                                while ($rw = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?= $rw['id'] ?>"><?= $rw['role_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div>
                                            <select class="selects" name='group_id2' id='group_id'>


                                                <?php
                                                $sql = 'SELECT users.id, users.username, users.email, users.is_active, roles.role_name, groups.name FROM users INNER JOIN roles ON users.role_id=roles.id INNER JOIN groups ON users.group_id=groups.id';

                                                $result = mysqli_query($conn, $sql);

                                                while ($rw = mysqli_fetch_assoc($result)) {
                                                    ?>

                                                    <td><?= $rw['name'] ?></td>

                                                <?php } ?>

                                                <?php
                                                $sql = "SELECT id, name FROM groups where is_active=1";
                                                $result = mysqli_query($conn, $sql);

                                                while ($rw = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?= $rw['id'] ?>"><?= $rw['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="active">Active status:</label>
                                            <input type="checkbox" name="is_active" value="1" checked="checked">
                                        </div>
                                        <div>
                                            <input type="hidden" name="form_id" value="edituser">
                                            <input class="submit-btn" type="submit" name="save" value="SAČUVAJ">
                                            </form>
                                            <div id="submit-cont">
                                                <?php
                                                //ispisivanje info 
                                                if (isset($_GET['info'])) {
                                                    echo "<p class='msg'>" . $_GET['info'] . "</p>";
                                                }

                                                if (isset($_GET['errormsg'])) {
                                                    echo "<p class='msg'>" . $_GET['errormsg'] . "</p>";
                                                }
                                                ?>

                                                <form method="post" action="action.php?id=<?= $id ?>">
                                                    <input type="hidden" name="form_id" value="deleteuser">
                                                    <input class="submit-btn" type="submit" name="delete" value="IZBRIŠI">
                                                </form>

                                                <?php
                                                //ispisivanje info2 
                                                if (isset($_GET['info2'])) {
                                                    echo "<p class='msg'>" . $_GET['info2'] . "</p>";
                                                }
                                                ?>
                                            </div>
                                        <?php } else { ?>
                                            <form action="action.php" method="post">
                                                <div>
                                                    <label for="username">Korisničko ime:</label><br>
                                                    <input class="inputs" type="text" id="username" name="username" maxlength="100" value="" placeholder="Upišite korisničko ime">
                                                </div>
                                                <div>
                                                    <label for="email">Email:</label><br>
                                                    <input class="inputs" type="email" id="email" name="email" maxlength="100" value="" placeholder="Upišite email adresu">
                                                </div>
                                                <div>
                                                    <label for="password1">Šifra:</label><br>
                                                    <input class="inputs" type="password" id="password1" name="password1" maxlength="10" value="" placeholder="Upišite šifru">
                                                </div>
                                                <div>
                                                    <label for="password2">Ponovite šifru:</label><br>
                                                    <input class="inputs" type="password" id="password2" name="password2" maxlength="10" value="" placeholder="Ponovite šifru">
                                                </div>
                                                <div>
                                                    <select class="selects" name='role_id' id='role_id'>
                                                        <?php
                                                        $sql = "SELECT * FROM roles where is_active = 1";
                                                        $result = mysqli_query($conn, $sql);

                                                        while ($rw = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option value="<?= $rw['id'] ?>"><?= $rw['role_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <select class="selects" name='group_id' id='group_id'>
                                                        <?php
                                                        $sql = "SELECT id, name FROM groups where is_active=1";
                                                        $result = mysqli_query($conn, $sql);

                                                        while ($rw = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option value="<?= $rw['id'] ?>"><?= $rw['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <input type="hidden" name="form_id" value="adduser">
                                                    <input class="submit-btn" type="submit" name="adduser" value="DODAJ">
                                                    <?php
                                                    //ispisivanje errormsg 
                                                    if (isset($_GET['errormsg'])) {
                                                        echo "<p class='msg'>" . $_GET['errormsg'] . "</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </div>
                            </div>
                        </div>
                        <div class="tables">
                            <div class="tables-top">
                                <h4>lista studenata</h4>
                            </div>
                            <div class="tables-cont">

                                <table class="table-stu-zad">
                                    <tr>
                                        <th>korisnicko ime</th>
                                        <th>email</th>
                                        <th>rola</th>
                                        <th>aktivan</th>
                                        <th>grupa</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <?php
                                    $sql = 'SELECT users.id, users.username, users.email, users.is_active, roles.role_name, groups.name FROM users INNER JOIN roles ON users.role_id=roles.id INNER JOIN groups ON users.group_id=groups.id';
                                    //$sql = "select * from users";
                                    $result = mysqli_query($conn, $sql);

                                    while ($rw = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $rw['username'] ?></td>
                                            <td><?= $rw['email'] ?></td>
                                            <td><?= $rw['role_name'] ?></td>
                                            <td><?= $rw['is_active'] ?></td>
                                            <td><?= $rw['name'] ?></td> <!--$rw['name']-->
                                            <td>
                                                <a href="studenti.php?id=<?= $rw['id'] ?>">edit</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </aside>
                    <footer id="footer">
                    </footer>
                </section>



            </body>
        </html>
    <?php
    } else {
        header("Location: index.php");
    }
}
?>



