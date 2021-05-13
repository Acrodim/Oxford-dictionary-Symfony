<?php

namespace App\Service\OxfordDictionary\UseCases;

use App\Repository\SearchesRepository;
use App\Service\OxfordDictionary\ApiFacade;

class GetEntryUseCase {

    private ApiFacade $apiFacade;
    private SearchesRepository $searchesRepository;

    /**
     * GetEntryUseCase constructor.
     * @param ApiFacade $apiFacade
     * @param SearchesRepository $searchesRepository
     */
    public function __construct(ApiFacade $apiFacade, SearchesRepository $searchesRepository)
    {
        $this->apiFacade = $apiFacade;
        $this->searchesRepository = $searchesRepository;
    }

    /**
     * @param  string  $word
     * @param  string  $lang
     * @return array
     */
    public function handle(string $word, string $lang = 'en-us'): array
    {
        $lemmas = $this->apiFacade->lemmas()->get($word, $lang);
        $word = $lemmas[0]->inflectionOf;
        $this->searchesRepository->incrementWord($word);

        return $this->apiFacade->entries()->get($word, $lang);
    }

}
