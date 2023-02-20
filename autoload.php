<?php
function autoload($class_name): void
{

    # List all the class directories in the array.
    $array_paths = array(
        'backend/',
        'backend/DB/',
        'backend/Product/',
    );

    foreach($array_paths as $path)
    {
        $file = sprintf('%s%s.php', $path, $class_name);
        if(is_file($file))
        {
            include_once $file;
        }

    }
}
spl_autoload_register('autoload');
