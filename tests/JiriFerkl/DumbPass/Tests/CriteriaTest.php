<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Tests;

use JiriFerkl\DumbPass\Criteria;
use PHPUnit\Framework\TestCase;

/**
 * Class CriteriaTest
 *
 * @package JiriFerkl\DumbPass\Tests
 */
final class CriteriaTest extends TestCase
{

	/**
	 *
	 */
	public function testConstruct()
	{
		$criteria = new Criteria();

		$length    = $criteria->getLength();
		$number    = $criteria->areNumberCharsEnforced();
		$capital   = $criteria->areCapitalCharsEnforced();
		$special   = $criteria->areSpecialCharsEnforced();
		$passCheck = $criteria->isCommonPassCheck();

		$this->assertInternalType('integer', $length);
		$this->assertInternalType('boolean', $number);
		$this->assertInternalType('boolean', $capital);
		$this->assertInternalType('boolean', $special);
		$this->assertInternalType('boolean', $passCheck);

		$minLength = 9;

		$this->assertEquals($minLength, $length, sprintf('Default value has to be at least %d.', $minLength));
		$this->assertTrue($number, 'Default value has to be TRUE.');
		$this->assertTrue($capital, 'Default value has to be TRUE.');
		$this->assertTrue($special, 'Default value has to be TRUE.');
		$this->assertTrue($passCheck, 'Default value has to be TRUE.');
	}

}
