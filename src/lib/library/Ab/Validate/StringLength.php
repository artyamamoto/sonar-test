<?php

/**
 * @category   Ab
 * @package    Ab_Validate
 */
class Ab_Validate_StringLength extends Zend_Validate_StringLength
{
    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if the string length of $value is at least the min option and
     * no greater than the max option (when the max option is not null).
     *
     * @param  string $value
     * @return boolean
     */
    public function isValid($value)
    {
        if (!is_string($value)) {
            $this->_error(Zend_Validate_StringLength::INVALID);
            return false;
        }

        $this->_setValue($value);
        if ($this->_encoding !== null) {
            $length = iconv_strlen($value, $this->_encoding);
        } else {
            $valueSjis = mb_convert_encoding($value, 'SJIS', 'UTF-8');
            $length = strlen($valueSjis);
        }

        if ($length < $this->_min) {
            $this->_error(Zend_Validate_StringLength::TOO_SHORT);
        }

        if (null !== $this->_max && $this->_max < $length) {
            $this->_error(Zend_Validate_StringLength::TOO_LONG);
        }

        if (count($this->_messages)) {
            return false;
        } else {
            return true;
        }
    }
}
