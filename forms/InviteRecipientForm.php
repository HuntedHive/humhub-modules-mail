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

/**
 * @package humhub.modules.mail.forms
 * @since 0.5
 */
class InviteRecipientForm extends CFormModel {

    public $recipient;
    public $message; // message

    /**
     * Parsed recipients in array of user objects
     *
     * @var type
     */
    public $recipients = array();

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('recipient', 'required'),
            array('recipient', 'checkRecipient')
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'recipient' => 'Recipient',
        );
    }

    /**
     * Form Validator which checks the recipient field
     *
     * @param type $attribute
     * @param type $params
     */
    public function checkRecipient($attribute, $params) {

        // Check if email field is not empty
        if ($this->$attribute != "") {

            $recipients = explode(",", $this->$attribute);

            foreach ($recipients as $userGuid) {
                $userGuid = preg_replace("/[^A-Za-z0-9\-]/", '', $userGuid);

                // Try load user
                $user = User::model()->findByAttributes(array('guid' => $userGuid));
                if ($user != null) {

                    if ($user->id == Yii::app()->user->id) {
                        $this->addError($attribute, Yii::t('MailModule.forms_InviteRecipientForm', "You cannot send a email to yourself!"));
                    } else {
                        $this->recipients[] = $user;
                    }
                }
            }
        }
    }

    /**
     * Returns an Array with selected recipients
     */
    public function getRecipients() {
        return $this->recipients;
    }

}
