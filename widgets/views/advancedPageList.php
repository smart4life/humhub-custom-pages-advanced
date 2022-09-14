<?php

use humhub\modules\custom_pages\helpers\Url;
use humhub\modules\custom_pages\models\CustomContentContainer;
use humhub\widgets\Button;
use humhub\widgets\GridView;
use humhub\widgets\Link;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\helpers\Html;

/* @var $this \humhub\modules\ui\view\components\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $target \humhub\modules\custom_pages\models\Target */
/* @var $pageType string */

?>

<div class="target-page-list <?= Html::encode($target->id) ?>">
    <div class="target-page-list-head">
        <strong><?= $target->icon ? '<i class="fa ' . Html::encode($target->icon) . '"></i> ' : '' ?><?= Html::encode($target->name) ?></strong>
        <?= Button::success()->icon('fa-plus')->right()->link(Url::toChooseContentType($target, $pageType))->xs(); ?>
    </div>
    <div class="target-page-list-grid">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}{pager}',
            'columns' => [
                [
                    'class' => DataColumn::class,
                    'label' => Yii::t('CustomPagesModule.base', 'Title'),
                    'format' => 'raw',
                    'value' => function ($data) {
                        /*  @var $data CustomContentContainer */
                        return Link::to(Html::encode($data->getTitle()), $data->getUrl())->icon(Html::encode($data->icon));
                    }
                ],
                [
                    'class' => DataColumn::class,
                    'label' => Yii::t('CustomPagesModule.base', 'Type'),
                    'headerOptions' => ['style' => 'width:10%'],
                    'value' => function ($data) {
                        /*  @var $data CustomContentContainer */
                        return $data->getContentType()->getLabel();
                    }
                ],
                [
                    //'header' => 'Actions',
                    'class' => ActionColumn::class,
                    'header' => Yii::t('CustomPagesAdvancedModule.base', 'Settings'),
                    'options' => ['width' => '80px'],
                    'buttons' => [
                        'update' => function ($url, $model) {
                            /*  @var $model CustomContentContainer */
                            return Link::primary()->icon('fa-pencil')->link($model->getEditUrl())->xs()->right();
                        },
                        'view' => function ($url, $model) {
                            return;
                            /*  @var $model CustomContentContainer */
                            return Link::primary()->icon('fa-eye')->link($model->getUrl())->xs()->right();
                        },
                        'delete' => function () {
                            return;
                        },
                    ],
                ],
                [
                    'class' => DataColumn::class,
                    'label' => Yii::t('CustomPagesAdvancedModule.base', 'Advanced settings'),
                    'format' => 'raw',
                    'value' => function ($data) {
                        /*  @var $data CustomContentContainer */
                        return Button::primary()->icon('gear')->link(['custom-page', 'pageId' => $data->id])->xs()->right();
                    }
                ],
            ]
        ]) ?>
    </div>
</div>
