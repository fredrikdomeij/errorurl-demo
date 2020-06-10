<?php

$baseurl_idp_root = "https://www.example.com";
require("config.php");

if (isset($_GET['source'])) {
	header("Content-type: text/plain");
}

$code = $_GET['code'];

if ($code == "ERRORURL_CODE") {

?>
<html>
<head>
<title>Login error support</title>
<body>
<h1>Login error support</h1>
Login failed at the service you tried to access. Please see below for possible reasons and actions.
<?php

foreach ($example_errors as $code => $definition) {
	if ($code == "DEFINITIONS") {
		continue;
	}
	if (preg_match('/[0-9]$/', $code)) {
		continue;
	}

?>
<h2><?= trim($example_errors[$code]['GENERIC_IDP_ERROR_HEADER']) ?></h2>
<?= trim(preg_replace('/^[ \t]*/m', '', $example_errors[$code]['GENERIC_IDP_ERROR_BODY'])) ?></a>
<?php

}

?>
</body>
</html>
<?php

} else {

?>
<html>
<head>
<title><?= trim($example_errors[$code]['GENERIC_IDP_ERROR_HEADER']) ?></title>
<body>
<h1><?= trim($example_errors[$code]['GENERIC_IDP_ERROR_HEADER']) ?></h2>
<?= trim(preg_replace('/^[ \t]*/m', '', $example_errors[$code]['GENERIC_IDP_ERROR_BODY'])) ?></a>
</body>
</html>
<?php

}

?>
