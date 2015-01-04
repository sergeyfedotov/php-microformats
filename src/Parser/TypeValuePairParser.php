<?php
namespace Fsv\Microformats\Parser;

use Fsv\Microformats\Model\TypeValuePair;

/**
 * Class TypeValuePairParser
 * @package Fsv\Microformats\Parser
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class TypeValuePairParser extends AbstractParser
{
    /**
     * @var array
     */
    protected static $pluralProperties = [
        'value',
        'type'
    ];

    /**
     * @var array
     */
    protected static $urlProperties = [
        'value'
    ];

    /**
     * @var string
     */
    protected $className;

    /**
     * @var string
     */
    protected $defaultType;

    /**
     * @param string $className
     * @param string $defaultType
     */
    public function __construct($className, $defaultType = null)
    {
        $this->className = $className;
        $this->defaultType = $defaultType;
    }

    /**
     * @return TypeValuePair
     */
    public function createObject()
    {
        return new TypeValuePair([$this->defaultType]);
    }

    /**
     * @return string
     */
    public function getRootClassName()
    {
        return $this->className;
    }

    /**
     * @param string $input
     * @return TypeValuePair[]
     */
    public function parse($input)
    {
        $objects = parent::parse($input);

        /** @var TypeValuePair $object */
        foreach ($objects as $object) {
            $value = $object->getValue();

            /* array is expected */
            if (empty($value)) {
                $rootProperty = $this->createCrawler($object->getContext());
                $defaultValue = [];

                foreach ($rootProperty->filterXPath('node()/text()') as $textNode) {
                    $defaultValue[] = $textNode->nodeValue;
                }

                $value = $this->getPropertyValue($rootProperty, 'value', $defaultValue);
            } else {
                $value = $this->convertValue('value', $value);
            }

            $object->setValue($value);
        }

        return $objects;
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     * @return mixed
     */
    protected function convertValue($propertyName, $value)
    {
        if ($propertyName == 'value') {
            if (is_array($value)) {
                $value = implode('', $value);
            }

            if (0 === strpos($value, 'mailto:')) {
                $value = substr($value, 7);
            }
        }

        return parent::convertValue($propertyName, $value);
    }
}
