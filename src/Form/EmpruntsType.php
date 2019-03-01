<?php

namespace App\Form;

use App\Entity\Emprunts;
use App\Entity\Livre;
use App\Entity\Adherents;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EmpruntsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateEmprunt')
            ->add('dateRetour')
            ->add('fklivre', EntityType::class, array(
            'class' => Livre::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('e')
             ->orderBy('e.id', 'ASC');
            },
            'choice_label' => 'titre',
            'label'=> 'Titre',
             ))
            ->add('fkadherents', EntityType::class, array(
            'class' => Adherents::class,
            'query_builder' => function (EntityRepository $er) {
             return $er->createQueryBuilder('a')
             ->orderBy('a.id', 'ASC');
            },
            'choice_label' => 'nom',
            'label'=> 'Nom',
             ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emprunts::class,
        ]);
    }
}
