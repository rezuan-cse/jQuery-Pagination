<?php
	require_once 'dbconfig.php'; //include required dbconfig file
	
	//sanitize post value
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
		}else{
		$page_number = 1;
	}
	
	//get current starting point of records
	$position = (($page_number-1) * $item_per_page);
	
	$results = $dbcon->prepare("SELECT tutsTitle,tutsLink FROM tutorials ORDER BY tutsID DESC LIMIT $position, $item_per_page");
	$results->execute();
	
	//getting results from database
?>
<ul class="page_result">
	<?php
		while($row = $results->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<li>
			<a href="<?php echo $row['tutsLink']; ?>"><?php echo $row['tutsTitle']; ?></a>
		</li>
		<?php
		}
	?>
</ul>