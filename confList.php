<?php
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

			$select_schools = "SELECT * FROM conference";


			try {
    			$stmt = $pdo->prepare($select_schools);
    			$stmt->execute();
    			$results = $stmt->fetchAll();
			} catch (PDOException $e) {
    			//echo 'Error: ' . $e->getMessage();
    			$pdo->rollback();
    			die();
				}
			
		?><p>	<?php foreach ($results as $row) { ?> <a href="index.php?page=conference&conf_id=<?php echo $row[conf_id]; ?>"><?php
    					echo $row[conf_name];
			}
			//close the connections
			$pdo = null;
			$stmt = null;
			
			?>
		<a href="index.php">Home</a>
        </p>