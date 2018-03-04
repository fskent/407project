
<html>
<head>
<title>CROWD source</title>

<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
	<?php
		include("header.php");
		if (!isset($_GET['page'])){
			?><div class="homepage">
				
			</div>
			<?php
		}
	?>
    <div class="maincontent">
		<?php
			if (!isset($_GET['page'])){
				?><p>WELCOME to the Home Page</p><?php
			} else {
				$page=$_GET['page'];
				include("$page.php");
			}
		?>
	</div>
	<div class="footer"></div>
</div><!-- Container ends here-->
</body>
</html>