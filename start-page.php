<?php

require("demo/config.php");

$title = $site_name;
require("demo/header.php");

echo "<h3>$title</h3>";

?>
<p>
This site provides example usage of the conventions regarding the errorURL SAML metadata attribute defined by the <a href="https://refeds.org/specifications/saml-v2-0-metadata-deployment-profile-for-errorurl-version-1-0">SAML V2.0 Metadata Deployment Profile for errorURL Version 1.0</a>. The errors defined in the profile are simulated and the placeholders are replaced in the IdPs errorURL to simulate the use cases of the profile. Unless federated login is performed, an example errorURL from a dummy IdP is used.
<p>
The REFEDS working group notes are available at <a href="https://wiki.refeds.org/display/GROUPS/Best+Practice+around+Error+Handling">Best Practice around Error Handling</a> at the REFEDS Wiki.
<p>
The demo site can be accessed using the following methods:
<ul>
  <li><a href="demo/">Demo login</a> (using dummy IdP from "Blue Star University")</li>
  <li><a href="/Shibboleth.sso/DS/seamless-access?target=/secure/">SeamlessAccess</a></li>
  <li><a href="/Shibboleth.sso/DS/nordu.net?target=/secure/">SWAMID</a></li>
  <li><a href="/Shibboleth.sso/DS/swamid-test?target=/secure/">SWAMID Testing</a></li>
</ul>
<?php

require("demo/footer.php");

?>
