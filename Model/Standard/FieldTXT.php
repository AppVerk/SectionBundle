<?php

namespace AppVerk\SectionBundle\Model\Standard;

use AppVerk\Components\Doctrine\EntityInterface;

class FieldTXT extends Field implements EntityInterface
{
    const TYPE_TXT = 'txt';

    /**
     * @var string
     */
    private $body;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    public function __construct()
    {
        $this->type = self::TYPE_TXT;
    }
}
