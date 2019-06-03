<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $source
 */
class Cv extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'source'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'source'], 'string', 'max' => 255],
            [['source'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'source' => 'Source',
        ];
    }
}
