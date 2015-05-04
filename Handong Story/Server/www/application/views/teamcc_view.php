<?php
	foreach($teamcc as $entry){
		echo "<label>{$entry->uid1} {$entry->uid2}</label><br>";
		echo "<label>{$entry->activity}</label><br>";
		echo "<label>{$entry->point}</label><br>";
	}
?>