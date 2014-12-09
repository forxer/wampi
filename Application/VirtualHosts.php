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

    protected $cacheFilename;

    protected $dir;

    public function __construct(Application $app, $dir = null)
    {
        $this->app = $app;

        $this->cacheFilename = __DIR__ . '/Storage/Cache/vhost.php';

        if (null === $dir) {
            $dir = $this->app['wampserver_dir'] . '/vhosts';
        }

        $this->setDir($dir);
    }

    public function getDir()
    {
        return $this->dir;
    }

    public function setDir($dir)
    {
        $this->dir = $dir;
    }

    public function addVirtualHost($project, $filename, $url, array $options = [])
    {
        $file = $this->getDir() . '/' . $filename;

        if (!file_exists($file))
        {
            file_put_contents($file, sprintf($this->getFilePattern(), $url, $project['path']));
        }
    }

    public function getVirtualHosts()
    {
        if (null === $this->vhosts)
        {
            if (file_exists($this->cacheFilename) && (filemtime($this->cacheFilename) > (time() - $this->app['vhosts_cache_ttl'])))
            {
                $this->vhosts = require $this->cacheFilename;
            }
            else
            {
                $this->vhosts = $this->getVirtualHostsDataFromFiles();

                $data = "<?php\n\n" . 'return ' . var_export($this->vhosts, true) . ";\n";

                file_put_contents($this->cacheFilename, $data, LOCK_EX);
            }
        }

        return $this->vhosts;
    }

    protected function getVirtualHostsDataFromFiles()
    {
        $vhosts = [];

        $finder = $this->app['finder']
            ->files()
            ->in($this->getDir())
            ->name('*.conf')
            ->depth('== 0')
        ;

        foreach ($finder as $finded)
        {
            $parsed = $this->parseVirtualHostsFile($finded);

            $vhosts[$parsed['DocumentRoot']] = $parsed['ServerName'];
        }

        return $vhosts;
    }

    protected function parseVirtualHostsFile($file)
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
                $vhost['DocumentRoot'] = realpath($match[1]);
            }
        }

        return $vhost;
    }

    protected function getFilePattern()
    {
        return <<<'EOT'
<VirtualHost *:80>
  ServerName %1$s
  DocumentRoot %2$s
  <Directory "%2$s">
    Options Indexes FollowSymLinks MultiViews
    AllowOverride all
  </Directory>
  %3$s
</VirtualHost>
EOT;
    }
}
