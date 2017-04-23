<!doctype html>
<?php
include_once ('conectdb.php');
session_start();
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
                            <input class="logout-btn" type="submit" name="logout_submit" value="Izloguj se">
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
                        <?php
                        $sql = "SELECT role_id FROM users";
                        $result = mysqli_query($conn, $sql);
                        $rw = mysqli_fetch_assoc($result);

                        if (isset($_SESSION['usr_id'])) {

                            if ($_SESSION['role'] == 1) {
                                ?>
                                <li><a href="grupe.php"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; Grupe</a></li>
                                <li><a href="zadaci.php"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp; Zadaci</a></li>
                                <li><a href="studenti.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;Studenti</a></li>
                                <li><a href="istorija.php"><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Istorija</a></li>
                            <?php } elseif ($_SESSION['role'] == 2) {
                                ?>
                                <li><a href="sifra.php"><i class="fa fa-key" aria-hidden="true"></i>&nbsp; Izmena lozinke</a></li>

                            <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </aside>
            <aside class="content">
<?php if (!isset($_SESSION['usr_id'])) { ?>
                    <div class="login-form forms">
                        <div class="forms-top">
                            <h4>logovanje</h4>
                        </div>
                        <div class="forms-cont">
                            <form action="action.php" method="post" name="login">
                                <div>
                                    <label for="username">Korisničko ime:</label><br>
                                    <input class="inputs" type="text" id="username" name="username" maxlength="50" value="" placeholder="Upišite korisničko ime">
                                </div>
                                <div>
                                    <label for="password">Šifra:</label><br>
                                    <input class="inputs" type="password" id="password"  name="password" maxlength="32" value="" placeholder="Upišite šifru">
                                </div>
                                <div>
                                    <input type="hidden" name="form_id" value="login">
                                    <input class="submit-btn" type="submit" name="login_btn" value="OK">

                                    <?php
                                    //ispisivanje errormsg 
                                    if (isset($_GET['errormsg'])) {
                                        echo "<p class='msg'>" . $_GET['errormsg'] . "</p>";
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                } else {

                    if ($_SESSION['role'] == 1) {
                        ?>

                        <div class="tables">
                            <div class="tables-top">
                                <h4>lista domaćih</h4>
                            </div>
                            <div class="tables-cont">
                                <table class="table-index">
                                    <tr>
                                        <th>naslov</th>
                                        <th>opis</th>
                                        <th>grupa</th>
                                        <th>kreirano</th>
                                        <th>link</th>
                                        <th>detalji</th>
                                    </tr>
                                    <?php
                                    $sql = 'SELECT * FROM assignments INNER JOIN groups ON assignments.group_id = groups.id';
                                    $result = mysqli_query($conn, $sql);
                                    while ($rw = mysqli_fetch_assoc($result)) {
                                        $desc_lenght = $rw['description'];
                                        

                                        if (strlen($desc_lenght) > 30) {
                                            $desc_lenght = substr($desc_lenght, 0, 20) . '...';
                                        }

                                       


                                        ?>
                                        <tr>
                                        <a href="#"><td><?= $rw['title'] ?></td></a>
                                        <td><?= $desc_lenght ?></td>
                                        <td><?= $rw['name'] ?></td>
                                        <td><?= $rw['created_at'] ?></td>

                                        <?php
                                        if ($rw['download_url'] == 'file.php') {
                                            ?>
                                            <td><a href="index.php?file=Ovaj domaci zadatak nema prilog za preuzimanje">Preuzmi</a></td>					
                                        <?php } else { ?>
                                            <td><a href="uploads/<?= $rw['download_url'] ?>">Preuzmi</a></td>
            <?php } ?>

                                        <td><a href="index.php?details=<?= $rw['id'] ?>">detalji</a></td>
                                        </tr>
                                <?php } ?>
                                </table>
                                <?php
                                //ispisivanje errormsg 
                                if (isset($_GET['file'])) {
                                    echo "<p class='msg'>" . $_GET['file'] . "</p>";
                                }
                                ?>
                            </div>
                        </div>
    <?php } elseif ($_SESSION['role'] == 2) { ?>
                        <div class="tables">
                            <div class="tables-top">
                                <h4>lista domaćih</h4>
                            </div>
                            <div class="tables-cont">
                                <table class="table-index">
                                    <tr>
                                        <th>naslov</th>
                                        <th>opis</th>
                                        <th>grupa</th>
                                        <th>kreirano</th>
                                        <th>link</th>
                                        <th>detalji</th>
                                    </tr>
                                    <?php
                                    $sql = 'SELECT * FROM assignments INNER JOIN groups ON assignments.group_id = groups.id';
                                    $result = mysqli_query($conn, $sql);
                                    while ($rw = mysqli_fetch_assoc($result)) {
                                        $desc_lenght = $rw['description'];
                                      

                                        if (strlen($desc_lenght) > 30) {
                                            $desc_lenght = substr($desc_lenght, 0, 20) . '...';
                                        }
                                        


                                        ?>
                                        <tr>
                                        <a href="#"><td><?= $rw['title'] ?></td></a>
                                        <td><?= $desc_lenght ?></td>
                                        <td><?= $rw['name'] ?></td>
                                        <td><?= $rw['created_at'] ?></td>

                                        <?php
                                        if ($rw['download_url'] == 'file.php') {
                                            ?>
                                            <td><a href="index.php?file=Ovaj domaci zadatak nema prilog za preuzimanje">Preuzmi</a></td>					
                                        <?php } else { ?>
                                            <td><a href="uploads/<?= $rw['download_url'] ?>">Preuzmi</a></td>
            <?php } ?>

                                        <td><a href="index.php?details=<?= $rw['id'] ?>">detalji</a></td>
                                        </tr>
                                <?php } ?>
                                </table>
                                <?php
                                //ispisivanje errormsg 
                                if (isset($_GET['file'])) {
                                    echo "<p class='msg'>" . $_GET['file'] . "</p>";
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                    }
                }
                if (isset($_GET['details'])) {
                    $details = $_GET['details'];
                    //var_dump($details);	
                    $sql = 'select * from assignments where id="' . $details . '"';
                    $result = mysqli_query($conn, $sql);
                    $rw = mysqli_fetch_assoc($result);
                    ?>
                    <div class="table-details tables">
                        <div class="tables-top">
                            <h4>detalji</h4>
                        </div>
                        <div class="tables-cont">
                            <table class="table-index">
                                <?php
                                $sql = 'select * from assignments where id="' . $details . '"';
                                $result = mysqli_query($conn, $sql);

                                $rw = mysqli_fetch_assoc($result);
                                ?>
                                <tr>

                                    <th>naslov</th>
                                    <td><?= $rw['title'] ?></td>
                                </tr>
                                <tr>
                                    <th>opis</th>
                                    <td><?= $rw['description'] ?></td>
                                </tr>
                                <tr>

                                    <?php if ($rw['download_url'] == 'file.php') { ?>
                                        <th colspan="2"><a href="index.php?file=Ovaj domaci zadatak nema prilog za preuzimanje">Preuzmi</a></th>
                                    <?php } else { ?>
                                        <th colspan="2"><a href="uploads/<?= $rw['download_url'] ?>">Preuzmi</a></th>
    <?php } ?>

                                </tr>
                            </table>
                        </div>
                    </div>
<?php } ?>
            </aside>
        </section>

        <footer id="footer">
        </footer>
    </body>
</html>























