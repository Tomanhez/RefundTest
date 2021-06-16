<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

use Sylius\RefundPlugin\Model\RefundType as BaseRefundType;

final class RefundType extends BaseRefundType implements RefundTypeInterface
{
    public static function customUnit(): RefundTypeInterface
    {
        return new self(self::CUSTOM_UNIT);
    }
}
