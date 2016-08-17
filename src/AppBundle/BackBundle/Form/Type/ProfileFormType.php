<?php

namespace AppBundle\BackBundle\Form\Type;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{

    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        // custom field
        $builder
            ->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'AppBundleMessage'))
            ->add('lastname', null, array('label' => 'form.lastname', 'translation_domain' => 'AppBundleMessage'));

        $builder->add('avatar', ElFinderType::class, array(
            'instance'=>'form',
            'label' => 'form.avatar',
            'translation_domain' => 'AppBundleMessage',
            'required' => false,
            'attr' => array('class' => 'form-control')));

    }

    public function getName()
    {
        return 'rest_user_profile';
    }

}
