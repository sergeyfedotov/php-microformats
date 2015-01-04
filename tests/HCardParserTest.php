<?php
use Fsv\Microformats\Parser\HCardParser;

class HCardParserTest extends PHPUnit_Framework_TestCase
{
    public function testRecognizeHCard()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard"></div>
<div class="vcard"></div>
HTML
);

        $this->assertCount(2, $objects);
        $this->assertArrayHasKey(0, $objects);
        $this->assertArrayHasKey(1, $objects);
        $this->assertInstanceOf('Fsv\Microformats\Model\HCard', $objects[0]);
        $this->assertInstanceOf('Fsv\Microformats\Model\HCard', $objects[1]);
        $this->assertNotSame($objects[0], $objects[1]);
    }

    public function testRecognizeSingularProperties()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="class">Class Name</span>
    <span class="fn">Full Name</span>
    <span class="rev">Revision</span>
    <span class="sequence">Sequence Number</span>
    <span class="sort-string">Sort String</span>
    <span class="tz">Time Zone</span>
    <span class="uid">Unique ID</span>
</div>
HTML
);
        $this->assertEquals('Class Name',       $objects[0]->getClass());
        $this->assertEquals('Full Name',        $objects[0]->getFn());
        $this->assertEquals('Revision',         $objects[0]->getRev());
        $this->assertEquals('Sequence Number',  $objects[0]->getSequence());
        $this->assertEquals('Sort String',      $objects[0]->getSortString());
        $this->assertEquals('Time Zone',        $objects[0]->getTz());
        $this->assertEquals('Unique ID',        $objects[0]->getUid());
    }

    public function testRecognizePluralProperties()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="category">Category 1</span>
    <span class="category">Category 2</span>
    <span class="key">Key 1</span>
    <span class="key">Key 2</span>
    <span class="label">Label 1</span>
    <span class="label">Label 2</span>
    <span class="mailer">Mailer 1</span>
    <span class="mailer">Mailer 2</span>
    <span class="nickname">nickname1</span>
    <span class="nickname">nickname2</span>
    <span class="note">Note 1</span>
    <span class="note">Note 2</span>
    <span class="role">Role 1</span>
    <span class="role">Role 2</span>
    <span class="title">Title 1</span>
    <span class="title">Title 2</span>
</div>
HTML
);

        $this->assertEquals(['Category 1', 'Category 2'],   $objects[0]->getCategory());
        $this->assertEquals(['Key 1', 'Key 2'],             $objects[0]->getKey());
        $this->assertEquals(['Label 1', 'Label 2'],         $objects[0]->getLabel());
        $this->assertEquals(['Mailer 1', 'Mailer 2'],       $objects[0]->getMailer());
        $this->assertEquals(['nickname1', 'nickname2'],     $objects[0]->getNickname());
        $this->assertEquals(['Note 1', 'Note 2'],           $objects[0]->getNote());
        $this->assertEquals(['Role 1', 'Role 2'],           $objects[0]->getRole());
        $this->assertEquals(['Title 1', 'Title 2'],         $objects[0]->getTitle());
    }

    public function testRecognizeUrlProperties()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <img class="logo" src="http://example1.com/logo1.png" />
    <img class="logo" src="http://example2.com/logo2.png" />
    <img class="photo" src="http://example1.com/photo1.jpg" />
    <img class="photo" src="http://example2.com/photo2.jpg" />
    <object class="sound" data="http://example1.com/sound1.mp3"></object>
    <object class="sound" data="http://example2.com/sound2.mp3"></object>
    <a class="url" href="http://example1.com/page1.html">Link 1</a>
    <a class="url" href="http://example2.com/page2.html">Link 2</a>
</div>
HTML
);

        $this->assertEquals(['http://example1.com/logo1.png', 'http://example2.com/logo2.png'], $objects[0]->getLogo());
        $this->assertEquals(['http://example1.com/photo1.jpg', 'http://example2.com/photo2.jpg'], $objects[0]->getPhoto());
        $this->assertEquals(['http://example1.com/sound1.mp3', 'http://example2.com/sound2.mp3'], $objects[0]->getSound());
        $this->assertEquals(['http://example1.com/page1.html', 'http://example2.com/page2.html'], $objects[0]->getUrl());
    }

    public function testRecognizeBday()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <abbr class="bday" title="1986-03-10">10.03.1986</abbr>
