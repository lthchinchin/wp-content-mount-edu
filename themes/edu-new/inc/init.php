<?php
define('Theme_Name', 'WP');
/*Custom Admin */
require_once(dirname(__FILE__) . '/env.php');
require_once dirname(__FILE__) . '/admin/customize-admin.php';
require_once dirname(__FILE__) . '/admin/admin-init.php';
require_once dirname(__FILE__) . '/functions/database.php';
require_once dirname(__FILE__) . '/functions/theme-setup.php';
require_once dirname(__FILE__) . '/functions/common.php';
require_once dirname(__FILE__) . '/functions/ajax.php';
require_once dirname(__FILE__) . '/functions/wp_bootstrap_navwalker.php';
require_once dirname(__FILE__) . '/functions/post-type-candidate.php';