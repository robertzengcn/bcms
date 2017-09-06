<?php
interface AuthTokenInterface
{
	public function authApiToken($method, $time, $token, &$msg = '');
	
	public function authUserToken($user_token, &$msg = '');
	
	public function ssoLogin($user_name, $time, $sso_token, &$msg = '');
	
	public function userLogin($username, $password, $time, &$msg = '');
}