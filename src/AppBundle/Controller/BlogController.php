<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 17-5-3
 * Time: 下午2:12
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * @Route("/blog/{page}", name="blog_index", defaults={"page":1})
     */
    public function indexAction($page)
    {
        return new Response("The page number:{$page}");
    }

    /**
     * @Route(
     *     "/articles/{_locale}/{year}/{title}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale": "en|fr",
     *         "_format": "html|rss",
     *         "year": "\d+"
     *     }
     * )
     */
    public function showAction($_locale, $year, $title)
    {
        $data = [
            'local' => $_locale,
            'year' => $year,
            'title' => $title
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("/blog/generate/url", name="blog_generate_url")
     */
    public function generateUrlAction()
    {
        $url = $this->generateUrl(
            'blog_index',
            array('page' => '10')
        );
        echo $url;
        return new Response();
    }
}
