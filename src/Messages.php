<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

use JiriFerkl\DumbPass\Enums\ErrorMessage;
use JiriFerkl\DumbPass\Enums\Localization;
use JiriFerkl\DumbPass\Exception\DumbPassException;
use Nette\Neon\Neon;

/**
 * Class Messages
 *
 * @package JiriFerkl\DumbPass
 */
final class Messages implements IMessages
{

	/**
	 * Returns translated error message.
	 *
	 * @param Localization $loc
	 * @param ErrorMessage $message
	 *
	 * @return string
	 * @throws DumbPassException
	 */
	public function getMessage(Localization $loc, ErrorMessage $message) : string
	{
		$neon = self::getNeonPath($loc);

		if (!file_exists($neon)) {
			throw new DumbPassException(
				sprintf('Translation file %s not found', $neon),
				DumbPassException::LOCALIZATION_FILE_NOT_FOUND
			);
		}

		$messages = Neon::decode(file_get_contents($neon));

		return $messages[$message->getValue()];
	}

	/**
	 * Gets path of localization neon.
	 *
	 * @param Localization $loc
	 *
	 * @return string
	 */
	public static function getNeonPath(Localization $loc) : string
	{
		$path = self::getNeonBasePath() . $loc->getValue() . '.neon';

		return $path;
	}

	/**
	 * Gets base path for localization neons.
	 *
	 * @return string
	 */
	public static function getNeonBasePath() : string
	{
		$base = __DIR__ . '/Resource/Translation/';

		return $base;
	}

}
