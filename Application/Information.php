<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application;

class Information
{
	protected $app;

	private $wampserverConf;

	/**
	 * Constructor.
	 *
	 * @param Application $app
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function getWampserverVersion()
	{
		return $this->getWampserverConf()['wampserverVersion'];
	}

	public function getWampserverInstallDir()
	{
		return $this->getWampserverConf()['installDir'];
	}

	public function getApacheVersion()
	{
		return $this->getWampserverConf()['apacheVersion'];
	}

	public function getMysqlVersion()
	{
		return $this->getWampserverConf()['mysqlVersion'];
	}

	public function getPhpVersion()
	{
		return $this->getWampserverConf()['phpVersion'];
	}

	public function getPhpExtensions()
	{
		$extensions = get_loaded_extensions();
		natcasesort($extensions);

		return $extensions;
	}

	private function getWampserverConf()
	{
		if (null === $this->wampserverConf)
		{
			$conf_filename = $this->app['wampserver_dir'] . '/wampmanager.conf';

			if (!file_exists($conf_filename)) {
				throw new \RuntimeException('Unable to load %s file');
			}

			$this->wampserverConf = parse_ini_file($conf_filename);
		}

		return $this->wampserverConf;
	}
}
