<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\Result;
use PHPUnit\Framework\TestCase;

/**
 * Class ResultTest
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class ResultTest extends TestCase
{

	/**
	 *
	 */
	public function testConstruct()
	{
		$result = new Result();

		$this->assertTrue($result->isValid(), 'Default value has to be TRUE.');
		$this->assertEquals($result->getMessages(), [], 'Array has to be empty by default.');
	}

}
