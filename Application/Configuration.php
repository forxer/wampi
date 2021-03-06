<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application;

class Configuration
{
    protected $app;

    protected $customizableFields = [
        'app_name',
        'wampserver_dir',
        'projects_dirs',
        'debug',
        'db_host',
        'db_name',
        'db_user',
        'db_password',
        'pre_releases_update'
    ];

    private $dist;

    private $custom;

    /**
     * Constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Return configuration values from distribution and custom files.
     *
     * @return array
     */
    public function get()
    {
        return $this->getCustom() + $this->getDist();
    }

    /**
     * Get customizable fields names
     *
     * @return array
     */
    public function getCustomizableFieldsNames()
    {
        return $this->customizableFields;
    }

    public function getCustomizableFieldsFromConfig()
    {
        $fields = [];

        foreach ($this->getCustomizableFieldsNames() as $fieldName) {
            $fields[$fieldName] = isset($this->app[$fieldName]) ? $this->app[$fieldName] : null;
        }

        return $fields;
    }

    /**
     * Validate data for custom configuration.
     *
     * @param array $newConfig
     * @return array Validated data.
     */
    public function validate($newConfig)
    {
        $validated = $this->performValidation($newConfig);

        $validated = $this->removeUnstorable($validated);

        return $validated;
    }

    /**
     * Save custom configuration into the configuration file.
     *
     * @param array $newConfig
     */
    public function save(array $newConfig)
    {
        # if no data to store, remove file
        if (empty($newConfig)) {
            $this->app['filesystem']->remove($this->getConfigFilename());
        }
        else
        {
            $content =
                '<?php' . "\n\n" .
                'return ' .
                var_export($newConfig, true) .  ";\n\n";

            $this->app['filesystem']->dumpFile($this->getConfigFilename(), $content);
        }
    }

    /**
     * Return an array of configuration values without values to not store.
     *
     * In fact, return values ​​that are different from the distribution values
     * and are not in customizable values list.
     *
     * @param array $newConfig
     * @return array
     */
    private function removeUnstorable(array $newConfig = [])
    {
        $distConfig = $this->getDist();

        $toStore = $this->getCustom();

        foreach ($newConfig as $k => $v)
        {
            if (!in_array($k, $this->customizableFields)) {
                unset($toStore[$k]);
            }
            elseif ($v === $distConfig[$k]) {
                unset($toStore[$k]);
            }
            else {
                $toStore[$k] = $v;
            }
        }

        return $toStore;
    }

    /**
     * Perform the validation of new configuration values.
     *
     * @param array $toValidate
     * @return array
     */
    private function performValidation(array $toValidate = [])
    {
        $validated = [];

        if (isset($toValidate['app_name'])) {
            $validated['app_name'] = trim(strip_tags($toValidate['app_name']));
        }

        if (isset($toValidate['debug'])) {
            $validated['debug'] = (boolean)$toValidate['debug'];
        }

        if (isset($toValidate['wampserver_dir']))
        {
            if (!is_dir($toValidate['wampserver_dir']))
            {
                $this->app['instantMessages']->error(
                    sprintf($this->app['translator']->trans('error.missing.www'), $toValidate['wampserver_dir'])
                );
            }
            elseif (!is_writable($toValidate['wampserver_dir']))
            {
                $this->app['instantMessages']->error(
                    sprintf($this->app['translator']->trans('error_unwritable_www'), $toValidate['wampserver_dir'])
                );
            }
            else {
                $validated['wampserver_dir'] = $toValidate['wampserver_dir'];
            }
        }

        if (isset($toValidate['projects_dirs']))
        {
            $validated['projects_dirs'] = [];

            foreach (explode(PATH_SEPARATOR, $toValidate['projects_dirs']) as $dir)
            {
                $dir = trim($dir);

                if (!is_dir($dir))
                {
                    $this->app['instantMessages']->error(
                        sprintf($this->app['translator']->trans('error.missing.www'), $dir)
                    );
                }
                elseif (!is_writable($dir))
                {
                    $this->app['instantMessages']->error(
                        sprintf($this->app['translator']->trans('error_unwritable_www'), $dir)
                    );
                }
                else {
                    $validated['projects_dirs'][] = $dir;
                }
            }

            $validated['projects_dirs'] = implode(PATH_SEPARATOR, $validated['projects_dirs']);
        }

        if (isset($toValidate['db_host'])) {
            $validated['db_host'] = trim(strip_tags($toValidate['db_host']));
        }

        if (isset($toValidate['db_name'])) {
            $validated['db_name'] = trim(strip_tags($toValidate['db_name']));
        }

        if (isset($toValidate['db_user'])) {
            $validated['db_user'] = trim(strip_tags($toValidate['db_user']));
        }

        if (isset($toValidate['db_password'])) {
            $validated['db_password'] = trim(strip_tags($toValidate['db_password']));
        }

        if (isset($toValidate['pre_releases_update'])) {
            $validated['pre_releases_update'] = (boolean)$toValidate['pre_releases_update'];
        }

        return $validated;
    }

    /**
     * Return configuration filename.
     *
     * @return string
     */
    private function getConfigFilename()
    {
        return __DIR__ . '/Config/config.php';
    }

    /**
     * Return the array of the distribution configuration values.
     *
     * @return array
     */
    private function getDist()
    {
        if (null === $this->dist) {
            $this->dist = require __DIR__ . '/Config/dist.php';
        }

        return $this->dist;
    }

    /**
     * Return the array of the custom configuration values.
     *
     * @return array
     */
    private function getCustom()
    {
        if (null === $this->custom)
        {
            $this->custom = [];

            if (file_exists($this->getConfigFilename())) {
                $this->custom = require $this->getConfigFilename();
            }
        }

        return $this->custom;
    }
}
