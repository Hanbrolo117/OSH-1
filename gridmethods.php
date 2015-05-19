<?php
	$currentfile = "IntroJava";

	$servername = "localhost";
	$username = "mrhilliker";
	$password = "trombone1";
	
	echo '<p>hello world</p>';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
		echo '<p>failed</p>';
		//die("Connection failed: " . mysqli_connect_error());
	}
	
	$query_str = "SELECT ID, HREF, TYPE FROM ".$currentfile;
	
	class GridItem{
		public $TYPE = "";
		public $ID = "";
		public $HREF = "";
		public function __construct($name,$link,$type){
			$this->TYPE = $type;
			$this->ID = $name;
			$this->HREF = $link;
		}
	}
	
	$gridObjects = array();
	
	$result = $conn->query($query_str);
	echo '<p>after query</p>';
	if ($result->num_rows > 0) {
		// output data of each row
		$i = 0;
		while($row = $result->fetch_assoc()) 
		{
			// process data from database
			 $gridObjects[$i] = new GridItem(row["ID"],row["HREF"],row["TYPE"]);
		}
		$result->free();
	} else {
		echo "0 results";
	}
	$conn->close();
	
	function populateGrid($tab)
	{
		echo '<p>'.$tab.'</p>';
		global $gridObjects;
		if (count($gridObjects) != 0){
			$num_cols = 3;
			$num_rows = count($gridObjects) / $num_cols;
			$num_remd = count($gridObjects) % $num_cols;
			$counter = 1;
			//populate all complete rows
			for($x=0; $x < $num_rows-1; $x++)
			{
				echo '<div style="width:75%; margin-left:auto; margin-right:auto;">
				<div class="row-fluid">';
				for($i=1; $i <= num_cols; $i++)
				{
					echo '<a href="#">';
					if($tab = $gridObjects[$counter].TYPE)
						echo '<div style="margin-bottom: 3%;" class="col-md-4"><div class="tab-item"><p>'.$gridObjects[$counter].'</p></div></div>';
					echo '</a>';
					$counter++;
				}
				echo '</div></div>';
			}
			//populate incomplete row
			echo '<div style="width:75%; margin-left:auto; margin-right:auto;">
				<div class="row-fluid">';
			for($i=1; $i <= num_remd; $i++)
			{
				echo '<a href="#">';
				
				echo '</a>';
				$counter++;
			}
			echo '</div></div>';
		}
	}
	
?>