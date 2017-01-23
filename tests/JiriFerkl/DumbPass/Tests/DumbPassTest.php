<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\DumbPass;
use JiriFerkl\DumbPass\Enums\ErrorMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class DumbPassTest
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class DumbPassTest extends TestCase
{

	/**
	 *
	 */
	public function testVerifyDefault()
	{
		$pass = 'password';

		$result = DumbPass::verify($pass);

		ErrorMessage::COMMON;
		ErrorMessage::CAPITAL;
		ErrorMessage::NUMERIC;
		ErrorMessage::SPECIAL;
		ErrorMessage::LENGTH;

		$this->assertFalse($result->isValid(), self::getMessage($pass, FALSE));
		$this->assertArrayHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::SPECIAL, $result->getMessages());

		$pass = '12345678910';

		$result = DumbPass::verify($pass);

		$this->assertFalse($result->isValid(), self::getMessage($pass, FALSE));
		$this->assertArrayNotHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::SPECIAL, $result->getMessages());

		$pass = '12345A678910';

		$result = DumbPass::verify($pass);

		$this->assertFalse($result->isValid(), self::getMessage($pass, FALSE));
		$this->assertArrayNotHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::SPECIAL, $result->getMessages());

		$pass = '12@345A678910';

		$result = DumbPass::verify($pass);

		$this->assertTrue($result->isValid(), self::getMessage($pass, TRUE));
		$this->assertArrayNotHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::SPECIAL, $result->getMessages());
	}

	/**
	 * @param string $pass
	 * @param bool   $hasToPass
	 *
	 * @return string
	 */
	public static function getMessage(string $pass, bool $hasToPass) : string
	{
		if ($hasToPass) {
			return sprintf('Password "%s" has to pass', $pass);
		}

		return sprintf('Password "%s" has not to pass', $pass);
	}

}
