<?php

namespace ddaBundle\ArtisteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ActualiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('contenu', CKEditorType::class, array(
            'config_name' => 'my_custom_config',
        ));


        $builder
            ->add('titre')
            ->add('image', ElFinderType::class, array(
                    'instance' => 'form',
                    'translation_domain' => 'AppBundleMessage',
                    'required' => false,
                    'attr' => array('class' => 'form-control'))
            )
            ->add('publicationDate', DateTimeType::class, array(
                    'widget' => 'single_text',
                    'translation_domain' => 'AppBundleMessage',
                    'format' => 'dd/MM/yyyy HH:mm',
                    'attr' => ['class' => 'form-control datetime'])
            )
            ->add('depublicationDate', DateTimeType::class, array(
                    'widget' => 'single_text',
                    'translation_domain' => 'AppBundleMessage',
                    'format' => 'dd/MM/yyyy HH:mm',
                    'attr' => ['class' => 'form-control datetime'])
            )
            ->add('artiste', null, array(
                'translation_domain' => 'AppBundleMessage',
            ))
            ->add('active', CheckboxType::class, array(
                    'required' => false,
                    'translation_domain' => 'AppBundleMessage',
                    'label_attr' => array(
                        'class' => 'checkbox-inline'),
                        'attr' => array('class' => '')
                )
            );
    }

    /**mt-checkbox
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ddaBundle\ArtisteBundle\Entity\Actualite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ddabundle_artistebundle_actualite';
    }


}
