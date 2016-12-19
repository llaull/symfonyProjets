<?php

namespace ddaBundle\ArtisteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DossierType extends AbstractType
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
            ->add('titreView', CheckboxType::class, array(
                    'label' => "affiche le titre",
                    'required' => false,
                    'translation_domain' => 'ddaBundleBackBundle',
                    'label_attr' => array(
                        'class' => 'checkbox-inline'),
                    'attr' => array('class' => '')
                )
            )
            ->add('active', CheckboxType::class, array(
                    'required' => false,
                    'translation_domain' => 'AppBundleMessage',
                    'label_attr' => array(
                        'class' => 'checkbox-inline'),
                    'attr' => array('class' => '')
                )
            )
            ->add('home', CheckboxType::class, array(
                    'required' => false,
                    'translation_domain' => 'AppBundleMessage',
                    'label_attr' => array(
                        'class' => 'checkbox-inline'),
                    'attr' => array('class' => '')
                )
            )
            ->add('artiste');

        $builder->add('category', EntityType::class, array(
            'class' => 'ddaBundleArtisteBundle:Dossier',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('d')
                    ->where('d.category is NULL')
                    ->orderBy('d.artiste', 'ASC')
                    ->addOrderBy('d.titre', 'ASC');
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ddaBundle\ArtisteBundle\Entity\Dossier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ddabundle_artistebundle_dossier';
    }


}
