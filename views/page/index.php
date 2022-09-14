<?php
/**
 * Custom Pages Advanced
 * @link https://github.com/smart4life/humhub-custom-pages-advanced
 * @license https://github.com/smart4life/humhub-custom-pages-advanced/blob/main/docs/LICENCE.md
 */

use humhub\modules\customPagesAdvanced\Module;
use humhub\modules\customPagesAdvanced\widgets\AdvancedPageList;
use humhub\modules\ui\view\components\View;
use yii\bootstrap\Alert;


/**
 * @var $this View
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
            <?= Alert::widget([
                'options' => ['class' => 'alert-info'],
                'body' =>
                    Yii::t('CustomPagesAdvancedModule.base', 'Choose the page for which you want to add a button from the top menu.') . '<br>' .
                    Yii::t('CustomPagesAdvancedModule.base', 'The available pages are the custom pages without adding to navigation (direct link).')
            ]) ?>

            <?= AdvancedPageList::widget([]) ?>
        </div>
    </div>
</div>