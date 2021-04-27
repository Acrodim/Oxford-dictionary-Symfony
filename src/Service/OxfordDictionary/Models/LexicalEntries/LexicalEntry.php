<?php

namespace App\Service\OxfordDictionary\Models\LexicalEntries;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class LexicalEntry extends FlexibleDataTransferObject
{

    public string $id;

    public string $inflectionOf;

    public string $language;

    public string $lexicalCategory;

}