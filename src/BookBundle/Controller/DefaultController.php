<?php

namespace BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/book", name="book_index")
     */
    public function indexAction()
    {
        return $this->render('BookBundle:Default:index.html.twig');
    }

    /**
     * @Route("/book/create", name="book_create")
     */
    public function createAction(Request $request)
    {
        $method = $request->getMethod();
        if($method == "GET"){
            return $this->render('BookBundle:Default:create.html.twig');
        }else{
            return $this->render('BookBundle:Default:create.html.twig');
        }
    }
}
