<?php

/* 
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

include '../bootstrap.php';

if (MAINTENANCE && !isset($_SESSION['permissions']->admin_login->view)) {
	require_once "../app/views/pages/maintenance.php";
	die('');
} else {
	//init Core Library
	$init = new Core();
}
