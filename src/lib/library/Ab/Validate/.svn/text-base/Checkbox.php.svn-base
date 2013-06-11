<?php

class Ab_Validate_Checkbox extends Zend_Validate_NotEmpty
{

    public function isValid($value)
    {
        if (is_array($value) && (sizeof($value)>0)) {
            return true;
        } else {
            $this->_error(self::IS_EMPTY);
            return false;
        }
    }

}


