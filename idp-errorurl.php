<?php

require("config.php");

$errorurl_code = safe_get('code');
$errorurl_ts   = safe_get('ts');
$errorurl_rp   = safe_get('rp');
$errorurl_tid  = safe_get('tid');
$errorurl_info = safe_get('info');

$title = "Application error: $errorurl_code";
require("header.php");

echo "<h2>IdP errorURL help pages</h2>";
echo "<i>" . $errorurl_codes[$errorurl_code]['SP_ERROR_CAUSE'] . "</i>";

echo "<div class=\"card mt-4\">";
echo "<div class=\"card-body bg-light\">";
echo "<h4>" . $errorurl_codes[$errorurl_code]['IDP_ERROR_HEADER'] . "</h4>";
echo $errorurl_codes[$errorurl_code]['IDP_ERROR_BODY'];

echo "</div>";
echo "</div>";

echo "<div class=\"card mt-4\">";
echo "<div class=\"card-body bg-light\">";
echo "<pre>";
echo "ts:   $errorurl_ts\n";
echo "rp:   $errorurl_rp\n";
echo "tid:  $errorurl_tid\n";
echo "info: $errorurl_info\n";
echo "</pre>";
echo "</div>";
echo "</div>";

require("footer.php");

?>

