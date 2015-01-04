<?php
namespace Fsv\Microformats\Model;

/**
 * Class Geo
 * @package Fsv\Microformats\Model
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class Geo extends AbstractModel
{
    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct($latitude = null, $longitude = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param float|string $latitude
     * @return Geo
     */
    public function setLatitude($latitude)
    {
        $this->latitude = (float)$latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float|string $longitude
     * @return Geo
     */
    public function setLongitude($longitude)
    {
        $this->longitude = (float)$longitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'GEO:' . $this->latitude . ';' . $this->longitude;
    }
}
