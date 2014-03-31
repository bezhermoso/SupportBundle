<?php

namespace Bez\SupportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BezSupportBundle:Default:index.html.twig', array('name' => $name));
    }
}
