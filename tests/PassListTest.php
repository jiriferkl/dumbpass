<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\PassList;
use PHPUnit\Framework\TestCase;

/**
 * Class PassListTest
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class PassListTest extends TestCase
{

	/**
	 *
	 */
	public function testVerify()
	{
		$passList = new PassList();

		$ok = $passList->verify('@t3st2__F');

		$this->assertTrue($ok, 'This password has to be ok');
	}

	/**
	 *
	 */
	public function testVerifyBadPass()
	{
		$passList = new PassList();

		$ok = $passList->verify('password');

		$this->assertFalse($ok, 'This password has not to be ok');
	}

	/**
	 *
	 */
	public function testGetFilePath()
	{
		$path = PassList::getFilePath();

		$this->assertInternalType('string', $path);
		$this->assertTrue(file_exists($path), 'Password list file doesn\'t exist');
	}

}
