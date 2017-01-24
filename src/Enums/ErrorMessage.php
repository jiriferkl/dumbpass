<?php declare(strict_types = 1);

namespace JiriFerkl\DumbPass\Enums;

use Consistence\Enum\Enum;

/**
 * Class ErrorMessage
 *
 * @package JiriFerkl\DumbPass\Enums
 */
final class ErrorMessage extends Enum
{

	const LENGTH  = 'length';
	const NUMERIC = 'numeric';
	const CAPITAL = 'capital';
	const SPECIAL = 'special';
	const COMMON  = 'common';
	const LOWER   = 'lower';

}
