<?php
namespace Fsv\Microformats\Model;

use DOMElement;
use Fsv\Microformats\ModelInterface;

/**
 * Class AbstractModel
 * @package Fsv\Microformats\Model
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @var DOMElement
     */
    private $context;

    /**
     * @param DOMElement $context
     * @return AbstractModel
     */
    public function setContext(DOMElement $context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return DOMElement
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        if ($this->context instanceof DOMElement) {
            return $this->context->ownerDocument->saveHTML($this->context);
        }

        return '';
    }
}
