<?php
namespace PunktDe\SentryAddin;

use Neos\Flow\Package\Package as BasePackage;
use Networkteam\SentryClient\ErrorHandler;
use PunktDe\SentryAddin\Configurator\SentryClientConfigurator;

class Package extends BasePackage
{
    public function boot(\Neos\Flow\Core\Bootstrap $bootstrap) {
        $bootstrap->getSignalSlotDispatcher()->connect('Neos\Flow\Core\Booting\Sequence', 'afterInvokeStep', function($step, $runlevel) use($bootstrap) {
            if ($step->getIdentifier() === 'neos.flow:objectmanagement:runtime') {
                $objectManager = $bootstrap->getObjectManager();
                $client = $objectManager->get(ErrorHandler::class)->getClient();  // This triggers the initializeObject method
                $objectManager->get(SentryClientConfigurator::class)->configureMy($client);
            }
        });
    }
}
