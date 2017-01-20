<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

/**
 * Class Criteria
 *
 * @package JiriFerkl\DumbPass
 */
class Criteria //TODO maybe final
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
	private $commonPassCheck = TRUE;

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
	 * @return boolean
	 */
	public function isNumberChars() : bool
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
	 * @return boolean
	 */
	public function isCapitalChars() : bool
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
	 * @return boolean
	 */
	public function isSpecialChars() : bool
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
