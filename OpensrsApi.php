<?php

namespace techsterx\SlimOpensrs;

class OpensrsApi
{
	protected $app;

	public function __construct()
	{
		$this->app = \Slim\Slim::getInstance();
	}

	public function process($func, $data)
	{
		require_once dirname(__FILE__) . '/opensrs/openSRS_loader.php';

		$apiAdmin = $this->mailSuperAdmin();

		$data = array_merge(array(
			'admin_username' => $apiAdmin['username'],
			'admin_password' => $apiAdmin['password'],
			'admin_domain' => $apiAdmin['domain'],
		), $data);

		$callArray = array(
			'func' => $func,
			'data' => $data,
		);

		$osrs = processOpenSRS('json', json_encode($callArray));
		return json_decode($osrs->resultFormatted);
	}

	private function mailSuperAdmin($field = null)
	{
		$config = $this->app->config('opensrs.authentication');
		$info = $config['mail'];

		return $field === null || !array_key_exists($field, $info) ? $info : $info[$field];
	}
}
