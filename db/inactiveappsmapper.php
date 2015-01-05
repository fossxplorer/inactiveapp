<?php
/**
 * ownCloud - Inactive Apps
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Bernhard Posselt 2014
 */

namespace OCA\InactiveApps\Db;

use \OCP\IDb;
use \OCP\AppFramework\Db\Entity;
use \OCP\AppFramework\Db\Mapper;

class InactiveAppsMapper extends Mapper {


    public function __construct(IDb $db) {
        parent::__construct($db, 'inactiveapps_apps', '\OCA\InactiveApps\Db\InactiveApp');
    }


    public function find($appId, $userId){
        $sql = 'SELECT * FROM `*PREFIX*inactiveapps_apps` ' .
            'WHERE app_id = ? and user_id = ?';
        $params = [$appId, $userId];

        return $this->findEntity($sql, $params);
    }


    public function findAllInactiveUsersForApp($appId, $now, $allowed) {
        $span = $now - $allowed;
        $sql = 'SELECT user_id FROM `*PREFIX*inactiveapps_apps` ' .
            'WHERE app_id = ? and last_access < ?';
        $params = [$appId, $span];

        $result = $this->execute($sql, $params);
        $users = [];

        while($row = $result->fetchRow()) {
            $users[] = $row['user_id'];
        }

        return $users;
    }


}
