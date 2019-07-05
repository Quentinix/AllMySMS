<?php

/**
 * @param $className
 */
function quentinix_allmysms_autoload($className)
{
    $classPath = explode('\\', $className);
    if ($classPath[0] != 'Quentinix' || $classPath[1] !== 'AllMySMS') {
        return;
    }
    // Drop 'Quentinix\AllMySMS', and maximum file path depth in this project is 1
    $classPath = array_slice($classPath, 2);
    $filePath = dirname(__FILE__) . '/' . implode('/', $classPath) . '.php';
    if (file_exists($filePath)) {
        require_once($filePath);
    }
}
spl_autoload_register('quentinix_allmysms_autoload');