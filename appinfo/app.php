<?php
/**
 * ownCloud - inactiveapps
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Bernhard Posselt 2015
 */

use OCP\AppFramework\App;

$app = new App('inactiveapps');
$container = $app->getContainer();
$service = $container->query('OCA\InactiveApps\Service\InactiveAppsService');
$service->logRequest();