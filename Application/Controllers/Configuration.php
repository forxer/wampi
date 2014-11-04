<?php
/*
 * This file is part of myTinyLocalHost.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Controllers;

class Configuration extends BaseController
{
	protected $config;

	public function form()
	{
		if (null === $this->config) {
			$this->config = $this->app['configuration']->getCustomizableFieldsFromConfig();
		}

		return $this->render('Configuration', [
			'config' => $this->config
		]);
	}

	public function process()
	{
		# populate an array with request values
		$newConfig = [];
		foreach ($this->app['configuration']->getCustomizableFieldsNames() as $fieldName) {
			$newConfig[$fieldName] =  $this->app['request']->request->get($fieldName);
		}

		# validate values
		$validated = $this->app['configuration']->validate($newConfig);

		# if no value or error on validation, redirect to form
		if (empty($validated) || $this->app['messages']->hasError())
		{
			# populate config values with collected data merged with current values
			$this->config = $validated + $this->app['configuration']->getCustomizableFieldsFromConfig();

			# return to form view
			return $this->form();
		}

		# save custom values, success message and redirect to form
		$this->app['configuration']->save($validated);

		$this->app['flashMessages']->success($this->app['translator']->trans('config.success'));

		return $this->redirectToRoute('configuration');
	}
}
