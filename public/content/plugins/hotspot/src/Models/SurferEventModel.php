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

    public function insert($userId, $eventId)
    {
        $data = [
            'surfer_id' => $userId,
            'event_id' => $eventId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->wpdb->insert(
            $this->getTableName(),
            $data
        );

        return true;
    }

    public function getEventsBySurferId($surferId)
    {
        $sql = "
            SELECT * FROM `" . $this->getTableName() . "`
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

    public function getSurfersByEventId($eventId)
    {
        $sql = "
            SELECT * FROM `" . $this->getTableName() . "`
            WHERE
                event_id = %d
        ";

        $preparedStatement = $this->wpdb->prepare(
            $sql,
            [
                $eventId
            ]
        );
        $rows = $this->wpdb->get_results($preparedStatement);
        return $rows;
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

            return true;

    }

    public function deleteByEventId($eventId)
    {
        $conditions = [
            'event_id' => $eventId
        ];

        $this->wpdb->delete(
            $this->getTableName(),
            $conditions
        );
    }

    public function updateDateByEventIdAndSurferId($eventId, $surferId)
    {
        // équivalent du WHERE
        $conditions = [
            'event_id' => $eventId,
            'surfer_id' => $surferId
        ];

        // champs à mettre à jour
        $data = [
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->wpdb->update(
            $this->getTableName(),
            $data,
            $conditions
        );
    }

    public function isParticipating($surferId, $eventId)
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix.'surfer_event_participation';

        $sql = "
            SELECT * FROM `" . $tableName . "`
            WHERE
                surfer_id = %d
            AND
                event_id = %d
        ";

        $preparedStatement = $this->wpdb->prepare(
            $sql,
            [
                $surferId,
                $eventId
            ]
        );
        $rows = $this->wpdb->get_results($preparedStatement);
        if (!empty($rows)) {
            return true;
        } else {
            return false;
        }
    }

}