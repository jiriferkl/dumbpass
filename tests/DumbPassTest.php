<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\Criteria;
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

		$this->assertFalse($result->isValid(), self::getMessage($pass, FALSE));
		$this->assertArrayHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::LOWER, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::SPECIAL, $result->getMessages());

		$pass = '12345678910';

		$result = DumbPass::verify($pass);

		$this->assertFalse($result->isValid(), self::getMessage($pass, FALSE));
		$this->assertArrayNotHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::LOWER, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::SPECIAL, $result->getMessages());

		$pass = '12345A678910';

		$result = DumbPass::verify($pass);

		$this->assertFalse($result->isValid(), self::getMessage($pass, FALSE));
		$this->assertArrayHasKey(ErrorMessage::LOWER, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::SPECIAL, $result->getMessages());

		$pass = '12@345A678910';

		$result = DumbPass::verify($pass);

		$this->assertFalse($result->isValid(), self::getMessage($pass, FALSE));
		$this->assertArrayNotHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayHasKey(ErrorMessage::LOWER, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::SPECIAL, $result->getMessages());

		$pass = '12@345A6a78910';

		$result = DumbPass::verify($pass);

		$this->assertTrue($result->isValid(), self::getMessage($pass, TRUE));
		$this->assertArrayNotHasKey(ErrorMessage::LENGTH, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::LOWER, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::COMMON, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::CAPITAL, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::NUMERIC, $result->getMessages());
		$this->assertArrayNotHasKey(ErrorMessage::SPECIAL, $result->getMessages());
	}

	/**
	 *
	 */
	public function testVerifyNotDefault()
	{
		$pass     = '';
		$criteria = new Criteria();
		$criteria
			->enforceCapitalChars(FALSE)
			->enforceLowerCaseChars(FALSE)
			->enforceNumberChars(FALSE)
			->enforceSpecialChars(FALSE)
			->allowCommonPassCheck(FALSE)
			->setLength(0);

		$result = DumbPass::verify($pass, $criteria);

		$this->assertTrue($result->isValid(), self::getMessage($pass, TRUE));
		$this->assertEquals([], $result->getMessages());
	}

	/**
	 *
	 */
	public function testVerifyMessages()
	{
		$pass     = '';
		$messages = new DummyMessages();

		$result = DumbPass::verify($pass, NULL, NULL, $messages);

		foreach ($result->getMessages() as $message) {
			$this->assertTrue(preg_match('/.*test.*/', $message) === 1);
		}

		$pass = 'password';

		$result = DumbPass::verify($pass, NULL, NULL, $messages);

		foreach ($result->getMessages() as $message) {
			$this->assertTrue(preg_match('/.*test.*/', $message) === 1);
		}
	}

	/**
	 *
	 */
	public function testVerifyPassList()
	{
		$pass     = '';
		$passList = new DummyPassList();
		$criteria = new Criteria();
		$criteria
			->enforceCapitalChars(FALSE)
			->enforceLowerCaseChars(FALSE)
			->enforceNumberChars(FALSE)
			->enforceSpecialChars(FALSE)
			->allowCommonPassCheck(TRUE)
			->setLength(0);

		$result = DumbPass::verify($pass, $criteria, NULL, NULL, $passList);

		$this->assertFalse($result->isValid());

		$pass = 'password';

		$result = DumbPass::verify($pass, $criteria, NULL, NULL, $passList);

		$this->assertFalse($result->isValid());
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
