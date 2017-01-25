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
	 * @var array
	 */
	private $messages = [];

	/**
	 * Is password valid?
	 *
	 * @return boolean TRUE -> OK
	 */
	public function isValid() : bool
	{
		return empty($this->messages);
	}

	/**
	 * @return array
	 */
	public function getMessages() : array
	{
		return $this->messages;
	}

	/**
	 * @param string $key
	 * @param string $message
	 *
	 * @return Result
	 */
	public function addMessage(string $key, string $message) : Result
	{
		$this->messages[$key] = $message;

		return $this;
	}

}
