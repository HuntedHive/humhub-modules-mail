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

class m150429_190600_indexes extends Migration
{

    public function up()
    {
        $this->createIndex('index_user_id', 'message_entry', 'user_id', false);
        $this->createIndex('index_message_id', 'message_entry', 'message_id', false);
        $this->createIndex('index_updated', 'message', 'updated_at', false);
        $this->createIndex('index_last_viewed', 'user_message', 'last_viewed', false);
        $this->createIndex('index_updated_by', 'message', 'updated_by', false);
    }

    public function down()
    {
        echo "m150429_190600_indexes does not support migration down.\n";
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
