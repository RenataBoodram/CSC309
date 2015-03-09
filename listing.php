<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>SynergySpace</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js"></script>
    <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
    <script src="http://m-e-conroy.github.io/angular-dialog-service/javascripts/dialogs.min.js" type="text/javascript"></script>


</head>
    <style>
        body {
            padding-top: 51px;
        }
    </style>

<body>
	<?php
		session_start();
		include "top_navi.php";

		$curruser = $_SESSION["username"]; // Check if a user is logged in

		// Get the information from the database for the current listing
		$id = $_GET['id'];
		$conn = "host=csc309instance2.cuw3cz9voftq.us-west-2.rds.amazonaws.com port=5432 dbname=SynergySpace user=CSC309Project password=309kerebe";
		$dbconn = pg_connect($conn);
		$listinfo = pg_query($dbconn, "SELECT * from listings WHERE listid = $id");
		$result = pg_fetch_row($listinfo);

		// Get the tenants for the current database
		$alltenants = pg_query($dbconn, "SELECT username FROM tenant WHERE listid = $id");

		// Check if current page was rated
		$ifliked = pg_query($dbconn, "SELECT liked FROM postrated WHERE username = '$curruser' AND listid = $id");
		$likedresult = pg_fetch_row($ifliked);
		$numlikedrows = pg_num_rows($ifliked);

		// Check if user owns this page
		$owner = pg_query($dbconn, "SELECT * from posted WHERE username = '$curruser' AND listid = $id");
		$isowner = pg_num_rows($owner);

		// MAKE CHANGES TO LISTING
		if (isset($_POST['save'])) {
			$addr = $_POST['address'];
			$city = $_POST['city'];
			$desc = $_POST['description'];
			
			pg_query($dbconn, "UPDATE listings SET address = '$addr', city = '$city', description = '$desc' WHERE listid = $id");
			$listinfo = pg_query($dbconn, "SELECT * from listings WHERE listid = $id");
			$result = pg_fetch_row($listinfo);
		}


		pg_close($dbconn);	
	?>
    
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
		<?php
			while ($tenant = pg_fetch_row($alltenants)) {
				echo "<li><a href='profile.php?user=$tenant[0]'>$tenant[0]</a></li>";
			}
		?>	
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
	
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-9">
			<form method="post">
                <div class="thumbnail">
                    <img class="img-responsive" src="http://placehold.it/800x300" alt="">
                    <div class="caption-full">

			<!-- Rating -->
                        <h4 class="pull-right" id="rati"><?php echo "$result[3]"; ?></h4>

			<!-- The address of the listing -->
                        <h4 class="edit" name="address"><?php echo "$result[1]"; ?> </h4>

                    </div>

                    <div class="ratings">
                        <p class="pull-right">
				<button class="btn btn-default likedislike" id="Y"><span class="glyphicon glyphicon-plus"></span></button> 
				<button class="btn btn-default likedislike" id="N"><span class="glyphicon glyphicon-minus"></span></button></p>
                    
			<!-- The description of the listing -->
                        <p class="edit" name="city"><?php echo "$result[2]"; ?></p>

		       </div>
                </div>

                <div class="well">

                    <div class="pull-right">
                        <?php
				if ($isowner != 0) { echo "<a class='btn btn-success' id='editlisting'>Edit</a> <a class='btn btn-danger' id='deletelisting'>Delete</a>"; } ?>
                    </div>
			<!-- The description of the listing -->
                        <p class="edit" name="description"><?php echo "$result[4]"; ?></p>


                </div></form>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
	
    <!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

<!-- BUTTON STUFF -->
<script async>
			var numliked = <?php echo "$numlikedrows"; ?>;
			if (numliked != 0) {
				var likedval = <?php echo json_encode("$likedresult[0]"); ?>;
				if (likedval == "Y") {
					$("#Y").toggleClass("btn-primary");
					$("#N").attr("disabled", "disabled");

				} else if (likedval == "N") {
					$("#N").toggleClass("btn-primary");
					$("#Y").attr("disabled", "disabled");

				}
			} 



		$(".likedislike").click(function(e) {
			e.preventDefault();
 			$(this).toggleClass("btn-primary");

			var currentClass = $(this).attr("class");

			var rateaction = $(this).attr("id");
			if (rateaction == "Y") {
				var other = "N";


			} else { var other = "Y"; 

			}

			var lid = '<?php $listid = $_GET['id']; echo "$listid"; ?>';
			if (currentClass == "btn btn-default likedislike") { // The button was disabled
				var whattodo = "D"; // delete rating
				

				$('#' + other).removeAttr("disabled");
				if (rateaction == "Y") {
					document.getElementById("rati").innerHTML--;
				} else {
					document.getElementById("rati").innerHTML++;
				}
			} else { // something was rated
				 var whattodo = "A"; // add rating
				 $('#' + other).attr("disabled", "disabled");

		
				if (rateaction == "Y") {

					document.getElementById("rati").innerHTML++;

				} else { 
					document.getElementById("rati").innerHTML--;
				}

			}

			$.ajax({
				url: "rate.php",
				type: "POST",
				data: { action : rateaction, listid : lid, modify : whattodo }
			});
 
			
			
		});

</script>

<script>
// EDIT STUFF 


$("#editlisting").click(function() {
	$(".edit").each(function(i) {
		$(this).replaceWith("<input class='form-control' type='text' name='" + $(this).attr("name")  + "' value='" + $(this).text() + "' />");
	});
	$(this).replaceWith("<button type='submit' class='btn btn-success' name='save' id='save'>Save</button>");
});
</script>

<script>

$("#deletelisting").click(function() {
	var r = confirm("Are you sure you want to delete this listing?");
	 if (r == true) {
		
		var lid = '<?php $listid = $_GET['id']; echo "$listid"; ?>';	
		 $.ajax({
			url: "listingmod.php",
			type: "POST",
			data: { listid : lid }
		 });
		window.location = "http://ec2-52-10-253-249.us-west-2.compute.amazonaws.com";
	}
}); 
</script>	
    
</body>
</html>
