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

echo "Example IdP support pages:";
echo "<ul>";

foreach ($example_errors as $example_error => $values) {
	if ($example_error == "DEFINITIONS") {
		$example_error = "ERRORURL_CODE";
	}
	if (preg_match('/[0-9]$/', $example_error)) {
		continue;
	}

	echo "<li><a href=\"idp-support-example.php?code=$example_error\">$example_error.html</a> (<a href=\"idp-support-example.php?code=$example_error&source=true\">source</a>)</li>";
}

echo "</ul>";

$show_source = 1;
require("footer.php");

?>
