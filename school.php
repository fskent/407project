<?php
	if (!isset($_GET["school_id"])){
		header("Location: index.php");
	}
	
	echo $school_info;
	include('connect.txt'); //txt file with connection parameters

			try {
    			$dsn = "mysql:host=$server;dbname=$dbname;port=$port";
    			$opt = [
        			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        			PDO::ATTR_EMULATE_PREPARES   => false,
    			];
    			$pdo = new PDO($dsn, $user, $pass, $opt);
			} catch(PDOException $e) {
    			//echo 'DB Connection Failed: ' . $e->getMessage();
    			die();
			}


			$school_loc = "SELECT school_loc, school_lookup FROM schools WHERE school_id=".$_GET['school_id'];

			try {
    			$stmt = $pdo->prepare($school_loc);
    			$stmt->execute();
    			$results = $stmt->fetchAll();
			} catch (PDOException $e) {
    			//echo 'Error: ' . $e->getMessage();
    			$pdo->rollback();
    			die();
				}
			
			
			
		?><h1> <?php foreach ($results as $row) {
    					echo $row[school_loc];
    					break;
			} ?></h1><?php
			
			foreach ($results as $row) { ?>
				<iframe
 					width="600"
  					height="450"
  					frameborder="0" style="border:0"
  					src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDkLWQihTrfXtYM-hbyzy9nMKRtX6zWhZs
    				&q=<?php echo $row[school_lookup]; ?>" allowfullscreen>
				</iframe><?php

			}
	?>