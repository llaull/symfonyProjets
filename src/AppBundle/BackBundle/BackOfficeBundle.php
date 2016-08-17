<?php

namespace AppBundle\BackBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BackOfficeBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
