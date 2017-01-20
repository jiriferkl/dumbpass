<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\Enums\ErrorMessage;
use JiriFerkl\DumbPass\Enums\Localization;
use JiriFerkl\DumbPass\Exception\DumbPassException;
use JiriFerkl\DumbPass\Messages;
use PHPUnit\Framework\TestCase;

/**
 * Class MessagesTest
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class MessagesTest extends TestCase
{

	//TODO anotace
	public function testEqualityOfEnumAndFiles()
	{
		$values = Localization::getAvailableValues();

		//enum -> neon test
		foreach ($values as $value) {
			$enum = Localization::get($value);
			$neon = Messages::getNeonPath($enum);
			$this->assertTrue(
				file_exists($neon),
				sprintf('Localization enum "%s" doesn\'t have neon file (%s).', $enum->getValue(), $neon)
			);
		}

		//TODO neon -> enum test
		//TODO neon -> has to have all messages and no more
	}

	/**
	 * @throws DumbPassException
	 */
	public function testGetMessage()
	{
		$loc          = Localization::get(Localization::CZ);
		$errorMessage = ErrorMessage::get(ErrorMessage::LENGTH);

		$message = Messages::getMessage($loc, $errorMessage);

		$this->assertInternalType('string', $message);
	}

}
