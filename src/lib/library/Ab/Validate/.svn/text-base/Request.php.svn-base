<?php

class Ab_Validate_Request implements Zend_Validate_Interface
{
    protected $_errors = array();

    protected $_validationRules = array();

    public function __construct(array $_validationRules)
    {
        $this->_validationRules = $_validationRules;
    }

    public function isValid($value)
    {
        $status = false;
        foreach ($this->_validationRules as $fieldName => $validationRules) {
            $status = $this->_validate( $fieldName, $value[ $fieldName ], $value, $validationRules ) || $status;
        }
        return $status;
    }

    protected function _validate( $fieldName, $value, $request, $validationRules )
    {
        $status = false;
        foreach ($validationRules as $validatorName => $args) {

            if( strpos( $validatorName, '!' ) === 0 ){
                 $validatorName = substr( $validatorName, 1 );
                 if( !strlen( $value ) || (is_array($value) && count($value) == 0)) {
                         continue;
                 }
            }

            $validator = $this->_instantiate($validatorName, $args, $request);

            if ($validator->isValid($value) === false) {
                if (!isset($this->_errors[$fieldName])) {
                    $this->_errors[$fieldName] = array();
                }
                $this->_errors[$fieldName] = array_merge($this->_errors[$fieldName] , $validator->getErrors());
                $status = true;
            }
        }
        return $status;
    }

    protected function _instantiate($className, $args, array $value)
    {
        $class = new ReflectionClass($className);

        if (count($args) > 0) {
            $validator = $class->newInstanceArgs($args);
        } else {
            $validator = $class->newInstance();
        }

        return $validator;
    }

    public function getMessages()
    {
        return '';
    }

    public function getErrors()
    {
        return $this->_errors;
    }
}

