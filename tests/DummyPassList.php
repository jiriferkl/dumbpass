<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\IPassList;

/**
 * Class DummyPassList
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class DummyPassList implements IPassList
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
		return FALSE;
	}

}
