<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'notebooks', 'action' => 'dashboard'));
Router::connect('/dashboard/both/*', array('controller' => 'notebooks', 'action' => 'selectboth'));
Router::connect('/dashboard/group/*', array('controller' => 'notebooks', 'action' => 'selectgroup'));
Router::connect('/dashboard/notebook/*', array('controller' => 'notebooks', 'action' => 'selectnotebook'));
Router::connect('/dashboard/note/*', array('controller' => 'notebooks', 'action' => 'selectnote'));
Router::connect('/dashboard/newnote/*', array('controller' => 'notebooks', 'action' => 'newnote'));
Router::connect('/dashboard/editnote/*', array('controller' => 'notebooks', 'action' => 'editnote'));
Router::connect('/dashboard/newgroup/*', array('controller' => 'groups', 'action' => 'add'));
Router::connect('/dashboard/newnotebook/*', array('controller' => 'notebooks', 'action' => 'add'));
Router::connect('/dashboard/*', array('controller' => 'notebooks', 'action' => 'dashboard'));

/*
Router::connect('/dashboard/select/both/*', array('controller' => 'notebooks', 'action' => 'selectboth'));
Router::connect('/dashboard/select/group/*', array('controller' => 'notebooks', 'action' => 'selectgroup'));
Router::connect('/dashboard/select/notebook/*', array('controller' => 'notebooks', 'action' => 'selectnotebook'));
*/

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
