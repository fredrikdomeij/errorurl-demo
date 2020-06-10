<?php

require("config.php");

$errorurl_code = safe_get('code');
$errorurl_ts   = safe_get('ts');
$errorurl_rp   = safe_get('rp');
$errorurl_tid  = safe_get('tid');
$errorurl_ctx  = safe_get('ctx');

$title = "Application error: $errorurl_code";
$show_headerlinks = 1;
require("header.php");

echo "<h2>IdP errorURL help pages</h2>";
echo "<i>" . $example_errors[$errorurl_code]['GENERIC_ERROR_CAUSE'] . "</i>";

echo "<div class=\"card mt-4\">";
echo "<i>Information to the end user at the errorURL site</i><br>";
echo "<div class=\"card-body bg-light\">";
echo "<img class=\"mb-4\" src=\"blue-star-university.png\">";
echo "<h4>" . $example_errors[$errorurl_code]['GENERIC_IDP_ERROR_HEADER'] . "</h4>";
echo $example_errors[$errorurl_code]['GENERIC_IDP_ERROR_BODY'];

echo "</div>";
echo "</div>";

echo "<div class=\"card mt-4\">";
echo "<i>Optional parameters included in the errorURL</i><br>";
echo "<div class=\"card-body bg-light\">";
echo "<pre>";
echo "ts:  $errorurl_ts\n";
echo "rp:  $errorurl_rp\n";
echo "tid: $errorurl_tid\n";
echo "ctx: $errorurl_ctx\n";
echo "</pre>";
echo "</div>";
echo "</div>";

$show_source = 1;
require("footer.php");

?>

