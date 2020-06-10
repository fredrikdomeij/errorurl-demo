<?php

require("config.php");

$title = $site_name;
$show_headerlinks = 1;
require("header.php");

echo "<h3>$title</h3>";
echo "Simulate errors:\n";
echo "<ul>\n";
foreach ($example_errors as $example_error => $values) {
	echo "<li><a href=\"$baseurl_sp/sp-error.php?example_error=$example_error\">${values['ERRORURL_CODE']}</a>" . (($values['label']) ? " (${values['label']})" : "" ) . "</li>\n";
}

echo "</ul>";
$show_source = 1;
require("footer.php");

?>
