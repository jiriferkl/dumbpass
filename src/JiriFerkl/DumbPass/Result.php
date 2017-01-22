<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

/**
 * Class Result
 *
 * @package JiriFerkl\DumbPass
 */
final class Result
{

	/**
	 * @var bool
	 */
	private $valid = TRUE;

	/**
	 * @var array
	 */
	private $messages = [];

	/**
	 * @return boolean
	 */
	public function isValid() : bool
	{
		return $this->valid;
	}

	/**
	 * @return array
	 */
	public function getMessages() : array
	{
		return $this->messages;
	}

	/**
	 * @param boolean $valid
	 *
	 * @return Result
	 */
	public function setValid(bool $valid) : Result
	{
		$this->valid = $valid;

		return $this;
	}

	/**
	 * @param string $message
	 *
	 * @return Result
	 */
	public function addMessage(string $message) : Result
	{
		//TODO add key
		$this->messages[] = $message;

		return $this;
	}

}