</div>
<div class="vcard">
    <span class="bday">20 May 1981<span>
</div>
HTML
);

        $this->assertInstanceOf('DateTime', $objects[0]->getBday());
        $this->assertInstanceOf('DateTime', $objects[1]->getBday());
        $this->assertEquals(new DateTime('1986-03-10'), $objects[0]->getBday());
        $this->assertEquals(new DateTime('1981-05-20'), $objects[1]->getBday());
    }

    public function testRecognizeGeo()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="geo">
        <abbr class="latitude" title="48.816667">N 48° 81.6667</abbr>
        <abbr class="longitude" title="2.366667">E 2° 36.6667</abbr>
    </span>
</div>
HTML
);

        $this->assertInstanceOf('Fsv\Microformats\Model\Geo', $objects[0]->getGeo());
        $this->assertEquals(48.816667, $objects[0]->getGeo()->getLatitude());
        $this->assertEquals(2.366667, $objects[0]->getGeo()->getLongitude());
    }

    public function testRecognizeN()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="n">
        <span class="given-name">Given Name</span>
        <span class="family-name">Family Name</span>
        <span class="additional-name">Additional Name</span>
        <span class="honorific-prefix">Honorific Prefix</span>
        <span class="honorific-suffix">Honorific Suffix</span>
    </span>
</div>
HTML
);

        $this->assertInstanceOf('Fsv\Microformats\Model\ContactName', $objects[0]->getN());
        $this->assertEquals('Given Name',       $objects[0]->getN()->getGivenName());
        $this->assertEquals('Family Name',      $objects[0]->getN()->getFamilyName());
        $this->assertEquals('Additional Name',  $objects[0]->getN()->getAdditionalName());
        $this->assertEquals('Honorific Prefix', $objects[0]->getN()->getHonorificPrefix());
        $this->assertEquals('Honorific Suffix', $objects[0]->getN()->getHonorificSuffix());
    }

    public function testRecognizeOrg()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="org">
        <span class="organization-name">Organization Name</span>
        <span class="organization-unit">Organization Unit</span>
    </span>
</div>
<div class="vcard">
    <span class="org">Organization Name</span>
</div>
HTML
        );

        $this->assertInstanceOf('Fsv\Microformats\Model\Organization', $objects[0]->getOrg());
        $this->assertInstanceOf('Fsv\Microformats\Model\Organization', $objects[1]->getOrg());
        $this->assertEquals('Organization Name', $objects[0]->getOrg()->getOrganizationName());
        $this->assertEquals('Organization Unit', $objects[0]->getOrg()->getOrganizationUnit());
        $this->assertEquals('Organization Name', $objects[1]->getOrg()->getOrganizationName());
        $this->assertNull($objects[1]->getOrg()->getOrganizationUnit());
    }

    public function testRecognizeAdr()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="adr">
        <span class="post-office-box">Post Office Box</span>
        <span class="extended-address">Extended Address</span>
        <span class="street-address">Street Address</span>
        <span class="locality">Locality</span>
        <span class="region">Region</span>
        <span class="postal-code">Postal Code</span>
        <span class="country-name">Country Name</span>
    </span>
</div>
HTML
        );

        $this->assertCount(1, $objects[0]->getAdr());
        $this->assertInstanceOf('Fsv\Microformats\Model\Address', $objects[0]->getAdr()[0]);
        $this->assertEquals('Post Office Box', $objects[0]->getAdr()[0]->getPostOfficeBox());
        $this->assertEquals('Extended Address', $objects[0]->getAdr()[0]->getExtendedAddress());
        $this->assertEquals('Street Address', $objects[0]->getAdr()[0]->getStreetAddress());
        $this->assertEquals('Locality', $objects[0]->getAdr()[0]->getLocality());
        $this->assertEquals('Region', $objects[0]->getAdr()[0]->getRegion());
        $this->assertEquals('Postal Code', $objects[0]->getAdr()[0]->getPostalCode());
        $this->assertEquals('Country Name', $objects[0]->getAdr()[0]->getCountryName());
    }

    public function testRecognizeTel()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="tel">+01112223344</span>
    <span class="tel"><span class="type">home</span> +01112223344</span>
    <span class="tel">
        <span class="type">home</span>
        <span class="type">work</span>
        <span class="value">+01112223344</span>
    </span>
    <span class="tel">
        <span class="type">work</span>
        <span class="value">+0111</span><span class="value">2223344</span>
    </span>
