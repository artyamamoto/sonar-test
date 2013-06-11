<?php

function smarty_modifier_has_role($string, $role)
{
    $role = constant('Administrator::' . $role);

    return ($string & $role);
}

