<?php

namespace GlimeshClient\Response;

use GlimeshClient\Traits\ObjectResolverTrait;
use GraphQL\Query;

abstract class AbstractGlimeshResponse
{
    use ObjectResolverTrait;

    protected Query $queryRequested;
    protected string $rawResponse;

    public function __construct()
    {
        $data = $this->getAsArray();

        if (isset($data['errors'])) {
            $this->errors = self::getErrorMessages($data['errors']);

            throw new \Exception(implode("\n", $this->errors));
        }

        if (!isset($data['data'])) {
            throw new \Exception(sprintf(
                "No data or errors found in response: %s \n\nQuery: %s",
                $this->getRawResponseString(),
                $this->prettyPrintQuery()
            ));
        }
    }

    /**
     * Returns a query in a pretty printed form
     */
    public function prettyPrintQuery(): string
    {
        $lines = explode("\n", $this->queryRequested->__toString());
        $t = "    ";
        $ct = 0;
        foreach ($lines as $index => $line) {
            if (substr($line, -1, 1) === '}') {
                $ct -= 1;
            }

            $lines[$index] = str_repeat($t, $ct) . $lines[$index];

            if (substr($line, -1, 1) === '{') {
                $ct += 1;
            }
        }

        return implode("\n", $lines) . "\n";
    }

    public function getAsJson()
    {
        return $this->rawResponse;
    }

    abstract public function getRawResponseString(): string;

    public function getAsArray()
    {
        return json_decode($this->getRawResponseString(), true);
    }

    /**
     * @return AbstractObjectModel|\ArrayObject|PagedArrayObject
     */
    public function getAsObject()
    {
        $arrayResponse = $this->getAsArray()['data'];

        $key = array_key_first($arrayResponse);

        return self::getObject($key, $arrayResponse[$key]);
    }

    public function getQuery(): Query
    {
        return $this->queryRequested;
    }


    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * Get a multiline error string from an error array item returned from the API
     */
    protected function getErrorMessages(array $errors): array
    {
        return (array_map(function(array $error) {
            return $this->getErrorString($error);
        }, $errors));
    }

    /**
     * Get an error string from an error array item returned from the API
     */
    protected function getErrorString(array $glimeshError): string
    {
        return sprintf(
            "Glimesh API Error, Col %s Line %s: %s\nQuery: %s",
            $glimeshError['locations'][0]['column'],
            $glimeshError['locations'][0]['line'],
            $glimeshError['message'],
            $this->prettyPrintQuery()
        );
    }
}
