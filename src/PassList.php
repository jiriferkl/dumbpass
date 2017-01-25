<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

/**
 * Class PassList
 *
 * @package JiriFerkl\DumbPass
 */
final class PassList implements IPassList
{

	/**
	 * Checks most common passwords.
	 * If ok -> returns TRUE.
	 *
	 * @param string $pass
	 *
	 * @return bool
	 */
	public function verify(string $pass) : bool
	{
		$file = self::getFilePath();

		$passwords = explode("\n", file_get_contents($file));

		$ok = !in_array($pass, $passwords);

		return $ok;
	}

	/**
	 * @return string
	 */
	public static function getFilePath() : string
	{
		return __DIR__ . '/Resource/passwordlist.txt';
	}

}
