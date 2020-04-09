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

	'MISSING_ATTRIBUTES' => array(
		'ERRORURL_CODE' => 'MISSING_ATTRIBUTES',
		'GENERIC_ERROR_CAUSE' => "
			The SP did not receive one or more attributes or values it requires. The SP is obviously unaware of the
			reason for this.
			The user may have to request that the IdP releases more attributes (e.g. using attribute filters or entity
			categories) or ensure the values are released via consent.
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

		# MISSING_ATTRIBUTES (missing R&S) example
		'label' => 'missing R&amp;S',
		'SP_ERROR_HEADER' => "
			Missing attributes
			",
		// Maybe some wording on concent here?
		'SP_ERROR_BODY' => "
			<p>Your Institution did not deliver all required attributes during log in to the service.
			Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: http://refeds.org/category/research-and-scholarship
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "http://refeds.org/category/research-and-scholarship",
		),

	// GENERIC_ERROR_CAUSE, GENERIC_IDP_ERROR_HEADER and GENERIC_IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'MISSING_ATTRIBUTES2' => array(
		'ERRORURL_CODE' => 'MISSING_ATTRIBUTES',

		# MISSING_ATTRIBUTES (eduPersonScopedAffiliation) example
		'label' => 'eduPersonScopedAffiliation',
		'SP_ERROR_HEADER' => "
			Missing affiliation
			",
		'SP_ERROR_BODY' => "
			<p>This service requires an institutional affiliation value for access, however no such value was received
			from your Institution during login.
			Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you resolve this issue:
			<a href=\"%ERRORURL%\">%ERRORURL_WITHOUT_PARAMS%</a>.
			<p>Technical requirements: eduPersonScopedAffiliation
			",
		'ERRORURL_TID' => "error-6b9f541f-fc52-4366-85db-ce90974d1d6b",
		'ERRORURL_CTX' => "eduPersonScopedAffiliation http://www.geant.net/uri/dataprotection-code-of-conduct/v1 http://refeds.org/category/research-and-scholarship",
		),

	// GENERIC_ERROR_CAUSE, GENERIC_IDP_ERROR_HEADER and GENERIC_IDP_ERROR_BODY used from AUTHORIZATION_FAILURE above
	'MISSING_ATTRIBUTES3' => array(
		'ERRORURL_CODE' => 'MISSING_ATTRIBUTES',

		# MISSING_ATTRIBUTES (ORCID) example
		'label' => 'ORCID',
		'SP_ERROR_HEADER' => "
			Missing ORCID
			",
		'SP_ERROR_BODY' => "
			<p>This service requires ORCID to identify you, however no ORCID was received from your Institution during
			login.
			Please contact IT support or equivalent at your Institution for assistance.
			<p>Your Institution provided this link that may help you resolve this issue:
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
			factor).
			<p>Please try again. If you cannot resolve the issue yourself, please contact servicedesk at
			<a href=\"$baseurl_root/support\">$baseurl_root/support</a> and include the name of the service you tried to
			access, any error information given by the service and, if possible, a screenshot of the error message
			including the address bar at the top of the web browser.
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
			<p>Your Institution provided this link that may help you resolve this issue:
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
			<p>If you think you should have access, please contact servicedesk at
			<a href=\"$baseurl_root/support\">$baseurl_root/support</a> and include the name of the service you tried to
			access, any privileges that were noted as missing and, if possible, a screenshot of the error message
			including the address bar at the top of the web browser.
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
			<p>Your Institution provided this link that may help you resolve this issue:
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
			<p>Your Institution provided this link that may help you resolve this issue:
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
			<p>Your Institution provided this link that may help you resolve this issue:
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
			An error occurred when accessing the service
			<p>If you think you should be able to access the service, please contact servicedesk at
			<a href=\"$baseurl_root/support\">$baseurl_root/support</a> and include the name of the service you tried to
			access, any privileges that were noted as missing and, if possible, a screenshot of the error message
			including the address bar at the top of the web browser.
			",

		# OTHER_ERROR example
		'label' => '',
		'SP_ERROR_HEADER' => "
			An error has occurred
			",
		'SP_ERROR_BODY' => "
			<p>An error has occurred
			<p>Please contact IT support or equivalent at your institution for assistance.
			<p>Your Institution provided this link that may help you resolve this issue:
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
