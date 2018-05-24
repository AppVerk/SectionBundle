<?php

namespace AppVerk\SectionBundle\Entity;

trait NavigatedProperty
{
    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : false})
     */
    private $navigated;

    /**
     * @return mixed
     */
    public function isNavigated()
    {
        return $this->navigated;
    }

    /**
     * @param mixed $navigated
     */
    public function setNavigated($navigated)
    {
        $this->navigated = $navigated;
    }
}
