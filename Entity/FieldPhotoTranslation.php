<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 */
class FieldPhotoTranslation implements EntityInterface
{
    use TimestampableEntity;
    use ORMBehaviors\Translatable\Translation;
    use BasicFieldTypeTranslation;

//    /**
//     * @var Media
//     *
//     * @ORM\ManyToOne(targetEntity="MediaBundle\Entity\Media", cascade={"persist"})
//     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
//     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
//     */
//    private $photo;
//
//    /**
//     * Set photo
//     *
//     * @param Media $photo
//     *
//     * @return FieldPhotoTranslation
//     */
//    public function setPhoto(Media $photo = null)
//    {
//        $this->photo = $photo;
//
//        return $this;
//    }
//
//    /**
//     * Get photo
//     *
//     * @return Media
//     */
//    public function getPhoto()
//    {
//        return $this->photo;
//    }
}
