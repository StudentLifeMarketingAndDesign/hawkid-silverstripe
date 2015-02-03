<?php
/**
 * LDAP authenticator for silverstripe-ssp
 * @package silverstripe-ssp
 * @author Anton Smith <anton.smith@op.ac.nz>
 */
class UICasAuthenticator extends SSPAuthenticator {

	/**
	 * Provide custom Silverstripe authentication logic for a SimpleSAMLphp authentication source
	 * to authenticate a user
	 */
	public function authenticate() {
		$attributes = $this->getAttributes();

		$hawkid = $attributes['hawkid'][0];

		$member = Member::get()->filter('Username', $hawkid)->First();

		//If the member does not exist in Silverstripe, create them
		if (!$member) {
			$member = new Member();
			$member->Username = $attributes['hawkid'][0];
			$member->write();
		}

		return $member;
	}
}