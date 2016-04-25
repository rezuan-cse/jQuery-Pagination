<?php
	include("dbconfig.php");
	
	$results = $dbcon->prepare("SELECT COUNT(*) FROM tutorials");
	$results->execute();
	$get_total_rows = $results->fetch();
	
	//breaking total records into pages
	$pages = ceil($get_total_rows[0]/$item_per_page); 
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>jQuery Pagination using PHP PDO : Coding Cage</title>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>     
		
		<script type="text/javascript" src="js/jquery.bootpag.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#results").load("get_records.php");  //initial page number to load
				$(".paging_link").bootpag({
					total: <?php echo $pages; ?>
					}).on("page", function(e, num){
					e.preventDefault();
					$("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');
					$("#results").load("get_records.php", {'page':num});
				});
				
			});
		</script>
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
        
		
		<br />
		
		
		<div id="results"></div>
		
		<br />
		
		<div class="paging_link"></div>
		
	</body>
</html>