<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application;

use Application\Provider\DatabaseServiceProvider;
use Symfony\Component\Templating\Asset\PathPackage;
use Tao\Application as TaoApplication;
use Tao\Provider\TranslatorServiceProvider;
use Tao\Translator\TemplatingHelper;

class Application extends TaoApplication
{
    protected $package;

    public function __construct($loader, array $classMap = [])
    {
        $this['configuration'] = function($app) {
            return new Configuration($app);
        };

        $this['projects'] = function($app) {
            return new Projects($app);
        };

        $this['project'] = function($app) {
            return new Project($app);
        };

        $this['informations'] = function($app) {
            return new Information($app);
        };

        $this['virtualhosts'] = function($app) {
            return new VirtualHosts($app);
        };

        parent::__construct($loader, $this['configuration']->get(), __DIR__, $classMap);

        # Enregistrement des services additionnels
        $this->register(new DatabaseServiceProvider());
        $this->register(new TranslatorServiceProvider());

        # Explicitly start session
        $this['session']->start();

        # Chargement du helper de traduction
        $this['templating']->set(new TemplatingHelper($this['translator']));

        # Définition de deux packages d'assets pour les templates :
        # /Assets et /Components
        $this['templating']->get('assets')->addPackage('assets',
            new PathPackage($this['app_url'] . $this['assets_url']));

        $this['templating']->get('assets')->addPackage('components',
            new PathPackage($this['app_url'] . $this['components_url']));

    }

    public function getVersion()
    {
        static $version = null;

        if (null === $version) {
            $version = $this->getPackage()->version;
        }

        return $version;
    }

    public function getHomepage()
    {
        static $homepage = null;

        if (null === $homepage) {
            $homepage = $this->getPackage()->homepage;
        }

        return $homepage;
    }

    protected function getPackage()
    {
        if (null === $this->package) {
            $this->package = json_decode(file_get_contents(__DIR__ . '/../package.json'));
        }

        return $this->package;
    }

    public function clearCache()
    {
        $cache = $this['finder']
            ->notName('.gitkeep')
            ->depth('== 0')
            ->in(__DIR__ . '/Storage/Cache')
        ;

        $this['filesystem']->remove($cache);
    }
}
