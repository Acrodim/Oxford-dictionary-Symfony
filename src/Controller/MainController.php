<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 4/22/21
 * Time: 12:44 PM
 */

namespace App\Controller;


use App\Service\OxfordDictionary\UseCases\GetTagCloudUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class MainController extends AbstractController
{
    public GetTagCloudUseCase $tagCloudUseCase;

    public function __construct(GetTagCloudUseCase $tagCloudUseCase)
    {
        $this->tagCloudUseCase = $tagCloudUseCase;
    }

    public function index()
    {

        return $this->render('pages/index.html.twig');
    }

    /**
     * @return Response
     */
    public function getWords()
    {
        $words = $this->tagCloudUseCase->handler();
        $response = new Response(json_encode($words));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function search()
    {

        return $this->render('pages/search.html.twig');
    }
}
