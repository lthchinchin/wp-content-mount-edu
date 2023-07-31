<?php
define('TEMPLATE_DIR', !empty(getenv("TEMPLATE_DIR")) ? getenv("TEMPLATE_DIR") : get_template_directory_uri());
define('DEV_MODE', !empty(getenv("DEV_MODE")) ? getenv("DEV_MODE") : false);
define('THEME_VER', !empty(getenv("THEME_VER")) ? getenv("THEME_VER") : '0.0.1');


