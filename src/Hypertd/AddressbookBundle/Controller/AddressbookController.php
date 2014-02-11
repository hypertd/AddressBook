<?php

namespace Hypertd\AddressbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AddressbookController extends Controller
{
    /**
     * @Route("/addressbook/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
