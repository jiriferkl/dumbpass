<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass;

use JiriFerkl\DumbPass\Enums\ErrorMessage;
use JiriFerkl\DumbPass\Enums\Localization;

/**
 * Class DumbPass
 *
 * @package JiriFerkl\DumbPass
 */
final class DumbPass
{

	/**
	 * Verify password by Criteria object.
	 *
	 * @param string            $pass     Password
	 * @param Criteria|NULL     $criteria If null -> default object
	 * @param Localization|NULL $loc      If null -> default EN
	 * @param IMessages|NULL    $messages If null -> default object
	 * @param IPassList|NULL    $passList If null -> default object
	 *
	 * @return Result
	 * @throws Exception\DumbPassException
	 */
	public static function verify(
		string $pass,
		Criteria $criteria = NULL,
		Localization $loc = NULL,
		IMessages $messages = NULL,
		IPassList $passList = NULL
	) : Result
	{
		//default objects
		if (!$criteria) {
			$criteria = new Criteria();
		}

		if (!$loc) {
			$loc = Localization::get(Localization::EN);
		}

		if (!$messages) {
			$messages = new Messages();
		}

		if (!$passList) {
			$passList = new PassList();
		}

		$result = new Result();

		if (strlen($pass) < $criteria->getLength()) {
			$result = $result
				->setValid(FALSE)
				->addMessage(
					ErrorMessage::LENGTH,
					$messages->getMessage($loc, ErrorMessage::get(ErrorMessage::LENGTH)) . $criteria->getLength()
				);
		}

		if ($criteria->areNumberCharsEnforced()) {
			if (preg_match('/.*[0-9]{1,}.*/', $pass) === 0) {
				$result = $result
					->setValid(FALSE)
					->addMessage(
						ErrorMessage::NUMERIC,
						$messages->getMessage($loc, ErrorMessage::get(ErrorMessage::NUMERIC))
					);
			}
		}

		if ($criteria->areCapitalCharsEnforced()) {
			if (preg_match('/.*[A-Z]{1,}.*/', $pass) === 0) {
				$result = $result
					->setValid(FALSE)
					->addMessage(
						ErrorMessage::CAPITAL,
						$messages->getMessage($loc, ErrorMessage::get(ErrorMessage::CAPITAL))
					);
			}
		}

		if ($criteria->areLowerCaseCharsEnforced()) {
			if (preg_match('/.*[a-z]{1,}.*/', $pass) === 0) {
				$result = $result
					->setValid(FALSE)
					->addMessage(
						ErrorMessage::LOWER,
						$messages->getMessage($loc, ErrorMessage::get(ErrorMessage::LOWER))
					);
			}
		}

		if ($criteria->areSpecialCharsEnforced()) {
			if (preg_match('/.*[^a-zA-Z0-9]{1,}.*/', $pass) === 0) {
				$result = $result
					->setValid(FALSE)
					->addMessage(
						ErrorMessage::SPECIAL,
						$messages->getMessage($loc, ErrorMessage::get(ErrorMessage::SPECIAL))
					);
			}
		}

		if ($criteria->isCommonPassCheck()) {
			if (!$passList->verify($pass)) {
				$result = $result
					->setValid(FALSE)
					->addMessage(
						ErrorMessage::COMMON,
						$messages->getMessage($loc, ErrorMessage::get(ErrorMessage::COMMON))
					);
			}
		}

		return $result;
	}

}
