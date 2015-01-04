<?php
namespace Fsv\Microformats\Parser;

use Fsv\Microformats\Model\ContactName;

/**
 * Class ContactNameParser
 * @package Fsv\Microformats\Parser
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class ContactNameParser extends AbstractParser
{
    /**
     * @var array
     */
    protected static $singularProperties = [
        'family-name',
        'given-name',
        'additional-name',
        'honorific-prefix',
        'honorific-suffix'
    ];

    /**
     * @return ContactName
     */
    public function createObject()
    {
        return new ContactName();
    }

    /**
     * @return string
     */
    public function getRootClassName()
    {
        return 'n';
    }
}
