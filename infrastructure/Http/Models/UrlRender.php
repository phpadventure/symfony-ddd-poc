<?php

namespace Infrastructure\Http\Models;


class UrlRender
{
    /**
     * @var array
     */
    private $urlsPlaceholders;

    /**
     * UrlPlaceholderRender constructor.
     * @param array $urlsPlaceholders
     */
    public function __construct(array $urlsPlaceholders)
    {
        $this->urlsPlaceholders = $urlsPlaceholders;
    }

    /**
     * @param string $urlIdentifier
     * @param array $urlParams
     * @param array $query
     * @return string
     */
    public function build(string $urlIdentifier, array $urlParams = [], array $query = [])
    {
        return $this->attachQuery(
            $this->setParamPlaceHolders(
                $this->urlsPlaceholders[$urlIdentifier], $urlParams
            ), $query
        );
    }


    /**
     * @param string $urlIdentifier
     * @param array $urlParams
     * @return string
     */
    private function setParamPlaceHolders(string $url, array $urlParams = []): string
    {
        return strtr(
            $url,
            array_combine($this->extractPlaceholders($urlParams), array_values($urlParams))
        );
    }

    /**
     * @param array $data
     * @return array
     */
    private function extractPlaceholders(array $data = []): array
    {
        return array_map(function ($propertyName) {return ':' . $propertyName;}, array_keys($data));
    }

    /**
     * @param string $url
     * @param array $query
     * @return string
     */
    private function attachQuery(string $url, array $query = [])
    {
        $url = trim($url, '&?');
        if (!empty($query)) {
            $separator = strpos($url, '?') === false ? '?' : '&';
            $url = $url . $separator . http_build_query($query);
        }
        return $url;
    }
}