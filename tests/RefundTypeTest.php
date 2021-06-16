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

namespace App\Tests;

use App\Entity\RefundType;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Persistence\ObjectManager;
use http\Client;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\RefundPlugin\Entity\RefundInterface;
use Sylius\RefundPlugin\Factory\RefundFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Webmozart\Assert\Assert;

final class RefundTypeTest extends WebTestCase
{
    /** @var Client */
    private static $client;

    /** @var RefundFactoryInterface */
    private $refundFactory;

    /** @var FactoryInterface */
    private $orderFactory;

    /** @var RepositoryInterface */
    private $refundRepository;

    /** @var RepositoryInterface */
    private $orderRepository;

    /** @var ObjectManager */
    private $entityManager;

    protected function setUp(): void
    {
        self::$client = static::createClient();
        self::$container = self::$client->getContainer();

        $this->refundRepository = self::$container->get('sylius_refund.repository.refund');
        $this->refundFactory = self::$container->get('sylius_refund.factory.refund');
        $this->orderFactory = self::$container->get('sylius.factory.order');
        $this->orderRepository = self::$container->get('sylius.repository.order');
        $this->entityManager = self::$container->get('doctrine.orm.entity_manager');

        $purger = new ORMPurger($this->entityManager);
        $purger->purge();
    }

    /** @test */
    public function it_create_new_refund_type(): void
    {
        /** @var OrderInterface $order */
        $order = $this->orderFactory->createNew();
        $order->setCurrencyCode('PLN');
        $order->setLocaleCode('en_US');

        $this->orderRepository->add($order);

        $refund = $this->refundFactory->createWithData($order, 10, 12, RefundType::customUnit());

        $this->refundRepository->add($refund);

        $refunds = $this->refundRepository->findAll();

        /** @var RefundInterface $refundFromDatabase */
        $refundFromDatabase = $refunds[0];

        Assert::same($refundFromDatabase, $refund);
        Assert::isInstanceOf($refundFromDatabase->getType(), RefundType::customUnit());
    }
}
