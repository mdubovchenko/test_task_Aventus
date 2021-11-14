<?php

namespace AppBundle\Controller;

use AppBundle\Classes\FileService;
use AppBundle\Classes\JokeApi;
use AppBundle\Classes\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $email = $request->get('email');
        $category = $request->get('categories', 'nerdy');

        $api = new JokeApi();
        $select = $api->getSelect();
        $joke = $api->getRandomJoke($category);

        if (!empty($email)) {
            $sendMail = New MailerService();
            $sendMail->sendMail($email, $category, $joke);
            $fileService = New FileService();
            $fileService->createFile($joke);
            $error = '';
        } else {
            $error = 'Введите почту!';
        }

        return $this->render('default/index.html.twig', compact('select', 'error'));
    }
}
