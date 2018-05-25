<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\EntityInterface;
use AppVerk\Components\Doctrine\TranslatableSupportTrait;
use AppVerk\Components\Doctrine\TranslationEntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 */
class Node implements EntityInterface, TranslationEntityInterface
{
    use TimestampableEntity;
    use TranslatableSupportTrait;
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\Slug(fields={"id", "createdAt"}, updatable=false)
     * @ORM\Column(length=128, unique=true)
     */
    private $systemId;

    /**
     * @ORM\OneToMany(targetEntity="Section", mappedBy="node")
     * @ORM\OrderBy({"position" = "ASC", "id" = "ASC"})
     */
    private $sections;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ableToAddSections;

    /**
     * @ORM\Column(type="boolean")
     */
    private $irremovable;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $parent;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSystemId()
    {
        return $this->systemId;
    }

    /**
     * @param mixed $systemId
     */
    public function setSystemId($systemId)
    {
        $this->systemId = $systemId;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->ableToAddSections = true;
        $this->irremovable = false;
    }

    /**
     * Add section
     *
     * @param Section $section
     *
     * @return Node
     */
    public function addSection(Section $section)
    {
        $this->sections[] = $section;

        return $this;
    }

    /**
     * Remove section
     *
     * @param Section $section
     */
    public function removeSection(Section $section)
    {
        $this->sections->removeElement($section);
    }

    /**
     * Get sections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSections()
    {
        return $this->sections;
    }

    public function setSections($collection)
    {
        $this->sections = $collection;
    }

    /**
     * Set ableToAddSections
     *
     * @param boolean $ableToAddSections
     *
     * @return Node
     */
    public function setAbleToAddSections($ableToAddSections)
    {
        $this->ableToAddSections = $ableToAddSections;

        return $this;
    }

    /**
     * Is ableToAddSections
     *
     * @return boolean
     */
    public function isAbleToAddSections()
    {
        return $this->ableToAddSections;
    }

    /**
     * @return mixed
     */
    public function isIrremovable()
    {
        return $this->irremovable;
    }

    /**
     * @param mixed $irremovable
     */
    public function setIrremovable($irremovable)
    {
        $this->irremovable = $irremovable;
    }

    /**
     * Set parentNode
     *
     * @param string $parent
     *
     * @return Node
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }
}
