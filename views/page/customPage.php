<?php
/**
 * Custom Pages Advanced
 * @link https://github.com/mybionatics/humhub-modules-custom-pages-advanced
 * @license https://github.com/mybionatics/humhub-modules-custom-pages-advanced/blob/master/docs/LICENCE.md
 */

use humhub\libs\Html;
use humhub\modules\custom_pages\models\Page;
use humhub\modules\customPagesAdvanced\models\AdvancedPage;
use humhub\modules\customPagesAdvanced\Module;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\modules\ui\view\components\View;
use humhub\widgets\Button;


/**
 * @var $this View
 * @var $model AdvancedPage
 * @var $availableGroups array
 */

/** @var Module $module */
$module = Yii::$app->getModule('custom-pages-advanced');
?>


<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= $module->getName() ?></strong>
        </div>
        <div class="panel-body">
            <?= Button::back($module->getConfigUrl(), Yii::t('CustomPagesModule.base', 'Back'))->sm(); ?>

            <h4><?= Html::encode($model->page->getTitle()) ?></h4>

            <div class="help-block">
                <?= Yii::t('CustomPagesAdvancedModule.base', 'Here you can configure the advanced settings of your {pageLabel}.', ['pageLabel' => $model->page->getLabel()]) ?>
            </div>

            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'new_target')->dropDownList([Page::NAV_CLASS_TOPNAV => Yii::t('CustomPagesAdvancedModule.base', 'Top Navigation')], ['prompt' => Yii::t('CustomPagesAdvancedModule.base', 'No button')]) ?>
            <?= $form->field($model, 'allowed_group_ids')->checkboxList($availableGroups) ?>
            <?= Html::saveButton() ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>