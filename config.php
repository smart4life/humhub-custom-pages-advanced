<?php
/**
 * Custom Pages Advanced
 * @link https://github.com/smart4life/humhub-custom-pages-advanced
 * @license https://github.com/smart4life/humhub-custom-pages-advanced/blob/main/docs/LICENCE.md
 */

/** @noinspection MissedFieldInspection */

use humhub\modules\admin\widgets\AdminMenu;
use humhub\modules\customPagesAdvanced\Events;
use humhub\widgets\TopMenu;

return [
    'id' => 'custom-pages-advanced',
    'class' => humhub\modules\customPagesAdvanced\Module::class,
    'namespace' => 'humhub\modules\customPagesAdvanced',
    'events' => [
        ['class' => AdminMenu::class, 'event' => AdminMenu::EVENT_INIT, 'callback' => [Events::class, 'onAdminMenuInit']],
        ['class' => TopMenu::class, 'event' => TopMenu::EVENT_INIT, 'callback' => [Events::class, 'onTopMenuInit']],
    ],
];