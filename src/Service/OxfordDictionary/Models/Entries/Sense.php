<?php

namespace App\Service\OxfordDictionary\Models\Entries;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use Symfony\Component\PropertyAccess\PropertyAccess;

class Sense extends FlexibleDataTransferObject
{
    /** @var string | null */
    public $definition;

    /** @var string */
    public $domainClass;

    /** @var array */
    public $examples;

    /**
     * Sense constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $this->definition = $propertyAccessor->getValue($data, '[definitions][0]');
        $this->domainClass = $propertyAccessor->getValue($data, '[domainClasses][0][text]');
        $this->examples = [];
        if (!$examples = $propertyAccessor->getValue($data, '[examples]')) {
            $examples = [];
        }
        foreach ($examples as $example) {
            $this->examples[] = $propertyAccessor->getValue($example, '[text]');
        }
    }
}
