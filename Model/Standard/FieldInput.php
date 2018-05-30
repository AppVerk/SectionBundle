<?php

namespace AppVerk\SectionBundle\Model\Standard;

use AppVerk\Components\Doctrine\EntityInterface;

class FieldInput extends Field implements EntityInterface
{
    const TYPE_INPUT = 'input';

    /**
     * @var string
     */
    private $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    public function __construct()
    {
        $this->type = self::TYPE_INPUT;
    }
}
