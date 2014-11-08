<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application;

class VirtualHosts
{
	protected $app;

	protected $vhosts;

	public function __construct(Application $app)
	{
		$this->app = $app;

		$this->cacheFilename = __DIR__ . '/Storage/Cache/vhost.php';
	}

	public function getVirtualHosts()
	{
		if (null === $this->vhosts)
		{
			$this->vhosts = [];

			$finder = $this->app['finder']
				->files()
				->in($this->app['wampserver_dir'] . '/vhosts')
				->name('*.conf')
				->depth('== 0')
			;

			foreach ($finder as $finded)
			{
				$parsed = $this->parseVirtualHostFile($finded);

				$this->vhosts[$parsed['DocumentRoot']] = $parsed['ServerName'];
			}
		}

		return $this->vhosts;
	}

	protected function parseVirtualHostFile($file)
	{
		$vhost = [];

		$lines = file($file->getRealPath());

		foreach ($lines as $line)
		{
			$line = trim($line);

			if (preg_match('/^\s*ServerName(?:\s+(.*?)|)\s*$/', $line, $match)) {
				$vhost['ServerName'] = $match[1];
			}
			elseif (preg_match('/^\s*DocumentRoot(?:\s+"?(.*?)"?|)\s*$/', $line, $match)) {
				$vhost['DocumentRoot'] = $match[1];
			}
		}

		return $vhost;
	}
}
