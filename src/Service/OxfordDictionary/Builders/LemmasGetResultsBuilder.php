<?php

namespace App\Service\OxfordDictionary\Builders;

use App\Service\OxfordDictionary\Models\LexicalEntries\LexicalEntry;

class LemmasGetResultsBuilder
{

    /**
     * @var array
     */
    private array $response;


    /**
     * LemmasGetResultsBuilder constructor.
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }


    /**
     * @return array
     */
    public function build(): array
    {

        $results = [];

        if (key_exists('error', $this->response)) {
            return $results;
        }

        foreach ($this->response['results'][0]['lexicalEntries'] as $entry) {

            $results[] = new LexicalEntry([

                'id'=>$entry['inflectionOf'][0]['id'],
                'language'=>$entry['language'],
                'inflectionOf' => $entry['inflectionOf'][0]['text'],
                'lexicalCategory' => $entry['lexicalCategory']['text'],

            ]);

        }

        return $results;
    }

}
