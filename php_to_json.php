<?php

/**
 * ApiGen 2.8.0 - API documentation generator for PHP 5.3+
 *
 * Copyright (c) 2010-2011 David Grudl (http://davidgrudl.com)
 * Copyright (c) 2011-2012 Jaroslav Hanslík (https://github.com/kukulich)
 * Copyright (c) 2011-2012 Ondřej Nešpor (https://github.com/Andrewsville)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */
error_reporting(E_ALL);

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
// Safe locale and timezone
setlocale(LC_ALL, 'C');
if (!ini_get('date.timezone'))
{
    date_default_timezone_set('UTC');
}


$path = $_SERVER["argv"][1];

if (false === strpos('@php_dir@', '@php_dir'))
{
    set_include_path(
            __DIR__ . PATH_SEPARATOR .
            __DIR__ . '/libs/TokenReflection' . PATH_SEPARATOR .
            get_include_path()
    );
    // PEAR package
}
else
{
    // Downloaded package

    set_include_path(
            __DIR__ . PATH_SEPARATOR .
            __DIR__ . '/libs/TokenReflection' . PATH_SEPARATOR .
            get_include_path()
    );
}

// Autoload
spl_autoload_register(function($class) {
            $class = trim($class, '\\');
            require sprintf('%s.php', str_replace('\\', DIRECTORY_SEPARATOR, $class));
        });

use TokenReflection\Broker;

// Check dependencies
foreach (array('json', 'iconv', 'mbstring', 'tokenizer') as $extension)
{
    if (!extension_loaded($extension))
    {
        printf("Required extension missing: %s\n", $extension);
        die(1);
    }
}

function fillMethods($methods)
{
    $result = array();
    foreach ($methods as $method)
    {
        $name = $method->getName();
        $doc = $method->getDocComment();

        $result[$name] = $doc;
    }

    return $result;
}

if (!class_exists('TokenReflection\\Broker'))
{
    echo "Required dependency missing: TokenReflection library\n";
    die(1);
}

try
{
    $broker = new Broker(new Broker\Backend\Memory());
    $broker->processDirectory($path);

    $classList = $broker->getClasses();

    $result = array();
    foreach ($classList as $key => $value)
    {
        $methods = $value->getMethods();

        $result[$key] = fillMethods($methods);
    }

    $res = json_encode($result);

    echo $res;
}
catch (Exception $exc)
{
    $result = array();
    $result['error'] = $path.' '.$exc->getTraceAsString();

    $res = json_encode($result);
    echo $res;
}







