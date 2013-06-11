<?php

/**
 * View script integration
 *
 * @uses       Zend_Controller_Action_Helper_ViewRenderer
 * @package    Ab_Controller
 * @subpackage Ab_Controller_Action_Helper
 */
class Ab_Controller_Action_Helper_ViewRenderer extends Zend_Controller_Action_Helper_ViewRenderer
{
    /**
     * Get inflector
     *
     * @return Zend_Filter_Inflector
     */
    public function getInflector()
    {
        if (null === $this->_inflector) {
            $this->_inflector = new Zend_Filter_Inflector();
            $this->_inflector->setStaticRuleReference('moduleDir', $this->_moduleDir) // moduleDir must be specified before the less specific 'module'
                 ->addRules(array(
                     ':module'     => array('Word_CamelCaseToDash', 'StringToLower'),
                     ':controller' => array('Word_CamelCaseToDash', new Zend_Filter_Word_UnderscoreToSeparator('/'), 'StringToLower', new Zend_Filter_PregReplace('/\./', '-')),
                     ':action'     => array('Word_CamelCaseToDash', new Zend_Filter_PregReplace('#[^a-z0-9' . preg_quote('/', '#') . ']+#i', '-'), 'StringToLower'),
                     ':mode'       => array('Word_CamelCaseToDash', 'StringToLower'),
                 ))
                 ->setStaticRuleReference('suffix', $this->_viewSuffix)
                 ->setTargetReference($this->_inflectorTarget);
        }

        // Ensure that module directory is current
        $this->getModuleDirectory();

        return $this->_inflector;
    }

    /**
     * Retrieve base path based on location of current action controller
     *
     * @return string
     */
    protected function _getBasePath()
    {
        if (null === $this->_actionController) {
            return './views';
        }

        $inflector = $this->getInflector();
        $this->_setInflectorTarget($this->getViewBasePathSpec());

        $dispatcher = $this->getFrontController()->getDispatcher();
        $request = $this->getRequest();

        $parts = array(
            'module'     => (($moduleName = $request->getModuleName()) != '') ? $dispatcher->formatModuleName($moduleName) : $moduleName,
            'controller' => $request->getControllerName(),
            'action'     => $dispatcher->formatActionName($request->getActionName()),
            'mode'       => APPLICATION_MODE,
            );

        $path = $inflector->filter($parts);
        return $path;
    }
}

