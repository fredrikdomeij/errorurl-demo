<?php

echo "<div class=\"card mt-4\">";
echo "<div class=\"card-body bg-light\">";
foreach (array($_SERVER['SCRIPT_FILENAME'], "config.php", "header.php", "footer.php") as $value) {
	$value_basename = basename($value);
	$value_id = preg_replace("/\./", "", $value_basename);
	echo "<h4><button class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#$value_id\" aria-expanded=\"true\" aria-controls=\"$value_id\">$value_basename</button></h4>";
	echo "<div class=\"collapse multi-collapse\" id=\"$value_id\">";
	echo "<div class=\"card card-body\">";
	show_source($value);
	echo "</div>";
	echo "</div>";
}
echo "</div>";
echo "</div>";

?>
</div>
</body>
</html>
