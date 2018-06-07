<?php

namespace App\GraphQL\Resolver;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class UserResolver
 *
 * @package App\GraphQL\Resolver
 */
class UserResolver implements ResolverInterface, AliasedInterface
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
     * @return User[]
     */
    public function resolve(Argument $args): ?array
    {
        return $this->em->getRepository(User::class)->findBy(['id' => $args['ids']]);
    }

    /**
     *
     * @return array
     */
    public static function getAliases(): array
    {
        return ['resolve' => 'User'];
    }
}
