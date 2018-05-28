<?php

namespace App\GraphQL\Resolver;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class BookingResolver implements ResolverInterface, AliasedInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * UserResolver constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Argument $args
     * @return Booking[]
     */
    public function resolve(Argument $args): array
    {
        dump($this->em->getRepository(Booking::class)->findBy(['id' => $args['ids']]));

        return $this->em->getRepository(Booking::class)->findBy(['id' => $args['ids']]);
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        return ['resolve' => 'Booking'];
    }
}
