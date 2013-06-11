<?php

/**
 * Ab_View_Smarty.
 *
 * @package Ab
 * @author  M/Kamoshida
 */
class Ab_View_Smarty implements Zend_View_Interface
{
    /**
     * Smarty object.
     *
     * @var Smarty
     */
    protected $_smarty;

    /**
     * Constructor.
     *
     * @param string $tmplPath
     * @param array $extraParams
     * @return void
     */
    public function __construct($tmplPath = null, $extraParams = array())
    {
        $this->_smarty = new Smarty();

        if (null !== $tmplPath) {
            $this->setScriptPath($tmplPath);
        }

        $this->setOptions($extraParams);

        $this->_smarty->plugins_dir[] = dirname(__FILE__) . '/Smarty/Plugin';
    }

    /**
     * Smartyのパラメータをセット
     */
    public function setOptions($options = array())
    {
        foreach ($options as $key => $value) {
            $this->_smarty->$key = $value;
        }

        $resourceType = isset($options['default_resource_type']) ? $options['default_resource_type'] : null;
        if(null !== $resourceType) {
            $this->_addResource($resourceType);
        }
    }

    /**
     * Return the template engine object
     *
     * @return Smarty
     */
    public function getEngine()
    {
        return $this->_smarty;
    }

    /**
     * Set the path to the templates
     *
     * @param string $path The directory to set as the path.
     * @return void
     */
    public function setScriptPath($path)
    {
        $path = $this->_replacePath($path);
        if (is_readable($path)) {
            $this->_smarty->template_dir = $path;
            return;
        }

        throw new Exception('Invalid path provided : ' . getcwd() . ' : ' . $path);
    }

    /**
     * Retrieve the current template directory
     *
     * @return string
     */
    public function getScriptPaths()
    {
        return array($this->_smarty->template_dir);
    }

    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function setBasePath($path, $prefix = 'Zend_View')
    {
        return $this->setScriptPath($path);
    }

    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function addBasePath($path, $prefix = 'Zend_View')
    {
        return $this->setScriptPath($path);
    }

    /**
     * Assign a variable to the template
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key, $val)
    {
        $this->_smarty->assign($key, $val);
    }

    /**
     * Retrieve an assigned variable
     *
     * @param string $key The variable name.
     * @return mixed The variable value.
     */
    public function __get($key)
    {
        return $this->_smarty->get_template_vars($key);
    }

    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return (null !== $this->_smarty->get_template_vars($key));
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->_smarty->clear_assign($key);
    }

    /**
     * Assign variables to the template
     *
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     *
     * @see __set()
     * @param string|array $spec The assignment strategy to use (key or
     * array of key => value pairs)
     * @param mixed $value (Optional) If assigning a named variable,
     * use this as the value.
     * @return void
     */
    public function assign($spec, $value = null)
    {
        if (is_array($spec)) {
            $this->_smarty->assign($spec);
            return;
        }

        $this->_smarty->assign($spec, $value);
    }

    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via
     * {@link assign()} or property overloading
     * ({@link __get()}/{@link __set()}).
     *
     * @return void
     */
    public function clearVars()
    {
        $this->_smarty->clear_all_assign();
    }

    /**
     * Processes a template and returns the output.
     *
     * @param string $name The template to process.
     * @return string The output.
     */
    public function render($name)
    {
        $this->_smarty->compile_dir = $this->_replacePath($this->_smarty->compile_dir);
        $this->_smarty->template_dir = $this->_replacePath($this->_smarty->template_dir);

        // Make compile_dir.
        if(!file_exists($this->_smarty->compile_dir)) {
            $umask = umask();
            umask(0);
            mkdir($this->_smarty->compile_dir, 0777, true);
            umask($umask);
        }
        if(!is_dir($this->_smarty->compile_dir) || !is_writable($this->_smarty->compile_dir)) {
            echo 'Cannot write compile directory.';
            exit(1);
        }

        $name = str_replace('-', '_', $name);
        return $this->_smarty->fetch($name);
    }

    /**
     * Add resource functions
     *
     * @access protected
     * @param  string       $type
     */
    protected function _addResource($type)
    {
        if($type == 'file') {
            return;
        }

        $className = 'Ab_View_Smarty_Resource_' . ucwords($type);

        $resourceClass = new $className();
        if(!$resourceClass instanceof Ab_View_Smarty_Resource_Interface) {
            return;
        }

        $option = array(
                    $resourceClass,
                    'getTemplate',
                    'getTimestamp',
                    'getSecure',
                    'getTrusted'
                );
        $this->_smarty->register_resource($type, $option);
    }

    /**
     * テンプレートディレクトリ内の変数を置換
     */
    protected function _replacePath($path)
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();

        $search = array(
            ':mode',
            ':environment',
            ':artist',
            ':device',
        );

        $replace = array(
            APPLICATION_MODE,
            APPLICATION_ENVIRONMENT,
            (isset($request->artist) ? $request->artist : ''),
            Ab_Device::getInstance()->getTypeString(),
        );

        return str_replace($search, $replace, $path);
    }
}

