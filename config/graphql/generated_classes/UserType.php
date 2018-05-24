<?php
namespace Overblog\GraphQLBundle\__DEFINITIONS__;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Overblog\GraphQLBundle\Definition\ConfigProcessor;
use Overblog\GraphQLBundle\Definition\LazyConfig;
use Overblog\GraphQLBundle\Definition\GlobalVariables;
use Overblog\GraphQLBundle\Definition\Type\GeneratedTypeInterface;

/**
 * THIS FILE WAS GENERATED AND SHOULD NOT BE MODIFIED!
 */
final class UserType extends ObjectType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'User',
            'description' => 'An User',
            'fields' => function () use ($globalVariable) {
                return [
                'id' => [
                    'type' => Type::nonNull(Type::int()),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'The unique ID of the user.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                ],
                'username' => [
                    'type' => Type::string(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Resolves using the user name.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                ],
                'email' => [
                    'type' => Type::string(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Resolves using the user email.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                ],
                'last_login' => [
                    'type' => Type::string(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Resolves using the user last_login.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                ],
            ];
            },
            'interfaces' => function () use ($globalVariable) {
                return [];
            },
            'isTypeOf' => null,
            'resolveField' => null,
        ];
        };
        $config = $configProcessor->process(LazyConfig::create($configLoader, $globalVariables))->load();
        parent::__construct($config);
    }
}
