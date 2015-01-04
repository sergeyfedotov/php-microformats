Microformats 1.0 Parser
================

```php
use Fsv\Microformats\Parser\HCardParser;

$input = <<<HTML
<div class="vcard">
    <a class="fn org url" href="http://example.com">Company Name</a>
    <a class="tel" href="tel:+12223334455">Call Us</a>
</div>
HTML;

$parser = new HCardParser();
$hcard = $parser->parse($input)[0];

print_r($hcard->getOrg());
print_r($hcard->getUrl());
print_r($hcard->getTel());
```

```
Fsv\Microformats\Model\Organization Object
(
    [organizationName:Fsv\Microformats\Model\Organization:private] => Company Name
    [organizationUnit:Fsv\Microformats\Model\Organization:private] => Array
        (
        )

    [context:Fsv\Microformats\Model\AbstractModel:private] => DOMElement Object ...

)
Array
(
    [0] => http://example.com
)
Array
(
    [0] => Fsv\Microformats\Model\TypeValuePair Object
        (
            [type:protected] => Array
                (
                    [0] => VOICE
                )

            [value:protected] => +12223334455
            [context:Fsv\Microformats\Model\AbstractModel:private] => DOMElement Object ...

        )

)
```

Installation
----------------

```
$ composer require fsv/microformats
```
