<?php

namespace App\Service\OxfordDictionary\Models\Entries;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use Symfony\Component\PropertyAccess\PropertyAccess;

class LexicalEntry extends FlexibleDataTransferObject
{
    /** @var string | null */
    public $etymology;

    /** @var string | null */
    public $lexicalCategory;

    /** @var array */
    public $pronunciations;

    /** @var array */
    public $senses;

    /** @var array | null */
    public $phrases;

    /**
     * LexicalEntry constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $this->etymology = $propertyAccessor->getValue($data, '[entries][0][etymologies][0]');
        $this->lexicalCategory = $propertyAccessor->getValue($data, '[lexicalCategory][text]');

        if (!$pronunciations = $propertyAccessor->getValue($data, '[entries][0][pronunciations]')) {
            $pronunciations = [];
        }

        foreach ($pronunciations as $pronunciation) {
            $this->pronunciations[] = new Pronunciation($pronunciation);
        }

        if (!$phrases = $propertyAccessor->getValue($data, '[phrases]')) {
            $phrases = [];
        }

        foreach ($phrases as $phrase) {
            $this->phrases[] = $propertyAccessor->getValue($phrase, '[text]');
        }

        if (!$senses = $propertyAccessor->getValue($data, '[entries][0][senses]')) {
            $senses = [];
        }

        foreach ($senses as $sense) {
            $this->senses[] = new Sense($sense);

        }
    }
}
