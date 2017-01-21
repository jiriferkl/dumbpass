<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Enums;

use Consistence\Enum\Enum;

/**
 * Class ErrorMessage
 *
 * @package JiriFerkl\DumbPass\Enums
 */
class ErrorMessage extends Enum //TODO maybe final
{

	const LENGTH  = 'length';
	const NUMERIC = 'numeric';
	const CAPITAL = 'capital';
	const SPECIAL = 'special';
	const COMMON  = 'common';

}
