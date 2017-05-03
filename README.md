## Symfony2学习笔记

### 第一天

#### 安装Symfony2

```$xslt
 composer create-project symfony/framework-standard-edition my_project_name "2.8.*"
```

#### 运行Symfony2

```$xslt
 cd my_project_name/
 php bin/console server:run
```
然后, 打开浏览器并且使用 http://localhost:8000 访问Symfony欢迎界面!

#### 检查Symfony应用程序配置和设置

然后, 打开浏览器并且使用 http://localhost:8000/config.php 访问。

如果您有任何文件权限错误或看到白色屏幕，那么请阅读[设置或修改文件权限](http://symfony.com/doc/current/setup/file_permissions.html)以获得更多信息。

#### 更新Symfony应用程序

```$xslt
 cd my_project_name/
 composer update
```

#### 安装一个现有Symfony应用程序

```$xslt
 cd projects/
 git clone ...
 
 cd my_project_name/
 composer install
```

### 第二天 

#### 创建一个控制器文件（LuckyController.php）

```$xslt
# src/AppBundle/Controller/LuckyController.php
<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
   
}
```

#### 创建一个返回字符串的方法

```$xslt
# src/AppBundle/Controller/LuckyController.php
/**
 * @Route("/lucky", name="lucky_index")
 */
public function indexAction()
{
    return new Response("<h1>Lucky Index!</h1>");
}

访问地址：http://127.0.0.1:8000/lucky
```

#### 创建一个返回json数据的方法

```$xslt
# src/AppBundle/Controller/LuckyController.php
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

访问地址：http://127.0.0.1:8000/lucky/json
```

#### 创建一个渲染模板的方法

```$xslt
# src/AppBundle/Controller/LuckyController.php
/**
 * @Route("/lucky/number", name="lucky_number")
 */
public function numberAction()
{
    $number         = mt_rand(1, 100);
    $data['number'] = $number;
    return $this->render('lucky/number.html.twig', $data);
}

# app/Resources/views/lucky/number.html.twig
{% extends 'base.html.twig' %}

{% block body %}

Number:{{ number }}

{% endblock %}

访问地址：http://127.0.0.1:8000/lucky/number
```

#### 创建一个带参数的方法

```$xslt
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

访问地址：http://127.0.0.1:8000/lucky/count/5
```

### 第三天

#### 创建一个BlogController.php文件

```$xslt
# src/AppBundle/Controller/BlogController.php
<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{

}
```

#### 创建一个带默认参数的方法

```$xslt
# src/AppBundle/Controller/BlogController.php
/**
 * @Route("/blog/{page}", name="blog_index", defaults={"page":1})
 */
public function indexAction($page)
{
    return new Response("The page number:{$page}");
}

访问地址：http://127.0.0.1:8000/blog
访问地址：http://127.0.0.1:8000/blog/2
```

#### 创建一个带限制条件的方法

```$xslt
# src/AppBundle/Controller/BlogController.php
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
访问地址：http://127.0.0.1:8000/articles/en/2010/my-post
访问地址：http://127.0.0.1:8000/articles/fr/2010/my-post.rss
访问地址：http://127.0.0.1:8000/articles/en/2013/my-latest-post.html
```

#### 在控制器中生成URL

```$xslt
# src/AppBundle/Controller/BlogController.php
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
访问地址：http://127.0.0.1:8000/blog/generate/url
```

#### 在模板中生成URL

```$xslt
<a href="{{ path('blog_index', {'page': '2'}) }}">Go to blog index</a>

<a href="{{ url('blog_index', {'page': '2'}) }}">Go to blog index</a>
```
