<?php
/*
 * This file is part of myTinyLocalHost.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application;

use Application\Provider\FinderServiceProvider;
use Symfony\Component\Templating\Asset\PathPackage;
use Tao\Application as TaoApplication;
use Tao\Provider\DatabaseServiceProvider;
use Tao\Provider\TranslatorServiceProvider;
use Tao\Translator\TemplatingHelper;

class Application extends TaoApplication
{
	public function __construct($loader, array $config = [], array $classMap = [])
	{
		parent::__construct($loader, $config, __DIR__, $classMap);

		# Enregistrement des services additionnels
		$this->register(new DatabaseServiceProvider());
		$this->register(new FinderServiceProvider());
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
}
