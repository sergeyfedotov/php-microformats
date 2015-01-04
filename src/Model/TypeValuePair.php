<?php
namespace Fsv\Microformats\Model;

/**
 * Class TypeValuePair
 * @package Fsv\Microformats\Model
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class TypeValuePair extends AbstractModel
{
    /**
     * @var array
     */
    protected $type = [];

    /**
     * @var string
     */
    protected $value;

    /**
     * @param $type
     * @param $value
     */
    public function __construct(array $type = [], $value = null)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @param array $type
     * @return TypeValuePair
     */
    public function setType(array $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $value
     * @return TypeValuePair
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'TYPE=' . implode(',', $this->type) . ':' . $this->value;
    }
}
