<?php

namespace ddaBundle\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class PageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('texte', CKEditorType::class, array(
                'config_name' => 'my_custom_config',
            ))
            ->add('popUpText', CKEditorType::class, array(
                'config_name' => 'my_custom_config',
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

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ddaBundle\FrontBundle\Entity\Page'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ddabundle_frontbundle_page';
    }


}
