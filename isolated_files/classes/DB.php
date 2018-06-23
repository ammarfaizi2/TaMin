<?php

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @since 0.0.1
 */
final class DB
{
	/**
	 * @var \PDO
	 */
	private $pdo;

	/**
	 * @return void
	 */
	public function __construct()
	{
		$this->pdo = new \PDO(
			"mysql:"."host=".DB_HOST.";"."port=".DB_PORT.";"."dbname=".DB_NAME,
			DB_USER,
			DB_PASS
		);
	}
}