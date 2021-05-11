<?php

namespace App\Service\OxfordDictionary\UseCases;

use App\Service\OxfordDictionary\ApiFacade;

class GetEntryUseCase {

    private ApiFacade $apiFacade;

    /**
     * GetEntryUseCase constructor.
     * @param  ApiFacade  $apiFacade
     */
    public function __construct(ApiFacade $apiFacade)
    {
        $this->apiFacade = $apiFacade;
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

        return $this->apiFacade->entries()->get($word, $lang);
    }

}