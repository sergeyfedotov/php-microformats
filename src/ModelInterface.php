<?php
namespace Fsv\Microformats;

/**
 * Interface ModelInterface
 * @package Fsv\Microformats
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
interface ModelInterface
{
    /**
     * @param \DOMElement $content
     * @return ModelInterface
     */
    public function setContext(\DOMElement $content);

    /**
     * @return \DOMElement
     */
    public function getContext();

    /**
     * @return string
     */
    public function __toString();
}
