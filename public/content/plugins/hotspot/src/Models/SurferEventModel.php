<?php
namespace Hotspot\Models;

class SurferEventModel extends CoreModel
{
    public function getTableName()
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix.'surfer_event_participation';
        return $tableName;
    }

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

    public function insert($eventId, $surferId)
    {
        $data = [
            'surfer_id' => $surferId,
            'event_id' => $eventId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->wpdb->insert(
            $this->getTableName(),
            $data
        );
    }

    // permet de récupérer pour un développeur toutes les technologies qui lui sont associées
    public function getBySurferId($surferId)
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix.'surfer_event_participation';

        // IMPORTANT il faut utiliser des requêtes préparées dès qu'il y a des partie variables dans la requêtes. Sinon vous créez des failles de sécurité
        // %d dans la requête signifie qu'il y aura un nombre injecté à cet endroit
        // DOC E11 WPDB query spécification des types de paramètre attendu https://www.php.net/sprintf (%d == nombre; %s == string)
        $sql = "
            SELECT * FROM `" . $tableName . "`
            WHERE
                surfer_id = %d
        ";

        $preparedStatement = $this->wpdb->prepare(
            $sql,
            [
                $surferId
            ]
        );
        $rows = $this->wpdb->get_results($preparedStatement);

        return $rows;
    }

    public function getBySurferIdAndEventId($surferId, $eventId)
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix.'surfer_event_participation';

        $sql = "
            SELECT * FROM `" . $tableName . "`
            WHERE
                surfer_id = %d
                AND event_id = %d
        ";

        $preparedStatement = $this->wpdb->prepare(
            $sql,
            [
                $surferId,
                $eventId
            ]
        );
        $rows = $this->wpdb->get_results($preparedStatement);

        return $rows;
    }

    public function deleteBySurferId($surferId)
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix.'surfer_event_participation';

        $conditions = [
            'surfer_id' => $surferId, // équivalent à WHERE surfer_id = $surferId
        ];

        $this->wpdb->delete(
            $tableName,
            $conditions
        );
    }

    public function delete($eventId, $surferId)
    {
        $conditions = [
            'surfer_id' => $surferId,
            'event_id' => $eventId
        ];

        $this->wpdb->delete(
            $this->getTableName(),
            $conditions
        );
    }
}

