<?php
namespace Fsv\Microformats\Parser;

use DOMNode;
use DOMXPath;
use Fsv\Microformats\Model\ContactName;
use Fsv\Microformats\Model\HCard;
use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class HCardParser
 * @package Fsv\Microformats\Parser
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class HCardParser extends AbstractParser
{
    /**
     * @var array
     */
    protected static $singularProperties = [
        'bday',
        'class',
        'fn',
        'geo',
        'n',
        'org',
        'rev',
        'sequence',
        'sort-string',
        'tz',
        'uid'
    ];

    /**
     * @var array
     */
    protected static $pluralProperties = [
        'adr',
        'category',
        'email',
        'key',
        'label',
        'logo',
        'mailer',
        'nickname',
        'note',
        'photo',
        'role',
        'sound',
        'title',
        'tel',
        'url'
    ];

    /**
     * @var array
     */
    protected static $urlProperties = [
        'logo',
        'photo',
        'sound',
        'url'
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this
            ->add('adr',    new AddressParser())
            ->add('geo',    new GeoParser())
            ->add('n',      new ContactNameParser())
            ->add('org',    new OrganizationParser())
            ->add('tel',    new TypeValuePairParser('tel', 'VOICE'))
            ->add('email',  new TypeValuePairParser('email', 'INTERNET'))
        ;
    }

    /**
     * @return HCard
     */
    public function createObject()
    {
        return new HCard();
    }

    /**
     * @return string
     */
    public function getRootClassName()
    {
        return 'vcard';
    }

    /**
     * @todo Add rel-tag support http://microformats.org/wiki/rel-tag
     * @todo Nested hCard
     * @param string $input
     * @return HCard[]
     */
    public function parse($input)
    {
        $objects = parent::parse($this->removeNested($input));

        /** @var HCard $object */
        foreach ($objects as $object) {
            if (
                null === $object->getN()
                && (
                    null === $object->getOrg()
                    || $object->getFn() !== $object->getOrg()->getOrganizationName()
                )
            ) {
                /* if FN is comma separated */
                if (substr_count($object->getFn(), ',') == 1) {
                    list($familyName, $givenName) = explode(',', $object->getFn());
                    $object->setN(
                        (new ContactName())
                            ->setGivenName(trim($givenName))
                            ->setFamilyName(trim($familyName))
                    );
                /* if FN is space separated */
                } else if (substr_count($object->getFn(), ' ') == 1) {
                    list($givenName, $familyName) = explode(' ', $object->getFn());
                    $object->setN(
                        (new ContactName())
                            ->setGivenName($givenName)
                            ->setFamilyName($familyName)
                    );
                /* if FN is one word */
                } else if (
                    count($object->getNickname()) == 0
                    && preg_match('/^\w+$/', $object->getFn())
                ) {
                    $object->setNickname([$object->getFn()]);
                }
            }
        }

        return $objects;
    }

    /**
     * @param $input
     * @return Crawler
     */
    private function removeNested($input)
    {
        $nodes = [];

        foreach ($this->createCrawler($input) as $rootNode) {
            $xpath = new DOMXPath($rootNode->ownerDocument);
            $query = CssSelector::toXPath('.' . $this->getRootClassName() . ' .' . $this->getRootClassName());

            /** @var DOMNode $nestedNode */
            foreach ($xpath->query($query) as $nestedNode) {
                $nestedNode->parentNode->removeChild($nestedNode);
            }

            $nodes[] = $rootNode;
        }

        return $nodes;
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     * @return mixed
     */
    protected function convertValue($propertyName, $value)
    {
        if ($propertyName == 'bday' || $propertyName == 'rev') {
            return new \DateTime($value);
        }

        return parent::convertValue($propertyName, $value);
    }
}
