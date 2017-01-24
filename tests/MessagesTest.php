<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\Enums\ErrorMessage;
use JiriFerkl\DumbPass\Enums\Localization;
use JiriFerkl\DumbPass\Exception\DumbPassException;
use JiriFerkl\DumbPass\Messages;
use JiriFerkl\DumbPass\Tests\Enums\DummyLocalization;
use Nette\Neon\Neon;
use PHPUnit\Framework\TestCase;

/**
 * Class MessagesTest
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class MessagesTest extends TestCase
{

	/**
	 * Enum -> neon test.
	 *
	 * Every enum has to have a neon file with translation.
	 */
	public function testEqualityOfEnumAndNeon()
	{
		$values = Localization::getAvailableValues();

		foreach ($values as $value) {
			$enum = Localization::get($value);
			$neon = Messages::getNeonPath($enum);
			$this->assertTrue(
				file_exists($neon),
				sprintf('Localization enum "%s" doesn\'t have neon file (%s).', $enum->getValue(), $neon)
			);
		}
	}

	/**
	 * Neon -> enum test.
	 *
	 * Every neon file with translation has to have an enum.
	 */
	public function testEqualityOfNeonAndEnum()
	{
		$neons = glob(Messages::getNeonBasePath() . '*.neon');

		foreach ($neons as $neon) {
			$path  = explode('/', $neon);
			$title = explode('.', end($path))[0];

			$this->assertTrue(
				Localization::isValidValue($title),
				sprintf('Translation neon with name "%s" doesn\'t have an enum constant %s', $title, $title)
			);
		}
	}

	/**
	 * Every neon file has to have all translations and no more.
	 */
	public function testNeonMessages()
	{
		$neonFiles = glob(Messages::getNeonBasePath() . '*.neon');

		foreach ($neonFiles as $file) {
			$neon     = Neon::decode(file_get_contents($file));
			$messages = ErrorMessage::getAvailableValues();

			if ($neon == NULL) {
				$neon = [];
			}

			$extraInNeon   = array_diff(array_keys($neon), array_values($messages));
			$missingInNeon = array_diff(array_values($messages), array_keys($neon));

			if (count($extraInNeon) !== 0) {
				$this->fail(
					sprintf(
						'Neon file %s contains these extra translations: %s.',
						$file,
						implode(', ', $extraInNeon)
					)
				);
			}

			if (count($missingInNeon) !== 0) {
				$this->fail(
					sprintf(
						'Neon file %s doesn\'t contain these translations: %s.',
						$file,
						implode(', ', $missingInNeon)
					)
				);
			}
		}
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

	/**
	 *
	 */
	public function testExceptionGetMessage()
	{
		$loc          = DummyLocalization::get(DummyLocalization::TEST);
		$errorMessage = ErrorMessage::get(ErrorMessage::LENGTH);

		$this->expectException(DumbPassException::class);
		$this->expectExceptionCode(DumbPassException::LOCALIZATION_FILE_NOT_FOUND);

		Messages::getMessage($loc, $errorMessage);
	}

	/**
	 *
	 */
	public function testGetNeonBasePath()
	{
		$base = Messages::getNeonBasePath();

		$this->assertInternalType('string', $base);
		$this->assertTrue(file_exists($base), sprintf('Base path %s has to exist.', $base));
	}

	/**
	 *
	 */
	public function testGetNeonPath()
	{
		$path = Messages::getNeonPath(Localization::get(Localization::CZ));

		$this->assertInternalType('string', $path);
		$this->assertTrue((preg_match('/^.*\.neon$/', $path) === 1), 'Path has to end with ".neon"');
	}

}
