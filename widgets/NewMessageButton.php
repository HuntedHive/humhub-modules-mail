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

namespace humhub\modules\mail\widgets;

use Yii;
use humhub\components\Widget;

/**
 * @package humhub.modules.mail
 * @since   0.5.9
 */
class NewMessageButton extends Widget
{

    public $guid = null;
    public $id = null;
    public $type = 'default';
    public $size = null;

    /**
     * Creates the Wall Widget
     */
    public function run()
    {

        $class = 'btn btn-' . $this->type;
        if (!empty($this->size)) {
            $class .= ' btn-' . $this->size;
        }

        $params = array(
            'guid' => $this->guid,
            'id' => $this->id,
            'class' => $class,
        );

        // if guid is set, then change button label to "Send message"
        if (!empty($this->guid)) {
            $params['buttonLabel'] = Yii::t('MailModule.widgets_views_newMessageButton', 'Send message');
        } else {
            $params['buttonLabel'] = Yii::t('MailModule.widgets_views_newMessageButton', 'New message');
        }

        return $this->render('newMessageButton', $params);
    }

}

?>
