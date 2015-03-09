<?php
	session_start();
	if (isset($_POST['post'])) {

		$conn = "host=csc309instance2.cuw3cz9voftq.us-west-2.rds.amazonaws.com port=5432 dbname=SynergySpace user=CSC309Project password=309kerebe";
		$dbconn = pg_connect($conn);
		$addr = $_POST['address'];
		$city = $_POST['city'];
		$description = $_POST['description'];
		$user = $_SESSION['username'];
		$result = pg_query($dbconn, "INSERT INTO listings (address, city, description) VALUES ('$addr', '$city', '$description')");

		// Get the id of the new listing.
		$getid = pg_query($dbconn, "SELECT listid FROM listings WHERE address='$addr' AND city='$city'");
		$id = pg_fetch_row($getid);

		$result2 = pg_query($dbconn, "INSERT INTO posted VALUES ($id[0], '$user')");
		$result3 = pg_query($dbconn, "INSERT INTO tenant VALUES ($id[0], '$user')");
		pg_close($dbconn);
		header("Location: http://ec2-52-10-253-249.us-west-2.compute.amazonaws.com/listing.php?id=$id[0]"); 
	}
?>

<div id="sidebar-wrapper">
        <ul class="sidebar-nav">
		<?php 
			if (isset($_SESSION['username'])) {
			$conn = "host=csc309instance2.cuw3cz9voftq.us-west-2.rds.amazonaws.com port=5432 dbname=SynergySpace user=CSC309Project password=309kerebe";
			$dbconn = pg_connect($conn);
			$curruser = $_SESSION['username'];
			$query = "SELECT p.listid, address FROM posted p JOIN listings l ON p.listid = l.listid WHERE username='$curruser'"; 
			$result = pg_query($dbconn, $query);
			while ($row = pg_fetch_row($result)) {
				echo "<li><a href='listing.php?id=$row[0]'>$row[1]</a></li>";
			}
			pg_close($dbconn);
			echo "<li><a href='#' onclick='toggleVisibility();'>Post</a>
                <div id='listing-form' style='visibility:hidden'>
                <form method='post'>
                    <div>
                        <input type='text' class='form-control' name='address' placeholder='Address'>
                        <br />
                        <input type='text' class='form-control' name='city' placeholder='City'>
                        <br />
			<input type='text' class='form-control' name='description' placeholder='Description'>
                        <br />
                        <button type='submit' class='btn btn-default' name='post'>Post</button>

                    </div>
                </form>
                </div> 
</li>";
	

		} else {
			echo "<li><a href='#' data-toggle='modal' data-target='#login'>Login/Register</a></li>";
		}
		?>

        </ul>
    </div>

    <!-- Toggle the visibility of an object given its id. -->
    <script>
        function toggleVisibility() {
            var object = document.getElementById('listing-form');
            if (object.style.visibility == "hidden") {
                object.style.visibility = "visible";
            }
            else {
                object.style.visibility = "hidden";
            }
        }
    </script>