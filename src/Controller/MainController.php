<?php

namespace App\Controller;

use App\Service\OxfordDictionary\UseCases\GetEntryUseCase;
use App\Service\OxfordDictionary\UseCases\GetTagCloudUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private GetTagCloudUseCase $tagCloudUseCase;
    private GetEntryUseCase $entryUseCase;

    public function __construct(GetTagCloudUseCase $tagCloudUseCase, GetEntryUseCase $entryUseCase)
    {
        $this->tagCloudUseCase = $tagCloudUseCase;
        $this->entryUseCase = $entryUseCase;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {

        return $this->render('pages/index.html.twig');
    }

    /**
     * @Route("/get-words", name="get-words")
     */
    public function getWords(): Response
    {
        $words = $this->tagCloudUseCase->handle();

        $response = new Response(json_encode($words));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/search/", name="search")
     */
    public function search(Request $request): Response
    {
        $word = $request->get('q');
        $lang = $request->get('lang');

        $data = $this->entryUseCase->handle($word, $lang);
        dd($data);

        return $this->render('pages/search.html.twig');
    }
}
