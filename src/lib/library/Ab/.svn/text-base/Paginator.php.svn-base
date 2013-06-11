<?php

/**
 * Paginator.
 */
class Ab_Paginator extends Zend_Paginator
{
    protected function _createPages($scrollingStyle = null)
    {
        $pages = parent::_createPages($scrollingStyle);

        if(!isset($pages->previous)) {
            $pages->previous = null;
        }
        if(!isset($pages->next)) {
            $pages->next = null;
        }

        return $pages;
    }

    /**
     * Factory.
     *
     * @param  mixed $data
     * @param  string $adapter
     * @param  array $prefixPaths
     * @return Zend_Paginator
     */
    public static function factory($data, $adapter = self::INTERNAL_ADAPTER,
                                   array $prefixPaths = null)
    {
        if ($data instanceof Zend_Paginator_AdapterAggregate) {
            return new self($data->getPaginatorAdapter());
        } else {
            if ($adapter == self::INTERNAL_ADAPTER) {
                if (is_array($data)) {
                    $adapter = 'Array';
                } else if ($data instanceof Zend_Db_Table_Select) {
                    $adapter = 'DbTableSelect';
                } else if ($data instanceof Zend_Db_Select) {
                    $adapter = 'DbSelect';
                } else if ($data instanceof Iterator) {
                    $adapter = 'Iterator';
                } else if (is_integer($data)) {
                    $adapter = 'Null';
                } else {
                    $type = (is_object($data)) ? get_class($data) : gettype($data);

                    /**
                     * @see Zend_Paginator_Exception
                     */
                    require_once 'Zend/Paginator/Exception.php';

                    throw new Zend_Paginator_Exception('No adapter for type ' . $type);
                }
            }

            $pluginLoader = self::getAdapterLoader();

            if (null !== $prefixPaths) {
                foreach ($prefixPaths as $prefix => $path) {
                    $pluginLoader->addPrefixPath($prefix, $path);
                }
            }

            $adapterClassName = $pluginLoader->load($adapter);

            return new self(new $adapterClassName($data));
        }
    }
}

