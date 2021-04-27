<?php


namespace App\Service\OxfordDictionary\Builders;

use App\Service\OxfordDictionary\Exceptions\ApiBuilderException;
use App\Service\OxfordDictionary\Models\Entries\Entry;
use Spatie\DataTransferObject\DataTransferObjectError;
use Symfony\Component\PropertyAccess\PropertyAccess;

class EntriesResultBuilder
{
    private array $response;

    /**
     * EntriesResultBuilder constructor.
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function build(): array
    {
        $results = [];
        if (!key_exists('error', $this->response)) {
            try {
                $propertyAccessor = PropertyAccess::createPropertyAccessor();
                $entries = $propertyAccessor->getValue($this->response, '[results]');
                foreach ($entries as $entry){
                    $results[] = new Entry($entry);
                }
            } catch (DataTransferObjectError $e) {
                throw new ApiBuilderException('Wrong API response.');
            }
        } else {
            $results = $this->response;
        }
        return $results;
    }
}