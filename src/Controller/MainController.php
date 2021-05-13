<?php

namespace App\Controller;

use App\Service\OxfordDictionary\UseCases\GetEntryUseCase;
use App\Service\OxfordDictionary\UseCases\GetTagCloudUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\OxfordDictionary\Exceptions\ApiHttpClientException;

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

        try {
            $data = $this->entryUseCase->handle($word);
        } catch (ApiHttpClientException $e) {
            $this->addFlash('apiNotFoundWord', 'But no such word found, try another!');
            return $this->redirectToRoute('index');
        }

        return $this->render('pages/search.html.twig', [
            'data' => $data
        ]);
    }
}
