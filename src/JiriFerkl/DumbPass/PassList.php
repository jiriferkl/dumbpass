<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

/**
 * Class PassList
 *
 * @package JiriFerkl\DumbPass
 */
class PassList //TODO maybe final
{

	/**
	 * Checks most common passwords.
	 * If ok -> returns TRUE.
	 *
	 * @param string $pass
	 *
	 * @return bool
	 */
	public static function verify(string $pass) : bool
	{
		$file = __DIR__ . '/Resource/passwordlist.txt';

		$passwords = explode("\n", file_get_contents($file));

		$ok = !in_array($pass, $passwords);

		return $ok;
	}

}
