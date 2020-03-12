<?php

require("config.php");

$errorurl_code = safe_get('errorurl_code');

$title = "Application error: $errorurl_code";
require("header.php");

$errorurl_from_metadata = "$baseurl/idp-errorurl.php?code=ERRORURL_CODE&ts=ERRORURL_TS&rp=ERRORURL_RP&tid=ERRORURL_TID&info=ERRORURL_INFO";

$errorurl_ts   = date("c");
$errorurl_rp   = "$baseurl_root/shibboleth";
$errorurl_tid  = uniqid("error-");
$errorurl_info = $errorurl_codes[$errorurl_code]['ERRORURL_INFO'];

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

echo "<h3>SP with login errors supporting errurUrl handling</h3>";
echo "<i>" . $errorurl_codes[$errorurl_code]['SP_ERROR_CAUSE'] . "</i>";

echo "<div class=\"card mt-4\">";
echo "<div class=\"card-body bg-light\">";
echo "<h4>" . $errorurl_codes[$errorurl_code]['SP_ERROR_HEADER'] . "</h4>";
echo preg_replace("/ERRORURL/", $errorurl_replaced_encoded, $errorurl_codes[$errorurl_code]['SP_ERROR_BODY']);

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

