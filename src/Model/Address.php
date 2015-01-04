<?php
namespace Fsv\Microformats\Model;

/**
 * Class Address
 * @package Fsv\Microformats\Model
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class Address extends TypeValuePair
{
    /**
     * @var string
     */
    private $postOfficeBox;

    /**
     * @var string
     */
    private $extendedAddress;

    /**
     * @var string
     */
    private $streetAddress;

    /**
     * @var string
     */
    private $locality;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $countryName;

    /**
     * @param string $postOfficeBox
     * @return Address
     */
    public function setPostOfficeBox($postOfficeBox)
    {
        $this->postOfficeBox = $postOfficeBox;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostOfficeBox()
    {
        return $this->postOfficeBox;
    }

    /**
     * @param string $extendedAddress
     * @return Address
     */
    public function setExtendedAddress($extendedAddress)
    {
        $this->extendedAddress = $extendedAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtendedAddress()
    {
        return $this->extendedAddress;
    }

    /**
     * @param string $streetAddress
     * @return Address
     */
    public function setStreetAddress($streetAddress)
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * @param string $locality
     * @return Address
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * @param string $region
     * @return Address
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $countryName
     * @return Address
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'ADR;TYPE='
            . implode(',', $this->type)
            . ':'
            . implode(
                ';',
                [
                    $this->postOfficeBox,
                    $this->extendedAddress,
                    $this->streetAddress,
                    $this->locality,
                    $this->region,
                    $this->postalCode,
                    $this->countryName
                ]
            );
    }
}
