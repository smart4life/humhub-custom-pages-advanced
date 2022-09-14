<?php
/**
 * Custom Pages Advanced
 * @link https://github.com/smart4life/humhub-custom-pages-advanced
 * @license https://github.com/smart4life/humhub-custom-pages-advanced/blob/main/docs/LICENCE.md
 */

namespace humhub\modules\customPagesAdvanced\models;

use humhub\components\ActiveRecord;
use humhub\modules\custom_pages\models\Page;
use Yii;
use yii\behaviors\AttributeTypecastBehavior;
use yii\db\ActiveQuery;
use yii\helpers\Json;

/**
 * This is the model class for table "custom-pages-advanced".
 *
 * @property int $id
 * @property int $custom_pages_page_id
 * @property string $new_target
 * @property string $allowed_group_ids
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Page $page
 */
class AdvancedPage extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'custom_pages_advanced_page';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'custom_pages_page_id' => Yii::t('CustomPagesAdvancedModule.base', 'Custom Page'),
            'new_target' => Yii::t('CustomPagesAdvancedModule.base', 'Button location'),
            'allowed_group_ids' => Yii::t('CustomPagesAdvancedModule.base', 'Allowed groups'),
            'created_at' => Yii::t('UserModule.base', 'Created at'),
            'created_by' => Yii::t('UserModule.base', 'Created by'),
            'updated_at' => Yii::t('UserModule.base', 'Updated at'),
            'updated_by' => Yii::t('UserModule.base', 'Updated by'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_pages_page_id'], 'required'],
            [['custom_pages_page_id'], 'integer'],
            [['new_target'], 'string', 'max' => 255],
            [['allowed_group_ids'], 'safe'],
        ];
    }

    /**
     * Compose automatically 'attributeTypes' according to `rules()` to maintain strict attribute types after model validation.
     * Avoid having changed attributes in `afterSave()` $changedAttributes if they are not string
     * https://www.yiiframework.com/doc/api/2.0/yii-behaviors-attributetypecastbehavior
     * If saving from a form and the value can be null, you need to typecast '' value to null in a beforeValidate() method
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'typecast' => [
                'class' => AttributeTypecastBehavior::class,
            ],
        ];
    }

    /**
     * @return void
     */
    protected function jsonDecodeAttr()
    {
        $this->allowed_group_ids = is_array($this->allowed_group_ids) ?
            $this->allowed_group_ids :
            (array)Json::decode($this->allowed_group_ids);
    }

    /**
     * @return void
     */
    protected function jsonEncodeAttr()
    {
        $this->allowed_group_ids = is_array($this->allowed_group_ids) ?
            Json::encode($this->allowed_group_ids) :
            $this->allowed_group_ids;
    }

    /**
     * @inerhitdoc
     */
    public function afterFind()
    {
        $this->jsonDecodeAttr();
        parent::afterFind();
    }

    /**
     * @inerhitdoc
     */
    public function beforeSave($insert)
    {
        $this->jsonEncodeAttr();
        return parent::beforeSave($insert);
    }

    /**
     * @inerhitdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->jsonDecodeAttr();
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return ActiveQuery
     */
    public function getPage()
    {
        return $this
            ->hasOne(Page::class, ['id' => 'custom_pages_page_id']);
    }
}