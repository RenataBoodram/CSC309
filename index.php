<?php
	session_start();
	include_once "top_navi.php";
	include_once "main_sidebar.php";


?>

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

    <style>
        body {
            padding-top: 51px;
        }
    </style>
</head>

<body>
		
    <!-- Sidebar -->
    
    <!-- /#sidebar-wrapper -->

	
    <!-- Page Content (Listings) -->
    <div class="container">

        <div class="row">
		
            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href="listing.php"> <img class="slide-image" src="http://placehold.it/800x300" alt=""> </a>
                                </div>
                                <div class="item">
                                     <a href="listing.php"> <img class="slide-image" src="http://placehold.it/800x300" alt=""> </a>
                                </div>
                                <div class="item">
                                     <a href="listing.php"> <img class="slide-image" src="http://placehold.it/800x300" alt=""> </a>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">

			<?php
				$conn = "host=csc309instance2.cuw3cz9voftq.us-west-2.rds.amazonaws.com port=5432 dbname=SynergySpace user=CSC309Project password=309kerebe";
				$dbconn = pg_connect($conn);
				$query = "SELECT * from listings ORDER BY rating DESC LIMIT 6";
				$result = pg_query($dbconn, $query);
				while ($row = pg_fetch_row($result)) {
					echo "
                    <div class='col-sm-4 col-lg-4 col-md-4'>
                        <div class='thumbnail'>
                            <a href='listing.php?id=$row[0]'><img src='http://placehold.it/320x150'></a>
                            <div class='caption'>
                                <h4 class='pull-right'>$row[3]</h4>
                                <h4><a href='listing.php?id=$row[0]'>$row[1]</a>
                                </h4>
                                <p>$row[4]</p>
                            </div>
                            <div class='ratings'>
                                <p class='pull-right'>15 reviews</p>
                                <p><span>$row[2]</span></p>
                            </div>
                        </div>
                    </div>";
				}
				pg_close($dbconn);
			?>


                </div>

            </div>

        </div>
    </div>
    <!-- /.container -->
	
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    

    
</body>
</html>