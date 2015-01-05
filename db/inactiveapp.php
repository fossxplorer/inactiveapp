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

use \OCP\AppFramework\Db\Entity;


class InactiveApp extends Entity {

    protected $userId;
    protected $appId;
    protected $lastAccess;

    public function __construct(){
        $this->addType('lastAccess', 'integer');
    }


}