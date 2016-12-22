<?php

namespace ddaBundle\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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

        $builder
            ->add('titre');

        $builder->add('contenu', CKEditorType::class, array(
            'config_name' => 'my_custom_config',
        ));

        $builder
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
            ->add('active', CheckboxType::class, array(
                    'required' => false,
                    'translation_domain' => 'AppBundleMessage',
                    'label_attr' => array(
                        'class' => 'checkbox-inline'),
                    'attr' => array('class' => '')
                )
            );
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ddaBundle\FrontBundle\Entity\Actualite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ddabundle_frontbundle_actualite';
    }


}
