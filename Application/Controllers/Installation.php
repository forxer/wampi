<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Controllers;

class Installation extends BaseController
{
    protected $values;

    public function form()
    {

        return $this->render('Installation', [
        ]);
    }

    public function process()
    {

    }
}
