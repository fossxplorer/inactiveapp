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
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\IRequest;

use OCA\InactiveApps\Db\InactiveAppsMapper;
use OCA\InactiveApps\Db\InactiveApp;

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
        $url = $this->request->server['REQUEST_URI'];
        $regex = '%index.php/apps/(\w+)/?.*%i';

        if (preg_match($regex, $url, $matches) && $matches[1]) {
            try {
                $app = $this->mapper->find($matches[1], $this->userId);
                $app->setLastAccess($this->timeFactory->getTime());
                $this->mapper->update($app);
            } catch (DoesNotExistException $e) {
                $app = new InactiveApp();
                $app->setAppId($matches[1]);
                $app->setUserId($this->userId);
                $app->setLastAccess($this->timeFactory->getTime());
                $this->mapper->insert($app);
            }
        }
    }

}