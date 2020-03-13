<?php

date_default_timezone_set("Europe/Stockholm");

$site_name = "errorURL demo site";

$baseurl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . (($_SERVER['SERVER_PORT'] == "80" || $_SERVER['SERVER_PORT'] == "443") ? "" : ":${_SERVER['SERVER_PORT']}") . preg_replace('/\/[^\/]*$/', "", $_SERVER['REQUEST_URI']);
$baseurl_root = preg_replace('/^(https?:\/\/[^\/]*).*/', '$1', $baseurl);

//																     |
$example_errors = array(
	'DEFINITIONS' => array(
		'ERRORURL_CODE' => 'DEFINITIONS',
		'label' => 'DEFINITIONS',
		'status' => "definitions only, not reviewed",
		'ERRORURL_INFO' => "This is sent to the IdP from the service using the ERRORURL_INFO parameter to the errorURL",
		'SP_ERROR_CAUSE' => "
			The generic error detected in the application, possible causes and likely solutions (only for the errorURL
			test site).
			",
		'SP_ERROR_HEADER' => "
			Header of error message displayed to the user at the application
			",
		'SP_ERROR_BODY' => "
			<p>Application- and error-specific information for the user in the application and suggestions on how to
			resolved the issue, excluding the <a href=\"ERRORURL\">errorURL link</a>.
			",
		'IDP_ERROR_HEADER' => "
			Header of error message displayed to the user at the IdP (defined by the proposal?)
			",
		'IDP_ERROR_BODY' => "
			<p>Genereric error-specific information for the user at the IdP errorURL page and suggestions on how to
			resolved the issue.
			",
		),

	'MISSING_ATTRIBUTES' => array(
		'ERRORURL_CODE' => 'MISSING_ATTRIBUTES',
		'label' => 'MISSING_ATTRIBUTES',
		'status' => "not reviewed",
		'ERRORURL_INFO' => "eduPersonPrincipalName attribute missing",
		'SP_ERROR_CAUSE' => "
			The IdP sent too few attributes to the SP,
			the user must add more attributes at the IdP or make the IdP release more attributes.
			",
		'SP_ERROR_HEADER' => "
			Your identity provider did not send an identity
			",
		'SP_ERROR_BODY' => "
			<p>No identity was sent when you logged in to the application.
			Please contact IT support or equivalent at your institution for assistance.
			<p>Technical information: eduPersonPrincipalName (eppn) missing
			<p>Your IdP provided <a href=\"ERRORURL\">this link</a> for information on how to resolve this issue.
			",
		'IDP_ERROR_HEADER' => "
			Missing attributes
			",
		'IDP_ERROR_BODY' => "
			<p>Please contact servicedesk at <a href=\"$baseurl_root/support\">$baseurl_root/support</a>
			and include the name of the service you tried to login to, any attributes if you know what
			is missing and, if possible, a screenshot of the error message including the address bar
			at the top of the web browser.
			",
		),

	'AUTHENTICATION_FAILURE' => array(
		'ERRORURL_CODE' => 'AUTHENTICATION_FAILURE',
		'label' => 'AUTHENTICATION_FAILURE',
		'status' => "incomplete",
		'ERRORURL_INFO' => "Authentication failed",
		'SP_ERROR_CAUSE' => "
			",
		'SP_ERROR_HEADER' => "
			",
		'SP_ERROR_BODY' => "
			",
		'IDP_ERROR_HEADER' => "
			",
		'IDP_ERROR_BODY' => "
			",
		),

	'AUTHORIZATION_FAILURE' => array(
		'ERRORURL_CODE' => 'AUTHORIZATION_FAILURE',
		'label' => 'AUTHORIZATION_FAILURE (assurance)',
		'status' => "not reviewed",
		'ERRORURL_INFO' => "RAF medium or higher required, got RAF low",
		'SP_ERROR_CAUSE' => "
			The service requires authorization information from the IdP, authorization was missing or too low
			",
		'SP_ERROR_HEADER' => "
			Access denied
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, a confirmed identity is required.
			Your identity at your login service appears to be unconfirmed.
			<p>Please contact IT support or equivalent at your institution for assistance.
			<p>Technical information: REFEDS Assurance Framework (RAF) medium or higher required
			<p>Your IdP provided <a href=\"ERRORURL\">this link</a> for information on how to resolve this issue.
			",
		'IDP_ERROR_HEADER' => "
			Authorization failure
			",
		'IDP_ERROR_BODY' => "
			<p>Please contact servicedesk at <a href=\"$baseurl_root/support\">$baseurl_root/support</a>
			and include the name of the service you tried to login to, any authorization that is known missing
			and, if possible, a screenshot of the error message including the address bar
			at the top of the web browser.
			",
		),

	// SP_ERROR_CAUSE, IDP_ERROR_HEADER and IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'AUTHORIZATION_FAILURE2' => array(
		'ERRORURL_CODE' => 'AUTHORIZATION_FAILURE',
		'label' => 'AUTHORIZATION_FAILURE (affiliation)',
		'status' => "not reviewed",
		'ERRORURL_INFO' => "eduPersonAffiliation student required",
		'SP_ERROR_HEADER' => "
			Access denied
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, you must be a student.
			The login information sent by your login service did not include a student affiliation.
			<p>Please contact IT support or equivalent at your institution for assistance.
			<p>Your IdP provided <a href=\"ERRORURL\">this link</a> for information on how to resolve this issue.
			",
		),

	'NO_AUTHN_CONTEXT' => array(
		'ERRORURL_CODE' => 'NO_AUTHN_CONTEXT',
		'label' => 'NO_AUTHN_CONTEXT',
		'status' => "incomplete",
		'ERRORURL_INFO' => "Bad authentications context class",
		'SP_ERROR_CAUSE' => "
			",
		'SP_ERROR_HEADER' => "
			",
		'SP_ERROR_BODY' => "
			",
		'IDP_ERROR_HEADER' => "
			",
		'IDP_ERROR_BODY' => "
			",
		),

	'GENERIC' => array(
		'ERRORURL_CODE' => 'GENERIC',
		'label' => 'GENERIC',
		'status' => "incomplete",
		'ERRORURL_INFO' => "Some generic error, referer to the IdP support page",
		'SP_ERROR_CAUSE' => "
			",
		'SP_ERROR_HEADER' => "
			",
		'SP_ERROR_BODY' => "
			",
		'IDP_ERROR_HEADER' => "
			",
		'IDP_ERROR_BODY' => "
			",
		),

	);

function safe_get($param)
{
	return (isset($_GET[$param]) ? htmlentities($_GET[$param], ENT_QUOTES) : "");
}

?>
