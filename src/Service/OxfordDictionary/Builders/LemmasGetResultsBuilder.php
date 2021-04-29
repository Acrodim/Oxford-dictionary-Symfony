<?php

namespace App\Service\OxfordDictionary\Builders;

use App\Service\OxfordDictionary\Exceptions\ApiBuilderException;
use App\Service\OxfordDictionary\Models\LexicalEntries\LexicalEntry;
use Spatie\DataTransferObject\DataTransferObjectError;
use Symfony\Component\PropertyAccess\PropertyAccess;


class LemmasGetResultsBuilder
{
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

        $pa = PropertyAccess::createPropertyAccessor();

        try {
            $entries = $pa->getValue($this->response, '[results][0][lexicalEntries]');

            foreach ($entries as $entry) {

                $results[] = new LexicalEntry([

                    'id'=>$pa->getValue($this->response, '[results][0][id]'),
                    'language'=>$pa->getValue($entry, '[language]'),
                    'inflectionOf' => $pa->getValue($entry, '[inflectionOf][0][text]'),
                    'lexicalCategory' => $pa->getValue($entry, '[lexicalCategory][text]')

                ]);
            }
        } catch (DataTransferObjectError $e) {
            throw new ApiBuilderException('Wrong API response.');
        }

        return $results;
    }

}
