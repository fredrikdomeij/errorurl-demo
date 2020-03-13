<?php

require("config.php");

$example_error = safe_get('example_error');

$title = $example_errors[$example_error]['ERRORURL_CODE'];
require("header.php");

$errorurl_from_metadata = "$baseurl/idp-errorurl.php?code=ERRORURL_CODE&ts=ERRORURL_TS&rp=ERRORURL_RP&tid=ERRORURL_TID&info=ERRORURL_INFO";

$errorurl_code = $example_errors[$example_error]['ERRORURL_CODE'];
$errorurl_ts   = date("c");
$errorurl_rp   = "$baseurl_root/shibboleth";
$errorurl_tid  = uniqid("error-");
$errorurl_info = $example_errors[$example_error]['ERRORURL_INFO'];

$errorurl_replaced = preg_replace(array(
		'/ERRORURL_CODE/',
		'/ERRORURL_TS/',
		'/ERRORURL_RP/',
		'/ERRORURL_TID/',
		'/ERRORURL_INFO/',
	), array(
		$errorurl_code,
		$errorurl_ts,
		$errorurl_rp,
		$errorurl_tid,
		$errorurl_info,
	), $errorurl_from_metadata);

$errorurl_replaced_encoded = preg_replace(array(
		'/ERRORURL_CODE/',
		'/ERRORURL_TS/',
		'/ERRORURL_RP/',
		'/ERRORURL_TID/',
		'/ERRORURL_INFO/',
	), array(
		$errorurl_code,
		urlencode($errorurl_ts),
		urlencode($errorurl_rp),
		urlencode($errorurl_tid),
		urlencode($errorurl_info),
	), $errorurl_from_metadata);

echo "<h3>SP with login errors supporting errorURL handling</h3>";
echo "<i>" . $example_errors[$errorurl_code]['SP_ERROR_CAUSE'] . "</i>";

echo "<div class=\"card mt-4\">";
echo "<div class=\"card-body bg-light\">";
echo "<h4>" . $example_errors[$errorurl_code]['SP_ERROR_HEADER'] . "</h4>";
echo preg_replace("/ERRORURL/", $errorurl_replaced_encoded, $example_errors[$example_error]['SP_ERROR_BODY']);

echo "</div>";
echo "</div>";

echo "<div class=\"card mt-4\">";
echo "  <div class=\"card-body bg-light\">";

echo "<pre>";
echo "&lt;md:IDPSSODescriptor errorURL=\"$errorurl_from_metadata\"&gt;";
echo "</pre>";

echo "    <div class=\"row\">";
echo "      <div class=\"col-3\">";
echo "errorURL from metadata";
echo "      </div>";
echo "      <div class=\"col-8\">";
echo "<pre>";
echo preg_replace("/([?&])/", "\n        \$1", $errorurl_from_metadata);
echo "</pre>";
echo "      </div>";
echo "    </div>";

echo "    <div class=\"row\">";
echo "      <div class=\"col-3\">";
echo "errorURL with tags replaced";
echo "      </div>";
echo "      <div class=\"col-8\">";
echo "<pre>";
echo preg_replace("/([?&])/", "\n        \$1", $errorurl_replaced);
echo "</pre>";
echo "      </div>";
echo "    </div>";

echo "    <div class=\"row\">";
echo "      <div class=\"col-3\">";
echo "URL-encoded errorURL";
echo "      </div>";
echo "      <div class=\"col-8\">";
echo "<pre>";
echo preg_replace("/([?&])/", "\n        \$1", $errorurl_replaced_encoded);
echo "</pre>";
echo "      </div>";
echo "    </div>";

echo "  </div>";
echo "</div>";

require("footer.php");

?>

