<?php

include 'index.php';

/**
 * refactor class name to standart class name
 */
$class_name = str_replace('_', ' ', $argv[2]);
$class_name = str_replace(' ', '', ucwords($class_name));
include 'spoor/gen_template/template.php';

if ($argv[1] == 'controller')
{
    /**
     * puts script to file and create a file
     */
    file_put_contents(CONTROLLER . '/' . $argv[2] . EXT, $controller);
}
elseif ($argv[1] == 'model')
{
    file_put_contents(MODEL . '/' . $argv[2] . EXT, $model);
}
elseif ($argv[1] == 'model_no_ar')
{
    file_put_contents(MODEL . '/' . $argv[2] . EXT, $model_no_ar);
}

echo "\n\nScript Finish!\n";


