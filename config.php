<?php

date_default_timezone_set("Europe/Stockholm");

$site_name = "errorURL demo site";

$baseurl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . (($_SERVER['SERVER_PORT'] == "80" || $_SERVER['SERVER_PORT'] == "443") ? "" : ":${_SERVER['SERVER_PORT']}") . preg_replace('/\/[^\/]*$/', "", $_SERVER['REQUEST_URI']);
$baseurl_root = preg_replace('/^(https?:\/\/[^\/]*).*/', '$1', $baseurl);

// Max width to make code readable at demo site
//                                                                                                                                   |
$example_errors = array(
	'DEFINITIONS' => array(
		'ERRORURL_CODE' => 'DEFINITIONS',
		'label' => '',
		'GENERIC_ERROR_CAUSE' => "
			The generic error detected in the application, possible causes and likely solutions (only for the errorURL
			test site).
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Header of error message displayed to the user at the IdP (defined by the proposal?)
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>Genereric error-specific information for the user at the IdP errorURL page and suggestions on how to
			resolved the issue.
			",

		'SP_ERROR_HEADER' => "
			Header of error message displayed to the user at the application
			",
		'SP_ERROR_BODY' => "
			<p>Application- and error-specific information for the user in the application and suggestions on how to
			resolved the issue, excluding the <a href=\"ERRORURL\">errorURL link</a>.
			",
		'ERRORURL_CTX' => "This is sent to the IdP from the service using the ERRORURL_CTX parameter to the errorURL",
		),

	'MISSING_ATTRIBUTES' => array(
		'ERRORURL_CODE' => 'MISSING_ATTRIBUTES',
		'label' => 'eduPersonPrincipalName',
		'GENERIC_ERROR_CAUSE' => "
			The SP did not receive one or more attributes or values it requires. The SP is obviously unaware of the reason for this.
			The user may have to add more attributes at the IdP (e.g. date of birth, ORCID) or request that the IdP releases more attributes (e.g. using attribute filters, entity categories, consent).
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Missing attributes
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>The service that you tried to access did not get all required attributes.
			<p>Please contact servicedesk at <a href=\"$baseurl_root/support\">$baseurl_root/support</a>
			and include the name of the service you tried to access, any attributes if you know what
			they are (the service may have informed you) and, if possible, a screenshot of the error message
			including the address bar at the top of the web browser.
			",

		'SP_ERROR_HEADER' => "
			Missing user identity
			",
		'SP_ERROR_BODY' => "
			<p>No suitable identity was sent when you logged in to the application.
			Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you resolve this issue: <a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical information: eduPersonPrincipalName (ePPN) missing
			",
		'ERRORURL_CTX' => "eduPersonPrincipalName attribute missing",
		),

	// GENERIC_ERROR_CAUSE, GENERIC_IDP_ERROR_HEADER and GENERIC_IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'MISSING_ATTRIBUTES2' => array(
		'ERRORURL_CODE' => 'MISSING_ATTRIBUTES',
		'label' => 'eduPersonAffiliation',

		'SP_ERROR_HEADER' => "
			Missing affiliation
			",
		'SP_ERROR_BODY' => "
			<p>No affiliation was sent when you logged in to the application.
			Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you resolve this issue: <a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical information: eduPersonAffiliation missing
			",
		'ERRORURL_CTX' => "eduPersonAffiliation attribute missing",
		),


	'AUTHENTICATION_FAILURE' => array(
		'ERRORURL_CODE' => 'AUTHENTICATION_FAILURE',
		'label' => '',
		'GENERIC_ERROR_CAUSE' => "
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			",
		'GENERIC_IDP_ERROR_BODY' => "
			",

		'SP_ERROR_HEADER' => "
			",
		'SP_ERROR_BODY' => "
			",
		'ERRORURL_CTX' => "Authentication failed",
		),

	'AUTHORIZATION_FAILURE' => array(
		'ERRORURL_CODE' => 'AUTHORIZATION_FAILURE',
		'label' => 'assurance',
		'GENERIC_ERROR_CAUSE' => "
			The service requires authorization information from the IdP, authorization was missing or too low
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Authorization failure
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>Please contact servicedesk at <a href=\"$baseurl_root/support\">$baseurl_root/support</a>
			and include the name of the service you tried to login to, any authorization that is known missing
			and, if possible, a screenshot of the error message including the address bar
			at the top of the web browser.
			",

		'SP_ERROR_HEADER' => "
			Access denied
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, a confirmed identity is required.
			Your identity at your login service appears to be unconfirmed.
			<p>Please contact IT support or equivalent at your Institution for assistance.
			<p>Technical information: REFEDS Assurance Framework (RAF) medium or higher required
			<p>Your Institution provided this link that may help you resolve this issue: <a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			",
		'ERRORURL_CTX' => "RAF medium or higher required, got RAF low",
		),

	// GENERIC_ERROR_CAUSE, GENERIC_IDP_ERROR_HEADER and GENERIC_IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'AUTHORIZATION_FAILURE2' => array(
		'ERRORURL_CODE' => 'AUTHORIZATION_FAILURE',
		'label' => 'affiliation',

		'SP_ERROR_HEADER' => "
			Access denied
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, you must be a student.
			The login information sent by your login service did not include a student affiliation.
			<p>Please contact IT support or equivalent at your institution for assistance.
			<p>Your IdP provided <a href=\"ERRORURL\">this link</a> for information on how to resolve this issue.
			",
		'ERRORURL_CTX' => "eduPersonAffiliation student required",
		),

	'GENERIC_ERROR' => array(
		'ERRORURL_CODE' => 'GENERIC_ERROR',
		'label' => '',
		'GENERIC_ERROR_CAUSE' => "
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			",
		'GENERIC_IDP_ERROR_BODY' => "
			",

		'SP_ERROR_HEADER' => "
			",
		'SP_ERROR_BODY' => "
			",
		'ERRORURL_CTX' => "Some generic error, referer to the IdP support page",
		),

	);

function safe_get($param)
{
	return (isset($_GET[$param]) ? htmlentities($_GET[$param], ENT_QUOTES) : "");
}

?>
