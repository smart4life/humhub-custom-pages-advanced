<?php

/**
 * Custom Pages Advanced
 * @link https://github.com/smart4life/humhub-custom-pages-advanced
 * @license https://github.com/smart4life/humhub-custom-pages-advanced/blob/main/docs/LICENCE.md
 */

namespace humhub\modules\customPagesAdvanced\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\admin\permissions\ManageSettings;
use humhub\modules\custom_pages\permissions\ManagePages;
use humhub\modules\customPagesAdvanced\models\AdvancedPage;
use humhub\modules\user\models\Group;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * ConfigController is the module form configuration
 * For administrators only
 */
class PageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function getAccessRules()
    {
        return [
            ['permissions' => [ManageSettings::class, ManagePages::class]],
        ];
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function actionCustomPage($pageId)
    {
        $model = AdvancedPage::findOne(['custom_pages_page_id' => $pageId])
            ?? new AdvancedPage(['custom_pages_page_id' => $pageId]);
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            $this->view->saved();
            $this->redirect(['index']);
        }

        foreach (Group::find()->each() as $group) {
            $availableGroups[$group->id] = $group['name'];
        }

        return $this->render('customPage', [
            'model' => $model,
            'availableGroups' => ArrayHelper::map(Group::find()->all(), 'id', 'name'),
        ]);
    }
}
