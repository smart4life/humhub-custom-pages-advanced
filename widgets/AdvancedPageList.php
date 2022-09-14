<?php
/**
 * Custom Pages Advanced
 * @link https://github.com/smart4life/humhub-custom-pages-advanced
 * @license https://github.com/smart4life/humhub-custom-pages-advanced/blob/main/docs/LICENCE.md
 */

namespace humhub\modules\customPagesAdvanced\widgets;


use humhub\modules\custom_pages\interfaces\CustomPagesService;
use humhub\modules\custom_pages\models\Page;
use humhub\modules\custom_pages\models\PageType;
use humhub\modules\custom_pages\widgets\TargetPageList;
use yii\data\ActiveDataProvider;

class AdvancedPageList extends TargetPageList
{
    /**
     * @inheritdoc
     * @throws \yii\base\Exception
     * @throws \Throwable
     */
    public function run()
    {
        $customPagesService = new CustomPagesService();
        $this->pageType = PageType::Page;
        $this->target = $customPagesService->getTargetById(Page::NAV_CLASS_EMPTY, $this->pageType);

        $dataProvider = new ActiveDataProvider([
            'query' => $customPagesService->findContentByTarget($this->target->id, $this->pageType, $this->target->container),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        return $this->render('advancedPageList', ['target' => $this->target, 'dataProvider' => $dataProvider, 'pageType' => $this->pageType]);
    }

}