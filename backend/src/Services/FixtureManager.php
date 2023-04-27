<?php

namespace App\Services;

use App\Entity\Block;
use App\Entity\Block\BlockType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FixtureManager
{
    private Generator $fakerGenerator;

    public function __construct(private readonly EntityManagerInterface $em)
    {
        $this->fakerGenerator = Factory::create();
    }
    public function createUser(array $options = []): User
    {
        $resolver = new OptionsResolver();
        $resolvedOptions = $resolver
            ->setDefined([
                'firstName',
                'lastName',
                'email',
                'password',
                'roles',
            ])
            ->setAllowedTypes('roles', 'array')
            ->setDefaults([
                'firstName' => $this->fakerGenerator->firstName(),
                'lastName' => $this->fakerGenerator->lastName(),
                'email' => $this->fakerGenerator->email(),
                'password' => $this->fakerGenerator->password(),
                'roles' => [],
            ])
            ->resolve($options)
        ;

        $user = new User();
        $user
            ->setFirstName($resolvedOptions['firstName'])
            ->setLastName($resolvedOptions['lastName'])
            ->setEmail($resolvedOptions['email'])
            ->setPassword($resolvedOptions['password'])
            ->setRoles($resolvedOptions['roles'])
        ;

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function createBlock(array $options = []): Block
    {
        $resolver = new OptionsResolver();
        $resolvedOption = $resolver
            ->setDefined([
                'content',
                'settings',
                'type',
            ])
            ->setAllowedTypes('type', BlockType::class)
            ->setDefaults([
                'content' => function (Options $options) {
                    return match ($options['type']) {
                        BlockType::Header => [
                            'text' => '',
                            'type' => [
                                'title' => 'Default Header',
                                'description' => 'Basic header, left or right aligned'
                            ],
                            'styleClassName' => 'condensed'
                        ],
                        BlockType::Text => ['text' => ''],
                        BlockType::HorizontalRule => ['rule' => '<hr>'],
                        default => [],
                    };
                },
                'settings' => function (Options $options) {
                    return match ($options['type']) {
                        BlockType::Header => [
                            'placeholder' => [
                                'text' => 'My Header text',
                            ],
                            'activeType' => 'small',
                            'activeStyle' => 'condensed',
                            'styles' => [
                                'condensed' => [
                                    'index' => 0,
                                    'title' => 'Condensed',
                                    'description' => 'For longer titles',
                                    'className' => 'condensed',
                                ],
                                'wide' => [
                                    'index' => 1,
                                    'title' => 'Extra wide',
                                    'description' => 'For shorter titles',
                                    'className' => 'wide',
                                ],
                            ],
                            'types' => [
                                'numeral' => [
                                    'index' => 0,
                                    'title' => 'Numeral',
                                    'description' => 'For years only, used in timelines and archives',
                                    'className' => 'header-numeral',
                                ],
                                'small' => [
                                    'index' => 1,
                                    'title' => 'Small(default)',
                                    'description' => 'Most versatile, for long intros and accordion headers',
                                    'className' => 'header-s',
                                ],
                            ],
                        ],
                        BlockType::Text => [
                            'type' => 'default',
                            'placeholder' => [
                                'text' => 'My text',
                            ],
                        ],
                        default => [],
                    };
                }

            ])
            ->resolve($options)
        ;

        $block = new Block();
        $block
            ->setContent($resolvedOption['content'])
            ->setType($resolvedOption['type']->value)
            ->setSettings($resolvedOption['settings'])
            ->setUpdatedAt(new \DateTime())
        ;

        $this->em->persist($block);
        $this->em->flush();

        return $block;
    }

}
