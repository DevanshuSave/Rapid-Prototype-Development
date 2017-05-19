<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/html" href="./mycss1.css" />
	<title>Calculator</title>
</head>
<body>
	<?php
		$x = $_GET['num1'];
		$y = $_GET['num2'];
		$result = 0;
		if ($_GET['operator']=='add')
			$result = add($x, $y);
		else if ($_GET['operator']=='sub')
			$result = add($x, -1* $y);
		else if($_GET['operator']=='mul')
			$result = mul($x, $y);
		else if($_GET['operator']=='div' and $y !=0)
			$result = mul($x, 1/$y);
		else {
			$result = "N/A";
			echo "Divide by zero error. ";
		}
		function add($x, $y){
			return $x + $y;
		}
		function mul($x, $y) {
			return $x * $y;
		}
		echo "The result is $result";
	?>
	<br>
	<a href="calc.html">Go back to calculator</a>
</body>
</html>