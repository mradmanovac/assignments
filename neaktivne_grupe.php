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
                                    <h5><?= $_SESSION['u_name']; ?></h5>
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
                                <h4>grupe</h4>
                            </div>
                            <div class="forms-cont">
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];

                                    $sql = 'select * from groups where id="' . $id . '"';
                                    $result = mysqli_query($conn, $sql);
                                    $rw = mysqli_fetch_assoc($result);
                                    $print = 'Naziv: ' . $rw['name'] . '<br>Kod:&nbsp&nbsp' . $rw['code']; //prikazije se ime i code grupe koji edutujemo
                                    ?>
                                    <p> <?php echo $print; ?>  </p>
                                    <form action="action.php?id=<?= $id ?>" method="post">
                                        <input type="checkbox" name="is_active" value="1" checked="checked"> Is Active</p> 
                                        <input type="hidden" name="form_id" value="edit_neaktivne_grupe">
                                        <input class="submit-btn" type="submit" name="submit-gr" value="SAČUVAJ">
                                    </form>

                                    <?php
                                    //ispisivanje errormsg 
                                    if (isset($_GET['errormsg'])) {
                                        echo "<p class='msg'>" . $_GET['errormsg'] . "</p>";
                                    }
                                    ?>
                                    <?php
                                    //ispisivanje info 
                                    if (isset($_GET['info'])) {
                                        echo "<p class='msg'>" . $_GET['info'] . "</p>";
                                    }
                                    ?>


                                </div>

                            <?php } else { ?>

                                <form action="action.php" method="post">
                                    <div>
                                        <select class="selects" name="name" id="name">
                                            <option value="PHP Development">PHP Development</option>
                                            <option value="Java Development">Java Development</option>
                                            <option value="Software Development">Software Development</option>
                                            <option value="Microsoft Windows Development">Microsoft Windows Development</option>
                                            <option value="Microsoft Development">Microsoft Development</option>
                                            <option value="Software Engineering">Software Engineering</option>
                                        </select>
                                    </div>
                                    <div>
                                        <select class="selects" name="group" id="group">
                                            <?php
                                            for ($i = 1; $i <= 15; $i++) {
                                                ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <select class="selects" name="generation" id="generation">
                                            <?php
                                            for ($i = 2016; $i <= 2030; $i++) {
                                                ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <input type="hidden" name="form_id" value="group">
                                        <input class="submit-btn" type="submit" name="submit-gr" value="DODAJ">
                                    </div>
                                </form>

                                <?php
                                //ispisivanje errormsg 
                                if (isset($_GET['errormsg'])) {
                                    echo "<p class='msg'>" . $_GET['errormsg'] . "</p>";
                                }
                            }
                            ?>
                        </div>
                        </div>

                        <div class="table-group tables">
                            <div class="tables-top">
                                <h4>lista neaktivnih grupa</h4>
                            </div>
                            <div class="tables-cont">
                                <table>
                                    <tr>
                                        <th>kod</th>
                                        <th>naziv</th>
                                        <th>kreirano</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <?php
                                    $sql = "select * from groups where is_active='0'";
                                    $result = mysqli_query($conn, $sql);

                                    while ($rw = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $rw['code'] ?></td>
                                            <td><?= $rw['name'] ?></td>
                                            <td><?= $rw['created_at'] ?></td>
                                            <td>
                                                <a href="neaktivne_grupe.php?id=<?= $rw['id'] ?>">edit</a>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                    <tr>
                                        <td colspan="4"><a href="grupe.php">Sve aktivne grupe</a> </td>
                                    </tr>
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






















