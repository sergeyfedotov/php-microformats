<?php
namespace Fsv\Microformats;

/**
 * Interface ParserInterface
 * @package Fsv\Microformats
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
interface ParserInterface
{
    /**
     * @param string $input
     * @return object[]
     */
    public function parse($input);
}
