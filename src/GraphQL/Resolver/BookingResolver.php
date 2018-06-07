<?php

namespace App\GraphQL\Resolver;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class BookingResolver
 *
 * @package App\GraphQL\Resolver
 */
class BookingResolver implements ResolverInterface, AliasedInterface
{

    /**
     *
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
     *
     * @param  Argument $args
     * @return Booking|null
     */
    public function resolve(Argument $args): ?Booking
    {
        return $this->em->getRepository(Booking::class)->findOneBy(['id' => $args['id']]);
    }

    /**
     *
     * @param  Argument $args
     * @return Booking|null
     */
    public function resolve1(Argument $args): ?Booking
    {
        return null;
    }

    /**
     *
     * @return array
     */
    public static function getAliases(): array
    {
        return [
                'resolve'  => 'Booking',
                'resolve1' => 'Booking1',
               ];
    }
}
