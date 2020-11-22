<?php

date_default_timezone_set("Europe/Stockholm");

$site_name = "errorURL demo site";

$baseurl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . (($_SERVER['SERVER_PORT'] == "80" || $_SERVER['SERVER_PORT'] == "443") ? "" : ":${_SERVER['SERVER_PORT']}") . preg_replace('/\/[^\/]*$/', "", $_SERVER['REQUEST_URI']);
$baseurl_root = preg_replace('/^(https?:\/\/[^\/]*).*/', '$1', $baseurl);

$baseurl_idp = preg_replace('/errorurl-sp-demo/', 'errorurl-idp-demo', $baseurl);
if (!isset($baseurl_idp_root)) {
	$baseurl_idp_root = preg_replace('/errorurl-sp-demo/', 'errorurl-idp-demo', $baseurl_root);
}

$baseurl_sp = preg_replace('/errorurl-idp-demo/', 'errorurl-sp-demo', $baseurl);
$baseurl_sp_root = preg_replace('/errorurl-idp-demo/', 'errorurl-sp-demo', $baseurl_root);

// Max width to make code readable at demo site
//                                                                                                                                   |
$example_errors = array(
	'DEFINITIONS' => array(
		'ERRORURL_CODE' => 'DEFINITIONS',
		'GENERIC_ERROR_CAUSE' => "
			The generic error detected in the service, possible causes and likely solutions. Target audience: SP and
			IdP administrators
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Header of error message displayed to the user at the IdP. Target audience: user
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>Genereric error-specific information for the user at the IdP errorURL page and suggestions on how to
			resolve the issue. Target audience: user
			",

		# DEFINITIONS example
		'label' => '',
		'SP_ERROR_HEADER' => "
			Header of error message displayed to the user at the service. Target audience: user
			",
		'SP_ERROR_BODY' => "
			<p>Service- and error-specific information for the user in the service and suggestions on how to
			resolve the issue, including the errorURL link: <a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>. Target
			audience: user
			",
		'ERRORURL_TID' => "This is sent to the IdP from the service using the ERRORURL_TID parameter to the errorURL. Target
		audience: SP administrators (via IdP administrators)",
		'ERRORURL_CTX' => "This is sent to the IdP from the service using the ERRORURL_CTX parameter to the errorURL. Target
		audience: IdP administrators",
		),

	'IDENTIFICATION_FAILURE' => array(
		'ERRORURL_CODE' => 'IDENTIFICATION_FAILURE',
		'GENERIC_ERROR_CAUSE' => "
			The SP did not receive one or more attributes or values it requires for basic identification and/or
			personalization purposes. This typically applies to unique identifiers, name, and email address attributes
			that are common to federated interactions.
			The SP is most likely unaware of the reason the information was not supplied. The user may have to request
			that the IdP release more attributes (e.g. using attribute filters, entity categories), or ensure the values
			are released via his or her own consent.
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Identification failed
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>The service that you tried to access did not get all required attributes for identification and/or
			personalization.
			<p>This may be because your institution are missing those attributes or that your institution is not
			configured to release those attributes to the service you tried to access.
			<p>Please contact the IT Service Desk of Blue Star University at <a href=\"$baseurl_idp_root/support\">$baseurl_idp_root/support</a>
			and include the name of the service you tried to access, any missing attributes if you know what
			they are (the service may have informed you) and, if possible, a screenshot of the error message
			at the service including the address bar at the top of the web browser.
			",

		# IDENTIFICATION_FAILURE (missing R&S) example
		'label' => 'missing eduPersonPrincipalName',
		'SP_ERROR_HEADER' => "
			Missing attributes
			",
		// Maybe some wording on concent here?
		'SP_ERROR_BODY' => "
			<p>Your Institution did not deliver all required attributes during log in to the service.
			Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you to resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: eduPersonPrincipalName
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "eduPersonPrincipalName http://www.geant.net/uri/dataprotection-code-of-conduct/v1 http://refeds.org/category/research-and-scholarship",
		),

	// GENERIC_ERROR_CAUSE, GENERIC_IDP_ERROR_HEADER and GENERIC_IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'IDENTIFICATION_FAILURE2' => array(
		'ERRORURL_CODE' => 'IDENTIFICATION_FAILURE',

		# IDENTIFICATION_FAILURE (ORCID) example
		'label' => 'ORCID',
		'SP_ERROR_HEADER' => "
			Missing ORCID
			",
		'SP_ERROR_BODY' => "
			<p>This service requires ORCID to identify you, however no ORCID was received from your Institution during
			login.
			Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you to resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: eduPersonOrcid
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "eduPersonOrcid http://www.geant.net/uri/dataprotection-code-of-conduct/v1",
		),

	'AUTHENTICATION_FAILURE' => array(
		'ERRORURL_CODE' => 'AUTHENTICATION_FAILURE',
		'GENERIC_ERROR_CAUSE' => "
			<p>The user’s authentication \"quality\", or some other provided characteristic (time, location), was
			insufficient for access. \"Quality\" maps to varying constructs in different protocols (e.g., to SAML’s
			<saml:AuthnContext> element, and to OIDC’s \"acr\" claim).
			<p>This error most commonly applies to SPs that request specific authentication context(s) from an IdP and
			this code may be used to refer the user back to the IdP when the request could not be satisfied but the SP
			has no other recourse.
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Authentication error
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>The service you tried to access failed during the authentication stage
			<p>This may be because it requires additional steps which did not occur during login (such as using a second 
			factor). Please try again.
			<p>If you cannot resolve the issue yourself, please contact IT Service Desk of Blue Star University at
			<a href=\"$baseurl_idp_root/support\">$baseurl_idp_root/support</a> and include the name of the service you tried to
			access, any error information given by the service and, if possible, a screenshot of the error message
			at the service including the address bar at the top of the web browser.
			",
		# AUTHENTICATION_FAILURE example
		'label' => 'requested MFA failed',
		'SP_ERROR_HEADER' => "
			Multi-Factor Authentication failed
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, Multi-Factor Authentication is required. The requested Multi-Factor Authenticaton
			failed. It might help to restart your web browser and try again.
			<p>If you cannot resolve the issue yourself, please contact IT support or equivalent at your Institution for
			assistance.
			<p>Your Institution provided this link that may help you to resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: https://refeds.org/profile/mfa
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "https://refeds.org/profile/mfa",
		),

	'AUTHORIZATION_FAILURE' => array(
		'ERRORURL_CODE' => 'AUTHORIZATION_FAILURE',
		'GENERIC_ERROR_CAUSE' => "
			The user is not authorized to access the SP. This may be caused by an inadequate assurance level (when
			expressed independently of authentication), entitlements, affiliation or missing attribute or value but this
			code SHOULD NOT be used by SPs that manage authorization locally, over which the IdP would have no control.
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Insufficient privileges
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>The service that you tried to access requires privileges that you do not have.
			<p>Typical requirements include:<br>
			<p><b>A <i>confirmed</i> identity, or \"high\" <i>identity assurance level</i> (AL)</b><br>
			To confirm your identity, you need to visit IT Service Desk and identify yourself using your national ID card or
			passport.<br>

			<p><b>Affiliation</b><br>
			Your <i>affiliation</i> describes your relationship with the Blue Star University. The set of attributes include
			for example <i>student</i> and <i>employee</i>. If you are a student and the service you tried to access did
			not receive the <i>student</i> affiliation, please contact IT Service Desk to correct this.

			<p><b>Some specific entitlements</b><br>
			Entitlements are specific privileges at specific services. If you are missing entitlements that you think you
			should have (e.g. you should be able to access this service), please contact IT Service Desk to have this sorted out.

			<p>If you think you should have access, please contact IT Service Desk of Blue Star University at
			<a href=\"$baseurl_idp_root/support\">$baseurl_idp_root/support</a> and include the name of the service you tried to
			access, any privileges that were noted as missing and, if possible, a screenshot of the error message
			at the service including the address bar at the top of the web browser.
			",

		# AUTHORIZATION_FAILURE (RAF assurance) example
		'label' => 'RAF assurance',
		'SP_ERROR_HEADER' => "
			Confirmed identity required
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, a confirmed identity is required.
			Your identity at your Institution appears to require additional confirmation steps.
			<p>Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you to resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: eduPersonAssurance>=https://refeds.org/assurance/IAP/medium
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "eduPersonAssurance>=https://refeds.org/assurance/IAP/medium",
		),

	// GENERIC_ERROR_CAUSE, GENERIC_IDP_ERROR_HEADER and GENERIC_IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'AUTHORIZATION_FAILURE2' => array(
		'ERRORURL_CODE' => 'AUTHORIZATION_FAILURE',

		# AUTHORIZATION_FAILURE (affiliation) example
		'label' => 'affiliation',
		'SP_ERROR_HEADER' => "
			Insufficient privileges
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, you must be a student.
			The login information sent by your Institution did not include a student affiliation.
			<p>Please contact IT support or equivalent at your institution for assistance.
			<p>Your Institution provided this link that may help you to resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: eduPersonAffiliation=student
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "eduPersonAffiliation=student",
		),

	// GENERIC_ERROR_CAUSE, GENERIC_IDP_ERROR_HEADER and GENERIC_IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'AUTHORIZATION_FAILURE3' => array(
		'ERRORURL_CODE' => 'AUTHORIZATION_FAILURE',

		# AUTHORIZATION_FAILURE (entitlement) example
		'label' => 'entitlement',
		'SP_ERROR_HEADER' => "
			Insufficient privileges
			",
		'SP_ERROR_BODY' => "
			<p>To access this service, your account must have relevant entitlement.
			The login information sent by your Institution did not include the correct entitlement.
			<p>Please contact IT support or equivalent at your institution for assistance.
			<p>Your Institution provided this link that may help you to resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: eduPersonEntitlement=urn:mace:dir:entitlement:common-lib-terms
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "eduPersonEntitlement=urn:mace:dir:entitlement:common-lib-terms",
		),

	'OTHER_ERROR' => array(
		'ERRORURL_CODE' => 'OTHER_ERROR',
		'GENERIC_ERROR_CAUSE' => "
			This error code should only be used when the other defined codes are not appropriate but the SP has evidence
			that the condition could be remedied by the end-user or IdP organization with relatively minimal further
			involvement by the SP.
			",
		'GENERIC_IDP_ERROR_HEADER' => "
			Access error
			",
		'GENERIC_IDP_ERROR_BODY' => "
			<p>An error occurred when accessing the service
			<p>If you think you should be able to access the service, please contact IT Service Desk of Blue Star University at
			<a href=\"$baseurl_idp_root/support\">$baseurl_idp_root/support</a> and include the name of the service you tried to
			access, any privileges that were noted as missing and, if possible, a screenshot of the error message
			at the service including the address bar at the top of the web browser.
			",

		# OTHER_ERROR example
		'label' => '',
		'SP_ERROR_HEADER' => "
			An error has occurred
			",
		'SP_ERROR_BODY' => "
			<p>An error has occurred
			<p>Please contact IT support or equivalent at your institution for assistance.
			<p>Your Institution provided this link that may help you to resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "An error occurred",
		),

	);

function safe_get($param)
{
	return (isset($_GET[$param]) ? htmlentities($_GET[$param], ENT_QUOTES) : "");
}

?>
