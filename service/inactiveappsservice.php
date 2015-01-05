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

namespace OCA\InactiveApps\Service;

use OCP\AppFramework\Utility\ITimeFactory;
use OCP\IRequest;

use OCA\InactiveApps\Db\InactiveAppsMapper;


class InactiveAppsService {

    private $mapper;
    private $request;
    private $userId;
    private $timeFactory;
    private $webRoot;

    public function __construct(IRequest $request,
                                ITimeFactory $timeFactory,
                                $UserId,
                                $WebRoot,
                                InactiveAppsMapper $mapper) {
        $this->mapper = $mapper;
        $this->request = $request;
        $this->userId = $UserId;
        $this->timeFactory = $timeFactory;
        $this->webRoot = $WebRoot;
    }


    public function logRequest() {
        error_log($this->userId . ' at ' . $this->timeFactory->getTime() .
            ' with url ' . $this->request->server['REQUEST_URI']);
    }

}