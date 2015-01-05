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

use \OCP\AppFramework\Db\Entity;


class InactiveApp extends Entity {

    protected $userId;
    protected $appId;
    protected $lastAccess;

    public function __construct(){
        $this->addType('lastAccess', 'integer');
    }


}