<?php

require("config.php");

$title = $site_name;
require("header.php");

echo "<h3>$title</h3>";
echo "Simulate errors:\n";
echo "<ul>\n";
foreach ($errorurl_codes as $errorurl_code => $values) {
	echo "<li><a href=\"$baseurl/sp-error.php?errorurl_code=$errorurl_code\">$errorurl_code</a> (${values['status']})</li>\n";
}

echo "</ul>";
require("footer.php");

?>
