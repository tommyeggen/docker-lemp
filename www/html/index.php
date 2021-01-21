<?php

	// TODO CHANGE ME
	const
		_CFG_MYSQL_HOST = 'mysql',
		_CFG_MYSQL_DB = 'testing',
		_CFG_MYSQL_USER = 'devuser',
		_CFG_MYSQL_PASS = 'devpass',
		_CFG_MYSQL_PORT = 3306,
		_CFG_MYSQL_CHARSET = 'utf8mb4';

	$pdoOptions = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];

	$strDsn = sprintf(
		'mysql:host=%s;dbname=%s;port=%s;charset=%s',
		_CFG_MYSQL_HOST,
		_CFG_MYSQL_DB,
		_CFG_MYSQL_PORT,
		_CFG_MYSQL_CHARSET
	);

	try
	{
		$pdo = new PDO($strDsn, _CFG_MYSQL_USER, _CFG_MYSQL_PASS, $pdoOptions);
	} catch (PDOException $e)
	{
		die($e->getMessage());
	}

	phpinfo();