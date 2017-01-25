<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\Enums\ErrorMessage;
use JiriFerkl\DumbPass\Enums\Localization;
use JiriFerkl\DumbPass\IMessages;

/**
 * Class DummyMessages
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class DummyMessages implements IMessages
{

	/**
	 * Returns translated error message.
	 *
	 * @param Localization $loc
	 * @param ErrorMessage $message
	 *
	 * @return string
	 */
	public function getMessage(Localization $loc, ErrorMessage $message) : string
	{
		return 'test';
	}

}
