<?php

/**
 * Custom Pages Advanced
 * @link https://github.com/smart4life/humhub-custom-pages-advanced
 * @license https://github.com/smart4life/humhub-custom-pages-advanced/blob/main/docs/LICENCE.md
 */

namespace humhub\modules\customPagesAdvanced;

use humhub\modules\custom_pages\permissions\ManagePages;
use humhub\modules\customPagesAdvanced\permissions\CanUseModuleModel;
use Yii;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{
    /**
     * @var string defines the icon
     */
    public $icon = 'file-text-o';

    /**
     * @var string defines path for resources, including the screenshots path for the marketplace
     */
    public $resourcesPath = 'resources';


    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to([
            '/custom-pages-advanced/page',
        ]);
    }

    /**
     * @inerhitdoc
     */
    public function getName()
    {
        return Yii::t('CustomPagesAdvancedModule.config', 'Custom Pages Advanced');
    }

    /**
     * @inerhitdoc
     */
    public function getDescription()
    {
        return Yii::t('CustomPagesAdvancedModule.config', '');
    }

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        if (!$contentContainer) {
            return [
                new ManagePages(),
            ];
        }

        return [];
    }
}
