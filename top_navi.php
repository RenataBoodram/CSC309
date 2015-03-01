<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SynergySpace</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="mailbox.html">Messages</a>
                    </li>
                    <li>
                        <a href="#">Settings</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#login">Login/Register</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Login form -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Login/Register</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                    <div>
                        <input type="text" class="form-control" id="username" placeholder="Username">
                        <br />
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Login</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#register">Register</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Registration form -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                    <div>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <br />
                        <input type="password" class="form-control" name="password" placeholder="Password">
			<br />
	         		<input type="text" class="form-control" name="firstname" placeholder="First name">
			<br />
			<input type="text" class="form-control" name="lastname" placeholder="Last name">     
			<br />        
                    	<button class="btn btn-primary" name="register" value="register" type="submit">Register</button>
		        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
<div id="wrapper">

<?php

	// Function for registration
	if (isset($_POST['register'])) {
		$conn = "host=csc309instance2.cuw3cz9voftq.us-west-2.rds.amazonaws.com port=5432 dbname=SynergySpace user=CSC309Project password=309kerebe";
		$dbconn = pg_connect($conn);
		if (!$dbconn) {
			echo "NO";
		}
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$first = $_POST['firstname'];
		$last = $_POST['lastname'];
		$result = pg_query($dbconn, "INSERT INTO users VALUES('$user', '$pass', '$first', '$last')");
		if (!$result) {
			echo "<script type='text/javascript'>alert('Your username is already taken. Unsuccessful registration.')</script>";
		} else {
			echo "<script type='text/javascript'>alert('You have registered successfully!')</script>";
		} 
		pg_close($dbconn);
	}
?>
