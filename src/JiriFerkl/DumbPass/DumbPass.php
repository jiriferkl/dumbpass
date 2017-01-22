<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

use JiriFerkl\DumbPass\Enums\ErrorMessage;
use JiriFerkl\DumbPass\Enums\Localization;

/**
 * Class DumbPass
 *
 * @package JiriFerkl\DumbPass
 */
class DumbPass //TODO maybe final + SOLID refactoring
{

	/**
	 * Verify password by Criteria object.
	 *
	 * @param string        $pass
	 * @param Criteria|NULL $criteria If null -> default object
	 * @param Localization  $loc      Default EN
	 *
	 * @return Result
	 * @throws Exception\DumbPassException
	 */
	public static function verify(
		string $pass,
		Criteria $criteria = NULL,
		Localization $loc = Localization::EN
	) : Result
	{
		//default criteria object
		if (!$criteria) {
			$criteria = new Criteria();
		}

		$result = new Result();

		if (strlen($pass) < $criteria->getLength()) {
			$result = $result
				->setValid(FALSE)
				->addMessage(Messages::getMessage($loc, ErrorMessage::get(ErrorMessage::LENGTH)));
		}

		if ($criteria->areNumberCharsEnforced()) {
			if (preg_match('/.*[0-9]{1,}.*/', $pass) === 0) {
				$result = $result
					->setValid(FALSE)
					->addMessage(Messages::getMessage($loc, ErrorMessage::get(ErrorMessage::NUMERIC)));
			}
		}

		if ($criteria->areCapitalCharsEnforced()) {
			if (preg_match('/.*[A-Z]{1,}.*/', $pass) === 0) {
				$result = $result
					->setValid(FALSE)
					->addMessage(Messages::getMessage($loc, ErrorMessage::get(ErrorMessage::CAPITAL)));
			}
		}

		if ($criteria->areSpecialCharsEnforced()) {
			if (preg_match('/.*[^a-zA-Z0-9]{1,}.*/', $pass) === 0) {
				$result = $result
					->setValid(FALSE)
					->addMessage(Messages::getMessage($loc, ErrorMessage::get(ErrorMessage::SPECIAL)));
			}
		}

		if ($criteria->isCommonPassCheck()) {
			if (!PassList::verify($pass)) {
				$result = $result
					->setValid(FALSE)
					->addMessage(Messages::getMessage($loc, ErrorMessage::get(ErrorMessage::COMMON)));
			}
		}

		return $result;
	}

}
