<?php
//var_dump($_POST);
include_once ('conectdb.php');
?>

<p>Update user</p>
<form method="post" action="action.php" name="updateuser">

<?php
		$sql = "SELECT * FROM users WHERE id=".$_POST['user_id'];
		$result = mysqli_query($conn, $sql);
		$rw = mysqli_fetch_assoc($result);
		//var_dump($rw);
		echo '<p>
		<label for="username">Username</label>
		<input type="text" id="username" name="username" value='.$rw['username'].'> 
		</p>';

		echo '<p>
		<label for="email">E-mail</label>
		<input type="text" id="email" name="email" value='.$rw['email'].' placeholder="Enter Your e-mail">
		</p>';

		echo '<p>
		<label for="password1">Password:</label>
		<input type="password" id="password1" name="password1" value="" placeholder="Enter New password">
		</p>';

		echo '<p>
		<label for="password2">Repeat New password:</label>
		<input type="password" id="password2" name="password2" value="" placeholder="Repeat New password">
		</p>';

		if ($rw['is_active']==='1') {
			echo '<p><input type="checkbox" name="active" value="1" checked="checked"> Is Active</p>';
		}else{
			echo '<p><input type="checkbox" name="active" value="1"> Is Active</p>';
		}
		//ako je je korisnik acitve, cekbox je cekiran, ako ne onda nije




		echo "Choose group ";
		$sql = "SELECT * FROM groups";
		$result = mysqli_query($conn, $sql);
		echo "<select name='group' id='group'>";
		echo "<option></option>";
		while($rw = mysqli_fetch_assoc($result)){
		echo "<option value=".$rw['id'].">".$rw['name']."</option>";
		} 
		echo "</select> </br> ";


?>
	<br> 
  	<input type="hidden" name="form_id" value="updateuser">
	<input type="submit" name="submit" value="Update user">	

</form>


