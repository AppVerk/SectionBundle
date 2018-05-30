<?php

namespace AppVerk\SectionBundle\Model\Standard;

use AppVerk\Components\Doctrine\EntityInterface;

class FieldHTML extends Field implements EntityInterface
{
    const TYPE_HTML = 'html';

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
        $this->type = self::TYPE_HTML;
    }
}
