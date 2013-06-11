<?php

/**
 * Administrator controller
 */
class AdministratorController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'administrator';

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_ADMINISTRATOR;

    public function getValidatorRules() {
        $rules = array(
            'name' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 50),
            ),
            'mail_address' => array(
                'Zend_Validate_NotEmpty' => array(),
                'Ab_Validate_StringLength' => array(0, 255),
            ),
            'password' => array(
                'Zend_Validate_NotEmpty' => array(),
            ),
        );

        if(isset($this->_request->id) && strlen($this->_request->id) > 0) {
            unset($rules['password']);
        }

        return $rules;
    }

    public function editAction()
    {
        parent::editAction();

        $this->_request->setParam('password', '');

        $i = 128;
        $role = $this->_request->role;
        $data = array();
        while($i > 0) {
            if($role >= $i) {
                $data[] = $i;
                $role = $role % $i;
            }

            $i = intval($i / 2);
        }

        $this->_request->setParam('role', $data);
    }
}