</div>
HTML
        );

        $this->assertCount(4, $objects[0]->getTel());
        $this->assertInstanceOf('Fsv\Microformats\Model\TypeValuePair', $objects[0]->getTel()[0]);
        $this->assertInstanceOf('Fsv\Microformats\Model\TypeValuePair', $objects[0]->getTel()[1]);
        $this->assertInstanceOf('Fsv\Microformats\Model\TypeValuePair', $objects[0]->getTel()[2]);
        $this->assertInstanceOf('Fsv\Microformats\Model\TypeValuePair', $objects[0]->getTel()[3]);
        $this->assertEquals('+01112223344',     $objects[0]->getTel()[0]->getValue());
        $this->assertEquals(['VOICE'],          $objects[0]->getTel()[0]->getType());
        $this->assertEquals('+01112223344',     $objects[0]->getTel()[1]->getValue());
        $this->assertEquals(['home'],           $objects[0]->getTel()[1]->getType());
        $this->assertEquals('+01112223344',     $objects[0]->getTel()[2]->getValue());
        $this->assertEquals(['home', 'work'],   $objects[0]->getTel()[2]->getType());
        $this->assertEquals('+01112223344',     $objects[0]->getTel()[3]->getValue());
        $this->assertEquals(['work'],           $objects[0]->getTel()[3]->getType());
    }

    public function testRecognizeEmail()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="email">user@example.com</span>
    <a class="email" href="mailto:user@example.com">email</a>
    <a class="email" href="mailto:user@example.com"><span class="type">pref</span> email</a>
</div>
HTML
);

        $this->assertCount(3, $objects[0]->getEmail());
        $this->assertInstanceOf('Fsv\Microformats\Model\TypeValuePair', $objects[0]->getEmail()[0]);
        $this->assertInstanceOf('Fsv\Microformats\Model\TypeValuePair', $objects[0]->getEmail()[1]);
        $this->assertInstanceOf('Fsv\Microformats\Model\TypeValuePair', $objects[0]->getEmail()[2]);
        $this->assertEquals('user@example.com', $objects[0]->getEmail()[0]->getValue());
        $this->assertEquals(['INTERNET'],       $objects[0]->getEmail()[0]->getType());
        $this->assertEquals('user@example.com', $objects[0]->getEmail()[1]->getValue());
        $this->assertEquals(['INTERNET'],       $objects[0]->getEmail()[1]->getType());
        $this->assertEquals('user@example.com', $objects[0]->getEmail()[2]->getValue());
        $this->assertEquals(['pref'],           $objects[0]->getEmail()[2]->getType());
    }

    public function testImplyNWithSpaceSeparatedFN()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="fn">Sergey Fedotov</span>
</div>
HTML
);

        $this->assertInstanceOf('Fsv\Microformats\Model\ContactName', $objects[0]->getN());
        $this->assertEquals('Sergey', $objects[0]->getN()->getGivenName());
        $this->assertEquals('Fedotov', $objects[0]->getN()->getFamilyName());
    }

    public function testImplyNWithCommaSeparatedFN()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="fn">Fedotov, Sergey</span>
</div>
HTML
);

        $this->assertInstanceOf('Fsv\Microformats\Model\ContactName', $objects[0]->getN());
        $this->assertEquals('Sergey', $objects[0]->getN()->getGivenName());
        $this->assertEquals('Fedotov', $objects[0]->getN()->getFamilyName());
    }

    public function testImplyNicknameWithOneWordFN()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="fn">nickname</span>
</div>
HTML
);

        $this->assertEquals(['nickname'], $objects[0]->getNickname());
    }

    public function testNotImplyNicknameWithMultipleWordsFN()
    {
        $objects = $this->parseHCard(<<<HTML
<div class="vcard">
    <span class="fn">Sergey Fedotov</span>
</div>
HTML
);

        $this->assertEmpty($objects[0]->getNickname());
    }

    /**
     * @param $input
     * @return \Fsv\Microformats\Model\HCard[]
     */
    private function parseHCard($input)
    {
        return (new HCardParser())->parse($input);
    }
}
