<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class FrontController extends AbstractController
{
    /**
     * @Route("/", name="index_app")
     */
    public function index()
    {
        return $this->render('@App/Default/index.html.twig');
    }
}
