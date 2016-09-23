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

use yii\db\Migration;

class m131023_165507_initial extends Migration
{

    public function up()
    {

        $this->createTable('user_message', array(
            'message_id' => 'int(11) NOT NULL',
            'user_id' => 'int(11) NOT NULL',
            'is_originator' => 'tinyint(4) DEFAULT NULL',
            'last_viewed' => 'datetime DEFAULT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'created_by' => 'int(11) DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
            'updated_by' => 'int(11) DEFAULT NULL',
                ), '');
        $this->addPrimaryKey('pk_user_message', 'user_message', 'message_id,user_id');


        $this->createTable('message', array(
            'id' => 'pk',
            'title' => 'varchar(255) DEFAULT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'created_by' => 'int(11) DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
            'updated_by' => 'int(11) DEFAULT NULL',
                ), '');

        $this->createTable('message_entry', array(
            'id' => 'pk',
            'message_id' => 'int(11) NOT NULL',
            'user_id' => 'int(11) NOT NULL',
            'file_id' => 'int(11) DEFAULT NULL',
            'content' => 'text NOT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'created_by' => 'int(11) DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
            'updated_by' => 'int(11) DEFAULT NULL',
                ), '');
    }

    public function down()
    {
        echo "m131023_165507_initial does not support migration down.\n";
        return false;
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
