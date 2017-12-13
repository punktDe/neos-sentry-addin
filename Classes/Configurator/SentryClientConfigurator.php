<?php
namespace PunktDe\SentryAddin\Configurator;

use Neos\Flow\Annotations as Flow;

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
        $filenames = scandir(FLOW_PATH_ROOT);
        foreach($filenames as $filename) {
            if (strpos($filename, 'RELEASE_') === 0) {
                $this->release = substr($filename, 8);
            }
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
