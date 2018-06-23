<?php

if (! defined("__INIT__")) {
	ini_set("display_errors", true);

	define("__INIT__", __FILE__);

	require __DIR__."/config.php";

	/**
	 * Classes autoloader.
	 */
	if (file_exists(__DIR__."/vendor/autoload.php")) {
		
		// Use composer autoloader if provided.
		require __DIR__."/vendor/autoload.php";

	} else {

		class AutoloaderException_289efb6237a5e9add5c807ee6f2fac707076b449 extends Exception
		{
		}

		function __classAutoloader($class)
		{
			$class = str_replace("\\", "/", $class);
			if (file_exists($f = __DIR__."/isolated_files/classes/".$class.".php")) {
				require $f;
			} else {
				throw new AutoloaderException_289efb6237a5e9add5c807ee6f2fac707076b449(
					sprintf("Could not load %s", $f)
				);
			}
		}
		spl_autoload_register("__classAutoloader");

	}

	/**
	 * Helpers autoloader
	 */
	$scan = scandir($f = __DIR__."/isolated_files/helpers/");
	unset($scan[0], $scan[1]);
	foreach ($scan as $file) {
		require $f."/".$file;
	}

	/**
	 * Initialize singleton.
	 */
	Singleton::init(
		[
			"db" => ["\\DB", []]
		]
	);

	(require __DIR__."/isolated_files/middleware/boot.php")();
	register_shutdown_function(
		require __DIR__."/isolated_files/middleware/shutdown.php"
	);
}
