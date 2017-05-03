<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 17-5-3
 * Time: 上午11:57
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky", name="lucky_index")
     */
    public function indexAction()
    {
        return new Response("<h1>Lucky Index!</h1>");
    }

    /**
     * @Route("/lucky/number", name="lucky_number")
     */
    public function numberAction()
    {
        $number         = mt_rand(1, 100);
        $data['number'] = $number;
        return $this->render('lucky/number.html.twig', $data);
    }

    /**
     * @Route("/lucky/json", name="lucky_json")
     */
    public function jsonAction()
    {
        $data = [
            'name' => 'Wei.Ding',
            'age'  => 25,
            'sex'  => 'Man'
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("/lucky/count/{count}", name="lucky_count")
     */
    public function countAction($count)
    {
        $number = array();
        for ($i = 0; $i < $count; $i++) {
            $number[] = mt_rand(1, 100);
        }
        $numberList = implode(',', $number);
        return new Response("NumberList:{$numberList}");
    }
}