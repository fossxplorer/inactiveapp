<?php
/**
 * ownCloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Alessandro Cosentino <cosenal@gmail.com>
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Alessandro Cosentino 2012
 * @copyright Bernhard Posselt 2012, 2014
 */

namespace OCA\InactiveApps\Db;

use \OCP\IDb;
use \OCP\AppFramework\Db\Entity;


class InactiveAppsMapper extends NewsMapper {


    public function __construct(IDb $db) {
        parent::__construct($db, 'inactiveapps_apps', '\OCA\InactiveApps\Db\InactiveApp');
    }


    public function find($appId, $userId){
        $sql = 'SELECT * FROM `*PREFIX*inactiveapps_apps` ' .
            'WHERE app_id = ? and user_id = ?';
        $params = [$appId, $userId];

        return $this->findEntity($sql, $params);
    }


}
