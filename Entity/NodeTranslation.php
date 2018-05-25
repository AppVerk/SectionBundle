<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @UniqueEntity(
 *     fields={"slug", "locale"},
 *     errorPath="slug",
 *     message="Slug is used for that language"
 * )
 */
class NodeTranslation implements EntityInterface
{
    use TimestampableEntity;
    use ORMBehaviors\Translatable\Translation;

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_HIDDEN = 'hidden';

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $subtitle;

    /**
     * @Gedmo\Slug(fields={"title"}, updatable=true, unique_base="locale")
     * @ORM\Column(length=255, unique=false)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $accessHash;

    public function __construct()
    {
        $this->status = self::STATUS_DRAFT;
        $this->master = false;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function isIrremovable()
    {
        return (bool)$this->translatable->isIrremovable();
    }

    /**
     * @return mixed
     */
    public function getAccessHash()
    {
        return $this->accessHash;
    }

    /**
     * @param mixed $accessHash
     */
    public function setAccessHash($accessHash)
    {
        $this->accessHash = $accessHash;
    }
}
