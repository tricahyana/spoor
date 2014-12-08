<?php

/**
 * Create method from user argument
 */
$method = '';
for ($i = 3; $i <= ($argc - 1); $i++)
{
    $method .= "  public function $argv[$i](){\n\n  }\n\n";
}


/**
 * script template
 */
$controller = ''
        . "<?php\n\n"
        . "class $class_name extends App_controller{\n"
        . "\n"
        . "$method"
        . "}";

$model = ''
        . "<?php\n\n"
        . "require ACTIVERECORD;\n"
        . "class $class_name extends ActiveRecord\Model{\n"
        . "\n"
        . "$method"
        . "}";

$model_no_ar = ''
        . "<?php\n\n"
        . "class $class_name{\n"
        . "\n"
        . "$method"
        . "}";
