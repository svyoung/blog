<?php require_once('../includes/functions.php'); 
get_header();

session_start();

$loginErrMsg = "";

if(isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0 ) {
	echo "<ul class='error'>";
	foreach($_SESSION['ERRMSG_ARR'] as $msg) {
		echo "<li>" . $msg . "</li>";
	}
	echo "</ul>";
	unset($_SESSION['ERRMSG_ARR']);
}

?>

<div id="login">
	<form method="post" name="login" action="auth.php">
		<table>
			<tr>
				<td>Howdy there, sugar</td>
			</tr>
			<tr>
				<td><input type="text" name="username" placeholder="username"></td>
			</tr>
			<tr>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>
                    <button type="submit" name="submit">login</button>
                    <span style="color: red"><?php echo $loginErrMsg; ?></span>
                </td>
			</tr>
	</form>
</div>
