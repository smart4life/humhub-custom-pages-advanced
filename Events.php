<?php
/**
 * Custom Pages Advanced
 * @link https://github.com/smart4life/humhub-custom-pages-advanced
 * @license https://github.com/smart4life/humhub-custom-pages-advanced/blob/main/docs/LICENCE.md
 */

namespace humhub\modules\customPagesAdvanced;


use humhub\modules\admin\permissions\ManageSettings;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\modules\custom_pages\helpers\Url;
use humhub\modules\custom_pages\models\Page;
use humhub\modules\custom_pages\permissions\ManagePages;
use humhub\modules\customPagesAdvanced\models\AdvancedPage;
use humhub\modules\ui\menu\MenuLink;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\StringHelper;

class Events
{
    /**
     * @throws Throwable
     * @throws InvalidConfigException
     */
    public static function onAdminMenuInit($event)
    {
        /** @var AdminMenu $menu */
        $menu = $event->sender;

        /** @var Module $module */
        $module = Yii::$app->getModule('custom-pages-advanced');

        if (!Yii::$app->user->can([ManageSettings::class, ManagePages::class])) {
            return;
        }

        $menu->addEntry(new MenuLink([
            'label' => $module->getName(),
            'icon' => $module->icon,
            'url' => $module->getConfigUrl(),
            'isActive' => MenuLink::isActiveState('custom-pages-advanced', 'page'),
            'sortOrder' => 301,
            'isVisible' => true,
        ]));
    }

    public static function onTopMenuInit($event)
    {
        try {
            foreach (AdvancedPage::findAll(['new_target' => Page::NAV_CLASS_TOPNAV]) as $advancedPage) {
                $page = $advancedPage->page;
                $user = Yii::$app->user->getIdentity();

                if (!$user && !$page->canView()) {
                    continue;
                }

                // Check if the user is member of a group allowed for this page
                $userIsAllowed = false;
                foreach ($user->getSearchAttributes()['groups'] as $groupId) {
                    if (in_array($groupId, $advancedPage->allowed_group_ids)) {
                        $userIsAllowed = true;
                        break;
                    }
                }
                if (!$userIsAllowed) {
                    continue;
                }

                $event->sender->addItem([
                    'label' => Html::encode(StringHelper::truncate($page->title, 25)),
                    'url' => Url::to(['/custom_pages/view', 'id' => $page->id]),
                    'htmlOptions' => ['target' => ($page->in_new_window) ? '_blank' : ''],
                    'icon' => '<i class="fa ' . Html::encode($page->icon) . '"></i>',
                    'isActive' => (Yii::$app->controller->module
                        && Yii::$app->controller->module->id === 'custom_pages'
                        && Yii::$app->controller->id === 'view' && Yii::$app->request->get('id') == $page->id),
                    'sortOrder' => ($page->sort_order != '') ? $page->sort_order : 1000,
                ]);
            }
        } catch (Throwable $e) {
            Yii::error($e);
        }
    }
}