<?php

namespace ddaBundle\ArtisteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtisteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('created')->add('updated')->add('dateDeNaissance')->add('dateDeDeces')->add('collectif')->add('nom')->add('prenom')->add('rue')->add('ville')->add('postePostale')->add('telephone')->add('fax')->add('portable')->add('mail')->add('site')->add('moteCle')->add('lieuTravail')->add('dep')->add('lieuNaissance')->add('nationalite')->add('active')->add('lieuDeces')->add('paysMort')->add('creator');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ddaBundle\ArtisteBundle\Entity\Artiste'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ddabundle_artistebundle_artiste';
    }


}
