<?php
namespace Hotspot\Models;

class SurferEventModel extends CoreModel
{

    public function createTable()
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix . 'surfer_event_participation';

        $sql = '
            CREATE TABLE `' . $tableName . '` (
                `surfer_id` int(8) unsigned NOT NULL,
                `event_id` int(8) unsigned NOT NULL,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NULL
          );
        ';

        // inclusion des fonctions nécessaire pour modifier la bdd
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        // IMPORTANT E10 Table custom : création d'une nouvelle table
        dbDelta($sql);


        $primaryKeySQL = 'ALTER TABLE `' . $tableName . '` ADD PRIMARY KEY `surfer_id_event_id` (`surfer_id`, `event_id`)';
        $this->wpdb->query($primaryKeySQL);

    }

    public function dropTable()
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix.'surfer_event_participation';

        $sql = 'DROP TABLE `' . $tableName . '`';
        $this->wpdb->query($sql);
    }
}

