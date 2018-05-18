<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $game = $options['data'];
        $maxLevel = $game->getTournament()->getGames()[0]->getLevel();

        $builder
            ->add('startAt', DateTimeType::class,
                [
                    'widget' => 'single_text', 'model_timezone' => 'Europe/Paris', 'html5' => false,
                    'attr' => ['class' => 'flatpickr']
                ]
            )
            ->add('place');
        if ($maxLevel === $game->getLevel()) {
            $teamAttr = ['attr' => ['class'=> 'selectize']];
            $builder
                ->add('team1', null, $teamAttr)
                ->add('team2', null, $teamAttr);
        }
        $builder
            ->add('score1')
            ->add('score2');


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Game'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_game';
    }


}
