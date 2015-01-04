<?php
namespace Fsv\Microformats\Parser;

use Fsv\Microformats\Model\Organization;

/**
 * Class OrganizationParser
 * @package Fsv\Microformats\Parser
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class OrganizationParser extends AbstractParser
{
    /**
     * @var array
     */
    protected static $singularProperties = [
        'organization-name',
        'organization-unit'
    ];

    /**
     * @return Organization
     */
    public function createObject()
    {
        return new Organization();
    }

    /**
     * @return string
     */
    public function getRootClassName()
    {
        return 'org';
    }

    /**
     * @param string $input
     * @return Organization[]
     */
    public function parse($input)
    {
        $objects = parent::parse($input);

        /** @var Organization $object */
        foreach ($objects as $object) {
            if (null === $object->getOrganizationName()) {
                $rootProperty = $this->createCrawler($object->getContext());

                $value = '';
                foreach ($rootProperty->filterXPath('node()/text()') as $textNode) {
                    $value .= ' ' . $textNode->nodeValue;
                }

                $object->setOrganizationName($this->convertValue('organization-name', $value));
            }
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

            return $value;
        }

        return parent::convertValue($propertyName, $value);
    }
}
