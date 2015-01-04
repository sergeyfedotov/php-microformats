<?php
namespace Fsv\Microformats\Parser;

use Fsv\Microformats\ModelInterface;
use Fsv\Microformats\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyPath;

/**
 * Class AbstractParser
 * @package Fsv\Microformats\Parser
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * @var array
     */
    protected static $singularProperties = [];

    /**
     * @var array
     */
    protected static $pluralProperties = [];

    /**
     * @var array
     */
    protected static $urlProperties = [];

    /**
     * @var array|AbstractParser[]
     */
    private $children = [];

    /**
     * @param string $propertyName
     * @param AbstractParser $parser
     * @return AbstractParser
     */
    public function add($propertyName, AbstractParser $parser)
    {
        $this->children[$propertyName] = $parser;

        return $this;
    }

    /**
     * @return array
     */
    public function children()
    {
        return $this->children;
    }

    /**
     * @return ModelInterface
     */
    abstract public function createObject();

    /**
     * @return string
     */
    abstract public function getRootClassName();

    /**
     * @param string $input
     * @return object[]
     * @throws \Exception
     */
    public function parse($input)
    {
        $objects = [];
        $accessor = new PropertyAccessor();

        foreach (
            $this->createCrawler($input)->filter('.' . $this->getRootClassName())
            as $rootNode
        ) {
            $rootCrawler = $this->createCrawler($rootNode);
            $object = $this->createObject();
            $object->setContext($rootNode);

            foreach (static::$singularProperties as $propertyName) {
                $this->parseProperty($object, $rootCrawler, $accessor, $propertyName, false);
            }

            foreach (static::$pluralProperties as $propertyName) {
                $this->parseProperty($object, $rootCrawler, $accessor, $propertyName, true);
            }

            $objects[] = $object;
        }

        return $objects;
    }

    /**
     * @param ModelInterface $object
     * @param Crawler $rootCrawler
     * @param PropertyAccessor $accessor
     * @param string $propertyName
     * @param bool $plural
     */
    private function parseProperty(ModelInterface $object, Crawler $rootCrawler, PropertyAccessor $accessor, $propertyName, $plural)
    {
        $property = new PropertyPath($this->camelize($propertyName));

        if (!$accessor->isWritable($object, $property)) {
            return;
        }

        if (isset($this->children[$propertyName])) {
            $children = $this->children[$propertyName]->parse(iterator_to_array($rootCrawler));
            $accessor->setValue(
                $object,
                $property,
                $plural ? $children : (isset($children[0]) ? $children[0] : null)
            );
            return;
        }

        $values = [];

        /** @var \DOMElement $element */
        foreach ($rootCrawler->filter('.' . $propertyName) as $element) {
            $values[] = $this->getPropertyValue($this->createCrawler($element), $propertyName);
        }

        if (isset($values[0])) {
            $accessor->setValue($object, $property, $plural ? $values : $values[0]);
        }
    }

    /**
     * @todo HTML5 tags support
     * @todo http://microformats.org/wiki/value-class-pattern
     * @param Crawler $propertyNode
     * @param string $propertyName
     * @param mixed $defaultValue
     * @return null|string
     */
    protected function getPropertyValue(Crawler $propertyNode, $propertyName, $defaultValue = null)
    {
        $nodeName = $propertyNode->nodeName();
        $value = null;

        if ($nodeName == 'abbr') {
            $value = $propertyNode->attr('title');
        } else if (
            ($nodeName == 'a' || $propertyName == 'area')
            && in_array($propertyName, static::$urlProperties)
        ) {
            $value = $propertyNode->attr('href');
        } else if ($nodeName == 'area') {
            $value = $propertyNode->attr('alt');
        } else if ($nodeName == 'img') {
            $value = (string)$propertyNode->attr(in_array($propertyName, static::$urlProperties) ? 'src' : 'alt');
        } else if ($nodeName == 'object' && in_array($propertyName, static::$urlProperties)) {
            $value = $propertyNode->attr('data');
        }

        if (null === $value) {
            $value = $defaultValue;
        }

        if (null === $value) {
            $value = $propertyNode->text();
        }

        return $this->convertValue($propertyName, $value);
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     * @return mixed
     */
    protected function convertValue($propertyName, $value)
    {
        return trim(preg_replace('/\s+/s', ' ', $value));
    }

    /**
     * @param string $input
     * @return Crawler
     */
    protected function createCrawler($input)
    {
        return new Crawler($input);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function camelize($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
}
