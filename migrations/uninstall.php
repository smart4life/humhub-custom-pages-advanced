<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
        $this->dropTable('custom_pages_advanced_page');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }

}
