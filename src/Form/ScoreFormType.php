<?php

declare(strict_types=1);

namespace App\Form;

use App\Domain\MatchMaker\Encounter\Score;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('score', NumberType::class)
            ->add('player', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'name',
                'choices' => [
                    $options['encounter']->playerA,
                    $options['encounter']->playerB
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => Score::class,
            // App\Entity\Encounter
            'encounter' => null
        ]);
    }
}
