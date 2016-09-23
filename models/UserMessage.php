<?php

/**
 * Connected Communities Initiative
 * Copyright (C) 2016  Queensland University of Technology
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences GNU AGPL v3
 *
 */

namespace humhub\modules\mail\models;

use Yii;
use humhub\components\ActiveRecord;
use humhub\modules\mail\models\Message;
use humhub\modules\mail\models\User;

/**
 * This is the model class for table "user_message".
 *
 * The followings are the available columns in table 'user_message':
 * @property integer $message_id
 * @property integer $user_id
 * @property integer $is_originator
 * @property string $last_viewed
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @package humhub.modules.mail.models
 * @since 0.5
 */
class UserMessage extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'user_message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(['message_id', 'user_id'], 'required'),
            array(['message_id', 'user_id', 'is_originator', 'created_by', 'updated_by'], 'integer'),
            array(['last_viewed', 'created_at', 'updated_at'], 'safe'),
        );
    }

    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['id' => 'message_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'message_id' => Yii::t('MailModule.base', 'Message'),
            'user_id' => Yii::t('MailModule.base', 'User'),
            'is_originator' => Yii::t('MailModule.base', 'Is Originator'),
            'last_viewed' => Yii::t('MailModule.base', 'Last Viewed'),
            'created_at' => Yii::t('MailModule.base', 'Created At'),
            'created_by' => Yii::t('MailModule.base', 'Created By'),
            'updated_at' => Yii::t('MailModule.base', 'Updated At'),
            'updated_by' => Yii::t('MailModule.base', 'Updated By'),
        );
    }

    /**
     * Returns the new message count for given User Id
     *
     * @param int $userId
     * @return int
     */
    public static function getNewMessageCount($userId = null)
    {
        if ($userId === null) {
            $userId = Yii::$app->user->id;
        }

        $json = array();

        $query = self::find();
        $query->joinWith('message');
        $query->where(['user_message.user_id' => $userId]);
        $query->andWhere("message.updated_at > user_message.last_viewed OR user_message.last_viewed IS NULL");
        $query->andWhere(["<>", 'message.updated_by', $userId]);

        return $query->count();
    }

}
