<?php

namespace ddaBundle\ArtisteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ArtisteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDeNaissance', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => ['class' => 'form-control datetime'])
            )
            ->add('collectif')
            ->add('nom')
            ->add('prenom')
            ->add('rue', null, array(
                'attr' => array('onFocus' => 'geolocate()'))
            )
            ->add('ville')
            ->add('postePostale')
            ->add('telephone')
            ->add('fax')
            ->add('portable')
            ->add('mail')
            ->add('site')
            ->add('moteCle')->add('lieuTravail')->add('dep')
            ->add('lieuNaissance')
            ->add('nationalite')
            ->add('active')
            ->add('dateDeDeces', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => ['class' => 'form-control datetime'])

            )
            ->add('lieuDeces')
            ->add('paysMort');
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
