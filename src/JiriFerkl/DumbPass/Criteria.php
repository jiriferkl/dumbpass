<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

/**
 * Class Criteria
 *
 * @package JiriFerkl\DumbPass
 */
final class Criteria
{

	/**
	 * @var int
	 */
	private $length = 9;

	/**
	 * @var bool
	 */
	private $numberChars = TRUE;

	/**
	 * @var bool
	 */
	private $capitalChars = TRUE;

	/**
	 * @var bool
	 */
	private $specialChars = TRUE;

	/**
	 * @var bool
	 */
	private $commonPassCheck = TRUE; //TODO malé písmeno

	/**
	 * @return int
	 */
	public function getLength() : int
	{
		return $this->length;
	}

	/**
	 * Sets pass length.
	 *
	 * @param int $length
	 *
	 * @return Criteria
	 */
	public function setLength(int $length) : Criteria
	{
		$this->length = $length;

		return $this;
	}

	/**
	 * If TRUE -> numbers are enforced.
	 *
	 * @return boolean
	 */
	public function areNumberCharsEnforced() : bool
	{
		return $this->numberChars;
	}

	/**
	 * Enforces numeric chars.
	 *
	 * @param boolean $numberChars
	 *
	 * @return Criteria
	 */
	public function enforceNumberChars(bool $numberChars = TRUE) : Criteria
	{
		$this->numberChars = $numberChars;

		return $this;
	}

	/**
	 * If TRUE -> capitals are enforced.
	 *
	 * @return boolean
	 */
	public function areCapitalCharsEnforced() : bool
	{
		return $this->capitalChars;
	}

	/**
	 * Enforces capital chars.
	 *
	 * @param boolean $capitalChars
	 *
	 * @return Criteria
	 */
	public function enforceCapitalChars(bool $capitalChars = TRUE) : Criteria
	{
		$this->capitalChars = $capitalChars;

		return $this;
	}

	/**
	 * If TRUE -> special chars are enforced.
	 *
	 * @return boolean
	 */
	public function areSpecialCharsEnforced() : bool
	{
		return $this->specialChars;
	}

	/**
	 * Enforces special chars.
	 *
	 * @param boolean $specialChars
	 *
	 * @return Criteria
	 */
	public function enforceSpecialChars(bool $specialChars = TRUE) : Criteria
	{
		$this->specialChars = $specialChars;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isCommonPassCheck() : bool
	{
		return $this->commonPassCheck;
	}

	/**
	 * Allows checking of common passwords.
	 *
	 * @param boolean $commonPassCheck
	 *
	 * @return Criteria
	 */
	public function allowCommonPassCheck(bool $commonPassCheck = TRUE) : Criteria
	{
		$this->commonPassCheck = $commonPassCheck;

		return $this;
	}

}
