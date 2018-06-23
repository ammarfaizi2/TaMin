<?php

use Exceptions\Singleton\SingletonException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @since 0.0.1
 */
final class Singleton
{	
	/**
	 * @var array
	 */
	private $instances = [];

	/**
	 * @var self
	 */
	private static $self;

	/**
	 * @return void
	 */
	private function __construct()
	{
		// Prevent class initialization from public scope.
	}

	/**
	 * @param array $array
	 * @return void
	 */
	public static function init(array $array)
	{
		self::$self = new self;
		self::$self->instances = $array;
	}

	/**
	 * @param string $key
	 * @throws \Exceptions\Singleton\SingletonException
	 * @return object
	 */
	public static function get(string $key): object
	{
		$ins = self::getSelfInstance();
		if (array_key_exists($key, $ins->instances)) {

			if (! is_object($ins->instances[$key])) {
				if (isset($ins->instances[$key][1]) && is_array($ins->instances[$key][1])) {
					$ins->instances[$key] = new $ins->instances[$key][0](...$ins->instances[$key][1]);	
				} else {
					$ins->instances[$key] = new $ins->instances[$key][0]();	
				}
			}

			return $ins->instances[$key];
		}
		throw new SingletonException(
			sprintf("Invalid key: %s", $key)
		);
	}

	/**
	 * @param string 		$key
	 * @param array|object	$core
	 * @return void
	 */
	public static function set(string $key, $core)
	{
		self::getSelfInstance()->instances[$key] = $core;
	}

	/**
	 * @return self
	 */
	public static function getSelfInstance(): object
	{
		return self::$self;
	}
}
