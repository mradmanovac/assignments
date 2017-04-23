<!doctype html>
<?php
include_once ('conectdb.php');
session_start();
if (isset($_SESSION['usr_id'])){
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
			    <?php if (isset($_SESSION['usr_id'])){ ?>
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
				    <?php if (isset($_SESSION['usr_id'])){ ?>
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
		    <div class="students">
			    <div class="forms-top">
				    <h4>zadaci</h4>
				</div>
				<div class="forms-cont">
				    <?php
			            if(isset($_GET['id'])){
                                $id = $_GET['id'];
								
							$sql = 'select * from assignments where id="'.$id.'"';
                            $result = mysqli_query($conn,$sql);
                            $rw = mysqli_fetch_assoc($result);
                            
				    ?>
			        <form action="action.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
					<div class="inner_cont">
				        <div>
				            <label for="title">Naslov:</label><br>
					        <input class="inputs" type="text" id="title" name="title" maxlength="200" value="<?=$rw['title'];?>">
					    </div>
					    <div>
				            <label for="download_url">Izaberi Fajl</label></br>
		                    <input type="file" id="download_url" name="download_url">
					    </div>
					    <div>
					        <select class="selects" name="group" id="group">
							    <?php
								    $sql = "SELECT id,name FROM groups where is_active='1'";
	                                $result = mysqli_query($conn, $sql);
									
									while($rw = mysqli_fetch_assoc($result)){
								?>
					            <option value="<?=$rw['id']?>"><?=$rw['name']?></option>
								<?php } ?>
					        </select>
					    </div>
					</div>
						<div id="desc-cont">
				            <div>
				            	
				            	<?php 
					           		$sql = 'select * from assignments where id="'.$id.'"';
                            		$result = mysqli_query($conn,$sql);
                            		$rw = mysqli_fetch_assoc($result);
					           	?>
				                <label for="description">Novi opis zadatka:</label><br>
					            <textarea name="description" id="description" cols="62" rows="10"><?=$rw['description']?></textarea>
					           	
				            </div>
				        </div>
				         <input type="hidden" name="form_id" value="editassignment">
					      <input class="submit-btn" type="submit" name="save" value="SAČUVAJ">
				    </form>
					<div id="submit-cont">
			                       <?php
									//ispisivanje info 
									if (isset($_GET['info'])) {
										echo "<p>".$_GET['info']."</p>";
									
									}
									?>
								
			                    <form method="post" action="action.php?id=<?=$id?>">
				                    <input type="hidden" name="form_id" value="deleteassignment">
					                <input class="submit-btn" type="submit" name="delete" value="IZBRIŠI">
			                    </form>

			                    <?php
									//ispisivanje info2 
									if (isset($_GET['info2'])) {
										echo "<p>".$_GET['info2']."</p>";
									}
									?>

					</div>
					<?php } else { ?>
					
					<form action="action.php" method="post" enctype="multipart/form-data">
					<div class="inner-c-res inner_cont">
				        <div>
				            <label for="title">Naslov:</label><br>
					        <input class="inputs" type="text" id="title" name="title" maxlength="200" value="" placeholder="Upisite naslov">
					    </div>
					    <div class="file">
				            <label for="download_url">Izaberi Fajl</label></br>
		                    <input type="file" id="download_url" name="download_url">
					    </div>
					    <div>
					        <select class="selects" name='group' id='group'>
							    <?php
								    $sql = "SELECT id,name FROM groups where is_active='1'";
	                                $result = mysqli_query($conn, $sql);
									
									while($rw = mysqli_fetch_assoc($result)){
								?>
					            <option value="<?=$rw['id']?>"><?=$rw['name']?></option>
								<?php } ?>
					        </select>
					    </div>
						<div>
							<input type="hidden" name="form_id" value="assignment">
	                        <input class="submit-btn" type="submit" name="submit" value="DODAJ">

	                        <?php
						//ispisivanje errormsg 
						if (isset($_GET['errormsg'])) {
							echo "<p>".$_GET['errormsg']."</p>";
						
						}
						?>


						</div>
					</div>
						<div id="desc-cont">
				            <div>
				                <label for="description">Opis zadatka:</label><br>
					            <textarea name="description" id="description" cols="62" rows="10" maxlength="1000" placeholder="Upišite opis"></textarea>
				            </div>
				        </div>
				    </form>
					<?php } ?>
				</div>
			</div>
		<div class="clear-fix tables">
		    <div class="tables-top">
			    <h4>spisak svih zadataka</h4>
			</div>
			<div class="tables-cont">
			
		    <table class="table-stu-zad">
			    <tr>
					<th>naslov</th>
					<th>opis</th>
					<th>kreirano</th>
					<th>link</th>
					<th>preuzimanja</th>
					<th>&nbsp;</th>
				</tr>
				<?php
					$sql = "select * from assignments";
		            $result = mysqli_query($conn, $sql);

	                while($rw = mysqli_fetch_assoc($result)){
						$desc_lenght = $rw['description'];
						
					if (strlen($desc_lenght) > 30){
					  $desc_lenght = substr($desc_lenght, 0, 20) . '...';
					}
					?>
				<tr>
					<td><?=$rw['title']?></td>
					<td><?=$desc_lenght?></td>
					<td><?=$rw['created_at']?></td>
					<td><a href="uploads/<?=$rw['download_url']?>">Preuzmi</a></td>
					<td>4</td>
					<td>
					    <a href="zadaci.php?id=<?=$rw['id']?>">edit</a>
					</td>
				</tr>
				<?php } ?>
			</table>
			<?php
						//ispisivanje errormsg 
						if (isset($_GET['file'])) {
							echo "<p>".$_GET['file']."</p>";
						
						}
			?>
			</div>
		</div>
		</aside>
    </section>

    <footer id="footer">
    </footer>

</body>
</html>
<?php } else { header("Location: http://localhost/assignment/index.php"); } } ?>






















