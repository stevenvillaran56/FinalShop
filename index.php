<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    
     <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>User Name</label>
     	<input type="text" name="uname" placeholder="User Name" required><br>
     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password" required><br>
     	<button type="submit">Login</button>
     </form>

  </body>
</html>

