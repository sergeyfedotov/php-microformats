<?php
namespace Fsv\Microformats\Parser;

use Fsv\Microformats\Model\Geo;

/**
 * Class GeoParser
 * @package Fsv\Microformats\Parser
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class GeoParser extends AbstractParser
{
    /**
     * @var array
     */
    protected static $singularProperties = [
        'longitude',
        'latitude'
    ];

    /**
     * @return Geo
     */
    public function createObject()
    {
        return new Geo();
    }

    /**
     * @return string
     */
    public function getRootClassName()
    {
        return 'geo';
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     * @return float
     */
    protected function convertValue($propertyName, $value)
    {
        return (float)$value;
    }
}
