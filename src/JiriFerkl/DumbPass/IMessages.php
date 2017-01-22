<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

use JiriFerkl\DumbPass\Enums\ErrorMessage;
use JiriFerkl\DumbPass\Enums\Localization;

/**
 * Interface IMessages
 *
 * @package JiriFerkl\DumbPass
 */
interface IMessages
{

	/**
	 * Returns translated error message.
	 *
	 * @param Localization $loc
	 * @param ErrorMessage $message
	 *
	 * @return string
	 */
	public static function getMessage(Localization $loc, ErrorMessage $message) : string;

}
