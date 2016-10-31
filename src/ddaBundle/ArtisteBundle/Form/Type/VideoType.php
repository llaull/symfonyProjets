<?php

namespace ddaBundle\ArtisteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class VideoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artiste')
            ->add('auteur')
            ->add('date')
            ->add('fichierMp4', ElFinderType::class, array(
                    'instance' => 'form',
                    'translation_domain' => 'AppBundleMessage',
                    'required' => false,
                    'attr' => array('class' => 'form-control'))
            )
            ->add('fichierOgg', ElFinderType::class, array(
                    'instance' => 'form',
                    'translation_domain' => 'AppBundleMessage',
                    'required' => false,
                    'attr' => array('class' => 'form-control'))
            )
            ->add('thumbnail', ElFinderType::class, array(
                    'instance' => 'form',
                    'translation_domain' => 'AppBundleMessage',
                    'required' => false,
                    'attr' => array('class' => 'form-control'))
            )
            ->add('active', CheckboxType::class, array(
                'required' => false,
                'translation_domain' => 'AppBundleMessage',
                'label_attr' => array(
                    'class' => 'checkbox-inline'),
                'attr' => array('class' => '')
            ))

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ddaBundle\ArtisteBundle\Entity\Video'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ddabundle_artistebundle_video';
    }


}
