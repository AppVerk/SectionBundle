<?php

namespace AppVerk\SectionBundle\Service;

use AppVerk\Components\Doctrine\TranslationEntityInterface;
use AppVerk\SectionBundle\Doctrine\NodeManager;
use AppVerk\SectionBundle\Doctrine\NodeTranslationManager;
use AppVerk\SectionBundle\Doctrine\SectionManager;
use AppVerk\SectionBundle\Entity\Node;
use AppVerk\SectionBundle\Entity\NodeTranslation;
use AppVerk\SectionBundle\Util\ConfigProvider;

class NodesBuilder
{
    /** @var  ConfigProvider */
    private $configProvider;

    /** @var NodeManager */
    private $nodeManager;

    /** @var  SectionManager */
    private $sectionManager;

    /** @var SectionFieldsBuilder */
    private $sectionFieldsBuilder;

    /** @var  NodeTranslationManager */
    private $nodeTranslationManager;

    public function __construct(
        ConfigProvider $configProvider,
        NodeManager $nodeManager,
        SectionManager $sectionManager,
        SectionFieldsBuilder $sectionFieldsBuilder,
        NodeTranslationManager $nodeTranslationManager
    ) {
        $this->configProvider = $configProvider;
        $this->nodeManager = $nodeManager;
        $this->sectionManager = $sectionManager;
        $this->sectionFieldsBuilder = $sectionFieldsBuilder;
        $this->nodeTranslationManager = $nodeTranslationManager;
    }

    public function buildNodes(): bool
    {
        $configNodes = $this->configProvider->getNodeSettings();
        $languages = $this->configProvider->getLanguages();
        foreach ($configNodes as $name => $nodeConfig) {

            $existingNode = $this->nodeTranslationManager->getRepository()->findOneBy(['title' => $name]);

            if ($existingNode) {
                continue;
            }

            $node = new Node();
            if (isset($nodeConfig['system_id'])) {
                $node->setSystemId($nodeConfig['system_id']);
            }
            $node->setAbleToAddSections($nodeConfig['able_to_add_section']);
            $node->setIrremovable($nodeConfig['irremovable']);
            $node->setParent($nodeConfig['parent']);

            foreach ($languages as $language) {
                $node->translate($language['code'], false)->setTitle($name);
                $node->translate($language['code'], false)->setSubtitle($name);
                $node->translate($language['code'], false)->setStatus(NodeTranslation::STATUS_PUBLISHED);
            }
            $node->mergeNewTranslations();
            $this->nodeManager->persist($node);

            $sections = $nodeConfig['sections'];
            $this->buildNodeSections($node, $sections, $languages);
            $this->nodeManager->flush();
        }

        return true;
    }

    private function buildNodeSections(Node $node, $sections, array $languages)
    {
        $position = 1;
        foreach ($sections as $sectionConfig) {
            $sectionModel = $this->configProvider->getSectionModel($sectionConfig['type']);
            $section = new $sectionModel();
            $section->setCustom(false);
            $section->setPosition($position);
            $section->setNode($node);

            if ($section instanceof TranslationEntityInterface) {
                foreach ($languages as $language) {
                    $section->translate($language['code'], false)->setTitle($sectionConfig['title']);
                }
                $section->mergeNewTranslations();
            }
            $this->sectionManager->persist($section);

            $this->sectionFieldsBuilder->buildSectionFields($section, null, $languages);

            $position++;
        }
    }
}
