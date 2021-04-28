<?php

namespace App\Service\OxfordDictionary\Models\Entries;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Pronunciation  extends FlexibleDataTransferObject
{
    public string $audioFile;

    public array $dialects;

    public string $phoneticNotation;

    public string $phoneticSpelling;
}
