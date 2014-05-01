<?php

namespace techsterx\SlimOpensrs\API;

class ChangeDomain extends BaseClass
{
	public static function validate($data)
	{
		if (empty($data['domain'])) {
			trigger_error("oSRS Error - Domain required\n", E_USER_WARNING);
		} else {
			return true;
		}
	}
}
