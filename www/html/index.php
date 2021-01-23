<?php

	const
	_CFG_MYSQL_HOST = 'mysql',
	_CFG_MYSQL_DB = 'testing',
	_CFG_MYSQL_USER = 'devuser',
	_CFG_MYSQL_PASS = 'devpass',
	_CFG_MYSQL_PORT = 3306,
	_CFG_MYSQL_CHARSET = 'utf8mb4';

	require_once '../vendor/autoload.php';

	$dbCheck = false;
	$dbError = '';
	$autoloadCheck = false;
	$autoLoadError = '';
	try
	{
		$init = new \App\Init();
		$autoloadCheck = true;
	}
	catch (Error $e)
	{
		$autoLoadError = $e->getMessage();
	}
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
		$dbCheck = true;
	}
	catch (PDOException $e)
	{
		$dbError = $e->getMessage();
	}

	function getTextElement($status): string
	{
		$color = $status ? '#4CAF50' : '#f44336';
		$text = $status ? 'Working' : 'Not working';

		return sprintf('<span style="color: %s">%s</span>', $color, $text);
	}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LEMP Boilerplate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            width: 100%;
            display: grid;
            place-items: center;
            font-family: Helvetica, Verdana, sans-serif;
        }

        #wrapper {
            width: 90%;
        }

        #wrapper > section:first-child {
            text-align: center;
            margin: 1em 0;
        }

        #status {
            padding: 1em;
        }

        table {
            width: 100%;
        }

        th {
            text-align: left;
            background: #CCC7C2;
        }

        th, td {
            padding: .5em;
        }

        td {
            background: #f1f1f1;
        }

        h1 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <section>
        <h1>Congratulations!</h1>
        <p>
            Your nginx webserver is up and running
        </p>
    </section>
    <section id="status">

        <table>
            <colgroup>
                <col style="width: 30%">
                <col style="width: 30%">
                <col style="width: 40%">
            </colgroup>
            <tr>
                <th>Feature</th>
                <th>Status</th>
                <th>Info</th>
            </tr>
            <tr>
                <td>Autoloading</td>
                <td><?= getTextElement($autoloadCheck) ?></td>
                <td><?=$autoLoadError ?></td>
            </tr>
            <tr>
                <td>DB-Connection</td>
                <td><?= getTextElement($dbCheck) ?></td>
                <td><?=$dbError ?></td>
            </tr>
        </table>
    </section>

</div>

</body>
</html>
