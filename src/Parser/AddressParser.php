<?php
namespace Fsv\Microformats\Parser;

use Fsv\Microformats\Model\Address;

/**
 * Class AddressParser
 * @package Fsv\Microformats\Parser
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class AddressParser extends TypeValuePairParser
{
    /**
     * @var array
     */
    protected static $singularProperties = [
        'post-office-box',
        'extended-address',
        'street-address',
        'locality',
        'region',
        'postal-code',
        'country-name'
    ];

    /**
     */
    public function __construct()
    {
        parent::__construct('adr', 'INTL');
    }

    /**
     * @return Address
     */
    public function createObject()
    {
        return new Address();
    }

    /**
     * @return string
     */
    public function getRootClassName()
    {
        return 'adr';
    }
}
