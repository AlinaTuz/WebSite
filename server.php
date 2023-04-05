<?php
	echo '<table>';
	echo '<tr><td class="l">Index</td><td class="r">Value</td>';
	foreach ($_SERVER as $param => $value) {
		if (isset($_SERVER[$param])) 
		{
			echo '<tr><td class="l">'.$param.'</td><td class="r">'.$value.'</td></>';
		}
	}
	foreach ($_GET as $param => $value) {
		if (isset($_GET[$param])) 
		{
			echo '<tr><td class="l">'.$param.'</td><td class="r">'.$value.'</td></>';
		}
	}
	foreach ($_POST as $param => $value) {
		if (isset($_POST[$param])) 
		{
			echo '<tr><td class="l">'.$param.'</td><td class="r">'.$value.'</td></>';
		}
	}
	echo '</table>';
?>