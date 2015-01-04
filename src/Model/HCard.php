<?php
namespace Fsv\Microformats\Model;

use DateTime;

/**
 * Class HCard
 * @package Fsv\Microformats\Model
 * @author Sergey Fedotov <sergey89@gmail.com>
 */
class HCard extends AbstractModel
{
    /**
     * @var DateTime
     */
    private $bday;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $fn;

    /**
     * @var Geo
     */
    private $geo;

    /**
     * @var ContactName
     */
    private $n;

    /**
     * @var Organization
     */
    private $org;

    /**
     * @var string
     */
    private $rev;

    /**
     * @var string
     */
    private $sequence;

    /**
     * @var string
     */
    private $sortString;

    /**
     * @var string
     */
    private $tz;

    /**
     * @var string
     */
    private $uid;

    /**
     * @var Address[]
     */
    private $adr = [];

    /**
     * @var array
     */
    private $category = [];

    /**
     * @var TypeValuePair[]
     */
    private $email = [];

    /**
     * @var array
     */
    private $key = [];

    /**
     * @var array
     */
    private $label = [];

    /**
     * @var array
     */
    private $logo = [];

    /**
     * @var array
     */
    private $mailer = [];

    /**
     * @var array
     */
    private $nickname = [];

    /**
     * @var array
     */
    private $note = [];

    /**
     * @var array
     */
    private $photo = [];

    /**
     * @var array
     */
    private $role = [];

    /**
     * @var array
     */
    private $sound = [];

    /**
     * @var array
     */
    private $title = [];

    /**
     * @var TypeValuePair[]
     */
    private $tel = [];

    /**
     * @var array
     */
    private $url = [];

    /**
     * @return array
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param array $url
     */
    public function setUrl(array $url)
    {
        $this->url = $url;
    }

    /**
     * @return array|Address[]
     */
    public function getAdr()
    {
        return $this->adr;
    }

    /**
     * @param Address[] $adr
     */
    public function setAdr(array $adr)
    {
        $this->adr = $adr;
    }

    /**
     * @return DateTime
     */
    public function getBday()
    {
        return $this->bday;
    }

    /**
     * @param DateTime $bday
     */
    public function setBday(DateTime $bday = null)
    {
        $this->bday = $bday;
    }

    /**
     * @return array
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param array $category
     */
    public function setCategory(array $category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return array|TypeValuePair[]
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param TypeValuePair[] $email
     */
    public function setEmail(array $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFn()
    {
        return $this->fn;
    }

    /**
     * @param string $fn
     */
    public function setFn($fn)
    {
        $this->fn = $fn;
    }

    /**
     * @return Geo
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param Geo $geo
     */
    public function setGeo($geo)
    {
        $this->geo = $geo;
    }

    /**
     * @return array
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param array $key
     */
    public function setKey(array $key)
    {
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param array $label
     */
    public function setLabel(array $label)
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param array $logo
     */
    public function setLogo(array $logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return array
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * @param array $mailer
     */
    public function setMailer(array $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return ContactName
     */
    public function getN()
    {
        return $this->n;
    }

    /**
     * @param ContactName $n
     */
    public function setN(ContactName $n = null)
    {
        $this->n = $n;
    }

    /**
     * @return array
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param array $nickname
     */
    public function setNickname(array $nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return array
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param array $note
     */
    public function setNote(array $note)
    {
        $this->note = $note;
    }

    /**
     * @return Organization
     */
    public function getOrg()
    {
        return $this->org;
    }

    /**
     * @param Organization $org
     */
    public function setOrg($org)
    {
        $this->org = $org;
    }

    /**
     * @return array
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param array $photo
     */
    public function setPhoto(array $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getRev()
    {
        return $this->rev;
    }

    /**
     * @param string $rev
     */
    public function setRev($rev)
    {
        $this->rev = $rev;
    }

    /**
     * @return array
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param array $role
     */
    public function setRole(array $role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param string $sequence
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * @return string
     */
    public function getSortString()
    {
        return $this->sortString;
    }

    /**
     * @param string $sortString
     */
    public function setSortString($sortString)
    {
        $this->sortString = $sortString;
    }

    /**
     * @return array
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @param array $sound
     */
    public function setSound(array $sound)
    {
        $this->sound = $sound;
    }

    /**
     * @return array|TypeValuePair[]
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param array $tel
     */
    public function setTel(array $tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return array
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param array $title
     */
    public function setTitle(array $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * @param string $tz
     */
    public function setTz($tz)
    {
        $this->tz = $tz;
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return preg_replace(
            "/\n+/",
            "\n",
            preg_replace(
                '/^[-\w]+:;*$/m',
                '',
                implode(
                    "\n",
                    [
                        'BEGIN:VCARD',
                        'VERSION:3.0',
                        'BDAY:' . ($this->bday !== null ? $this->bday->format(DateTime::ISO8601) : ''),
                        'CLASS:' . $this->class,
                        'FN:' . $this->fn,
                        $this->geo,
                        $this->n,
                        $this->org,
                        'REV:'          . $this->rev,
                        'SEQUENCE:'     . $this->sequence,
                        'SORT-STRING:'  . $this->sortString,
                        'TZ:'           . $this->tz,
                        'UID:'          . $this->uid,
                        implode("\n", $this->adr),
                        'CATEGORY:'     . implode(',', $this->category),
                        'EMAIL:'        . implode("\nEMAIL:", $this->email),
                        'KEY:'          . implode("\nKEY:", $this->key),
                        'LABEL:'        . implode("\nLABEL:", $this->label),
                        'LOGO:'         . implode("\nLOGO:", $this->logo),
                        'MAILER:'       . implode("\nMAILER:", $this->mailer),
                        'NICKNAME:'     . implode("\nNICKNAME:", $this->nickname),
                        'NOTE:'         . implode("\nNOTE:", $this->note),
                        'PHOTO:'        . implode("\nPHOTO:", $this->photo),
                        'ROLE:'         . implode("\nROLE:", $this->role),
                        'SOUND:'        . implode("\nSOUND:", $this->sound),
                        'TITLE:'        . implode("\nTITLE:", $this->title),
                        'TEL:'          . implode("\nTEL:", $this->tel),
                        'URL:'          . implode("\nURL:", $this->url),
                        'END:VCARD'
                    ]
                )
            )
        ) . "\n";
    }
}
