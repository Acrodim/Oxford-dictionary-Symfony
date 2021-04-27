<?php


namespace App\Service\OxfordDictionary\Models\Entries;

use Spatie\DataTransferObject\FlexibleDataTransferObject;


class Entry extends FlexibleDataTransferObject
{
    public string $word;
    public string $language;
    /** @var \App\Service\OxfordDictionary\Models\Entries\LexicalEntry[] */
    public $lexicalEntries;
}