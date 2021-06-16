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

namespace App\Entity\Type;

use App\Entity\RefundType;
use Sylius\RefundPlugin\Entity\Type\RefundEnumType as BaseRefundEnumType;
use Sylius\RefundPlugin\Model\RefundTypeInterface;

class RefundEnumType extends BaseRefundEnumType
{
    protected function createType($value): RefundTypeInterface
    {
        return new RefundType($value);
    }
}
