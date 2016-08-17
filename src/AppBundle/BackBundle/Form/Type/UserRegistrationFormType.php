<?php

namespace AppBundle\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserRegistrationFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', null, array('label' => 'form.lastname', 'translation_domain' => 'AppBundleMessage'))
            ->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'AppBundleMessage'))
            ->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'AppBundleMessage'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'AppBundleMessage'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'AppBundleMessage'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\BackBundle\Entity\User'
        ));
    }
}
