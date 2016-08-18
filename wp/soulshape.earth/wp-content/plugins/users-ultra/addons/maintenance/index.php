<?php
define('uultra_maintenance_url',plugin_dir_url(__FILE__ ));
define('uultra_maintenance_path',plugin_dir_path(__FILE__ ));

	/* functions */
	foreach (glob(uultra_maintenance_path . 'functions/*.php') as $filename) { require_once $filename; }
	
	/* administration */
	if (is_admin()){
		foreach (glob(uultra_maintenance_path . 'admin/*.php') as $filename) { include $filename; }
	}