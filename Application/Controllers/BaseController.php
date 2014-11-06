<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Controllers;

use Tao\Controller\Controller;

class BaseController extends Controller
{
	public function language()
	{
		$locale = $this->app['request']->attributes->get('locale');

		if (!array_key_exists($locale, $this->app['translator.locales']))
		{
			$this->app['flashMessages']->warning('La locale %locale% n’est pas autorisée.');
		}
		else {
			$this->app['session']->setLanguage($locale);
		}

		return $this->redirectToRoute('projects');
	}
}
