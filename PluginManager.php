<?php
/*
 * Copyright(c) 2018 Daisy Inc. All Rights Reserved.
 *
 * This software is released under the MIT license.
 * http://opensource.org/licenses/mit-license.php
 */

namespace Plugin\NemPaymentCheck;

use Eccube\Application;
use Eccube\Common\Constant;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\NemPaymentCheck\Exception\ExtensionRequiredException;
use Plugin\NemPaymentCheck\Exception\SystemRequirementNotMetException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PluginManager extends AbstractPluginManager
{
    /**
     * @param $config
     * @param Application $app
     * @throws SystemRequirementNotMetException
     */
    public function enable($config, $app)
    {
        $app->on(KernelEvents::EXCEPTION, function (GetResponseForExceptionEvent $event) use ($app) {
            $e = $event->getException();
            $app->addError($e->getMessage(), 'admin');
            $event->setResponse($app->redirect($app->url('admin_store_plugin')));
        });

        if (version_compare(Constant::VERSION, '3.0.11') < 0) {
            throw new SystemRequirementNotMetException('EC-CUBE 3.0.11 or more recent version is required.');
        }

        if (!extension_loaded('bcmath')) {
            throw new ExtensionRequiredException('BC Math');
        }

        if (!extension_loaded('dom')) {
            throw new ExtensionRequiredException('DOM');
        }
    }
}
