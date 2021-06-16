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

use Sylius\RefundPlugin\Model\RefundTypeInterface as BaseRefundTypeInterface;

interface RefundTypeInterface extends BaseRefundTypeInterface
{
    public const CUSTOM_UNIT = 'custom_unit';

    public static function customUnit(): self;
}
