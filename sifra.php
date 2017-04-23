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
                                <li><a href="index.php"><i class="fa fa-book" aria-hidden="true"></i>&nbsp; Lista domaćih</a></li>

                            <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </aside>
            <aside class="content">
                <?php
                if (isset($_SESSION['usr_id'])) {
                    $id = $_SESSION['usr_id'];
                    ?>
                    <div class="login-form forms">
                        <div class="forms-top">
                            <h4>Izmena šifre  </h4>

                        </div>
                        <div class="forms-cont">
                            <form action="action.php?id=<?= $id ?>" method="post" name="sifra">
                                <div>

                                    <label for="password1"> Nova šifra:</label><br>
                                    <input class="inputs" type="password" id="password1" name="password1" maxlength="10" value="" placeholder="Upišite šifru">
                                </div>
                                <div>
                                    <label for="password2">Ponovite novu šifru:</label><br>
                                    <input class="inputs" type="password" id="password2" name="password2" maxlength="10" value="" placeholder="Ponovite šifru">
                                </div>						<div>
                                    <input type="hidden" name="form_id" value="sifra">
                                    <input class="submit-btn" type="submit" name="sifra_btn" value="OK">

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
<?php } ?>

            </aside>
        </section>

        <footer id="footer">
        </footer>
    </body>
</html>























