<!DOCTYPE html>

<?php


include_once ('conectdb.php');

?>



<html>
<head>
	<title>Forms</title>
</head>
<body>

<p>Login</p>
<form method="post" action="action.php" name="login">

	<p>
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" value="" placeholder="Enter Your Username">
	</p>

	<p>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" value="" placeholder="Enter Your Password">
	</p>

		<input type="hidden" name="form_id" value="login">
		<input type="submit" name="login" value="Login">

</form>

</br></br></br></br>

<p>Add user</p>
<form method="post" action="action.php" name="user">
	
	<p>
		<label for="username">Username</label>
		<input type="text" id="username" name="username" value="" placeholder="Enter Your username">
	</p>

	<p>
		<label for="email">E-mail</label>
		<input type="text" id="email" name="email" value="" placeholder="Enter Your e-mail">
	</p>

	<p>
		<label for="password1">Password:</label>
		<input type="password" id="password1" name="password1" value="" placeholder="Enter Your password">
	</p>

		<p>
		<label for="password2">Repeat password:</label>
		<input type="password" id="password2" name="password2" value="" placeholder="Repeat password">
	</p>

	<?php
		echo "Choose role ";
	$sql = "SELECT * FROM roles where is_active = 1";
	$result = mysqli_query($conn, $sql);

	echo "<select name='role_id' id='role_id'>";
	
	while($rw = mysqli_fetch_assoc($result)){
	echo "<option value=".$rw['role_id'].">".$rw['name']."</option>";
	} 
	echo "</select> </br> ";
	?>


	<!--
	<p><input type="checkbox" name="active" value="1"> Is Active</p> -->
	


	<?php
		echo "Choose group ";
	$sql = "SELECT id, name FROM groups where is_active=1";
	$result = mysqli_query($conn, $sql);

	echo "<select name='group_id' id='group_id'>";
	
	while($rw = mysqli_fetch_assoc($result)){
	echo "<option value=".$rw['id'].">".$rw['name']."</option>";
	} 
	echo "</select> </br> ";
	?>


	<br> 
  	<input type="hidden" name="form_id" value="adduser">
	<input type="submit" name="adduser" value="Add user">	

</form>

</br></br></br></br>

<p>Add new assignment</p>
<form method="post" action="action.php" name="assignment" enctype="multipart/form-data">
	
	<p>
		<label for="title">Title</label>
		<input type="text" id="title" name="title" value="" placeholder="Enter title">
	</p>

		<p>
		<label for="description">Description</label>
		<input type="text" id="description" name="description" value="" placeholder="Enter Description">
	</p>
	<p>
		<label for="download_url">Choose File</label>
		<input type="file" id="download_url" name="download_url" value="">
	</p>
	
	<?php
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
  	<input type="hidden" name="form_id" value="assignment">
	<input type="submit" name="submit" value="Add new assignment">

</form>

</br></br></br></br>


<p>Add New Group</p>
<form method="post" action="action.php" name="group">

	<p>
	Name:	
	<select name='name' id='name'>
	<option value="PHP Development">PHP Development</option>
	<option value="Java Development">Java Development</option>
	<option value="Software Development">Software Development</option>
	<option value="Microsoft Windows Development">Microsoft Windows Development</option>
	<option value="Microsoft Development">Microsoft Development</option>
	<option value="Software Engineering">Software Engineering</option>

	</select>


		<?php

  echo " <select name='group' id='group'> ";
  for ($i=1; $i <= 15 ; $i++) { 
  	echo "<option value=".$i.">".$i."</option>";
  }
  echo "</select>";
  	
  echo "<select name='generation' id='generation'>";
  for ($i=2016; $i <= 2030 ; $i++) {
  	echo "<option value=".$i.">".$i."</option>";
  }
  echo "</select>";

  	?>

	</p>

	<p>
		"Code" se automatski generise na osnovu izabranih polja
	</p>
	<!-- <p><input type="checkbox" name="active" value="1"> Is Active</p> -->

		<input type="hidden" name="form_id" value="group">
		<input type="submit" name="login" value="Add New Group">

</form>

</br></br></br></br>

<p>Edit user</p>
<form method="post" action="edituser.php" name="user">


<?php

$sql = "SELECT * FROM users";
		$result = mysqli_query($conn, $sql);
		echo "<select name='user_id' id='user_id'>";
		echo "<option>Choose user</option>";
		while($rw = mysqli_fetch_assoc($result)){
		echo "<option value=".$rw['id'].">".$rw['username']."</option>";
		} 
		echo "</select>";

?>

	<br> 
	<input type="submit" name="submit" value="Update user">	

</form>

</br></br></br></br>

<p>Delete user</p>
<form method="post" action="action.php" name="deleteuser">


<?php

$sql = "SELECT * FROM users";
		$result = mysqli_query($conn, $sql);
		echo "<select name='user_id' id='user_id'>";
		echo "<option>Choose user</option>";
		while($rw = mysqli_fetch_assoc($result)){
		echo "<option value=".$rw['id'].">".$rw['username']."</option>";
		} 
		echo "</select>";

?>

	<br> 
	<input type="submit" name="deleteuser" value="Delete user">	

</form>

</br></br></br></br>





</body>
</html>