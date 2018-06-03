<?php

namespace App\GraphQL\Resolver;

use App\Entity\MeetingRoom;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class MeetingRoomResolver
 * @package App\GraphQL\Resolver
 */
class MeetingRoomResolver implements ResolverInterface, AliasedInterface
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
     * @return MeetingRoom
     */
    public function resolve(Argument $args): ?MeetingRoom
    {
        return $this->em->getRepository(MeetingRoom::class)->findOneBy(['id' => $args['id']]);
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        return ['resolve' => 'MeetingRoom'];
    }
}
