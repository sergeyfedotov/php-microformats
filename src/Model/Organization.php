<?php
namespace Fsv\Microformats\Model;

/**
 * Class Organization
 * @package Fsv\Microformats\Model
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class Organization extends AbstractModel
{
    /**
     * @var string
     */
    private $organizationName;

    /**
     * @var array
     */
    private $organizationUnit;

    /**
     * @param string $organizationName
     * @param array $organizationUnit
     */
    public function __construct($organizationName = null, array $organizationUnit = [])
    {
        $this->organizationName = $organizationName;
        $this->organizationUnit = $organizationUnit;
    }

    /**
     * @param string $organizationName
     * @return Organization
     */
    public function setOrganizationName($organizationName)
    {
        $this->organizationName = $organizationName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * @param array $organizationUnit
     * @return Organization
     */
    public function setOrganizationUnit(array $organizationUnit)
    {
        $this->organizationUnit = $organizationUnit;

        return $this;
    }

    /**
     * @return array
     */
    public function getOrganizationUnit()
    {
        return $this->organizationUnit;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'ORG:' . $this->organizationName . ';' . implode(';', $this->organizationUnit);
    }
}
