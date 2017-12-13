<?php
namespace PunktDe\SentryAddin\Configurator;

use Neos\Flow\Annotations as Flow;

use Neos\Utility\Files;

/**
 * @Flow\Scope("singleton")
 */
class SentryClientConfigurator
{
    /**
     * @var string
     */
    protected $environment = '';

    /**
     * @var string
     */
    protected $release = '';

    /**
     * @param \Raven_Client $client
     */
    public function configureMy(\Raven_Client $client)
    {
        $client->setEnvironment($this->getEnvironment());
        $client->setRelease($this->getRelease());
        $client->setAppPath($this->getAppPath());
    }

    /**
     * return string
     */
    protected function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @return string
     */
    protected function getRelease(): string
    {
        if (!empty($this->release)) {
            return $this->release;
        }
        $filepath = Files::concatenatePaths([FLOW_PATH_ROOT, 'RELEASE']);
        if (is_readable($filepath)) {
            $file = fopen($filepath, 'r');
            $this->release = trim(fgets($file));
            fclose($file);
        }
        return $this->release;
    }

    /**
     * @return string
     */
    protected function getAppPath(): string
    {
        return FLOW_PATH_ROOT;
    }

    /**
     * @param array $settings
     */
    public function injectSettings(array $settings) {
        $this->environment = isset($settings['environment']) ? $settings['environment'] : '';
    }
}
