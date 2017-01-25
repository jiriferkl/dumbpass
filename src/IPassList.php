<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

/**
 * Interface IPassList
 *
 * @package JiriFerkl\DumbPass
 */
interface IPassList
{

	/**
	 * Checks most common passwords.
	 * If ok -> returns TRUE.
	 *
	 * @param string $pass
	 *
	 * @return bool
	 */
	public function verify(string $pass) : bool;

}
