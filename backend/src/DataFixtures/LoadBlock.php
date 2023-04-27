<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Block\BlockType;
use App\Repository\BlockRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LoadBlock extends Fixture implements OrderedFixtureInterface
{
    public function __construct(private readonly BlockRepository $blockRepository)
    {

    }

    public function load(ObjectManager $manager): void
    {
        if (!$this->blockRepository->findOneBy(['type' => BlockType::HorizontalRule])) {
            $block = new Block();
            $block
                ->setType(BlockType::HorizontalRule->value)
                ->setContent(
                    [
                        'rule' => '<hr>',
                    ]
                )
                ->setUpdatedAt(new \DateTime());

            $manager->persist($block);
        }

        if (!$this->blockRepository->findOneBy(['type' => BlockType::Header])) {
            $block = new Block();
            $block
                ->setType(BlockType::Header->value)
                ->setContent(
                    [
                        'text' => '',
                        'type' => [
                            'title' => 'Default Header',
                            'description' => 'Basic header, left or right aligned'
                        ],
                        'styleClassName' => 'condensed'
                    ]
                )
                ->setSettings(
                    [
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
                    ]
                )
                ->setUpdatedAt(new \DateTime());

            $manager->persist($block);
        }

        if (!$this->blockRepository->findOneBy(['type' => BlockType::Text])) {
            $block = new Block();
            $block
                ->setType(BlockType::Text->value)
                ->setContent(
                    [
                        'text' => '',
                    ]
                )
                ->setSettings(
                    [
                        'type' => 'default',
                        'placeholder' => [
                            'text' => 'My text',
                        ],
                    ]
                )
                ->setUpdatedAt(new \DateTime());

            $manager->persist($block);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 10;
    }
}
