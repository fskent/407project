<?php 
	//sends back to home page if no ID
	if (!isset($_GET['conf_id'])){
		header("Locations:index.php");
	}

	
	
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


			$schools="SELECT schools.school_id, schools.school_name, schools.school_mascot, conference.conf_name 
			FROM schools JOIN conference ON schools.conf_id=conference.conf_id WHERE schools.conf_id=".$_GET["conf_id"];

			try {
    			$stmt = $pdo->prepare($schools);
    			$stmt->execute();
    			$results = $stmt->fetchAll();
			} catch (PDOException $e) {
    			//echo 'Error: ' . $e->getMessage();
    			$pdo->rollback();
    			die();
				}
			
			
			
		?><h1> <?php foreach ($results as $row) {
    					echo $row[conf_name];
    					break;
			} ?></h1><?php
			
			foreach ($results as $row) { ?>
						<div class="school">
						<a href="index.php?page=school&school_id=<?php echo $row[school_id]; ?>"<p>
						<?php echo $row[school_name];?>  
						<?php echo $row[school_mascot];?></p></a>
						
						
    					</div>
    					<?php
			}
	
?>