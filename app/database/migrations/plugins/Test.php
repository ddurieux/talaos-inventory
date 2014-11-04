<?php

class Test {

    function schema_glpi_assettypes($table) {
        $table->string('plugin_test_other')->nullable();
        $table->dropColumn('comment');
    }

}
