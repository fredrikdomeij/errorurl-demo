<?php

require("config.php");

$title = $site_name;
require("header.php");

echo "<h3>$title</h3>";
echo "Simulate errors:\n";
echo "<ul>\n";
foreach ($example_errors as $example_error => $values) {
	echo "<li><a href=\"$baseurl/sp-error.php?example_error=$example_error\">${values['label']}</a> (${values['status']})</li>\n";
}

echo "</ul>";
require("footer.php");

?>
