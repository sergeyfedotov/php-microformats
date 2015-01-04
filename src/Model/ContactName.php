<?php
namespace Fsv\Microformats\Model;

/**
 * Class ContactName
 * @package Fsv\Microformats\Model
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class ContactName extends AbstractModel
{
    /**
     * @var string
     */
    private $familyName;

    /**
     * @var string
     */
    private $givenName;

    /**
     * @var string
     */
    private $additionalName;

    /**
     * @var string
     */
    private $honorificPrefix;

    /**
     * @var string
     */
    private $honorificSuffix;

    /**
     * @return string
     */
    public function getAdditionalName()
    {
        return $this->additionalName;
    }

    /**
     * @param string $additionalName
     * @return ContactName
     */
    public function setAdditionalName($additionalName)
    {
        $this->additionalName = $additionalName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * @param string $familyName
     * @return ContactName
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * @return string
     */
    public function getGivenName()
    {
        return $this->givenName;
    }

    /**
     * @param string $givenName
     * @return ContactName
     */
    public function setGivenName($givenName)
    {
        $this->givenName = $givenName;

        return $this;
    }

    /**
     * @return string
     */
    public function getHonorificPrefix()
    {
        return $this->honorificPrefix;
    }

    /**
     * @param string $honorificPrefix
     * @return ContactName
     */
    public function setHonorificPrefix($honorificPrefix)
    {
        $this->honorificPrefix = $honorificPrefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getHonorificSuffix()
    {
        return $this->honorificSuffix;
    }

    /**
     * @param string $honorificSuffix
     * @return ContactName
     */
    public function setHonorificSuffix($honorificSuffix)
    {
        $this->honorificSuffix = $honorificSuffix;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'N:'
            . implode(
                ';',
                [
                    $this->familyName,
                    $this->givenName,
                    $this->additionalName,
                    $this->honorificPrefix,
                    $this->honorificSuffix
                ]
            );
    }
}
