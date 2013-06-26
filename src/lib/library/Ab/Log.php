<?php

/**
 * Ab_Log class.
 */
class Ab_Log extends Zend_Log
{
    /**
     * @var array
     */
    protected static $_errorTypes = array(
                        E_ERROR             => 'Error',
                        E_WARNING           => 'Warning',
                        E_PARSE             => 'Parsing Error',
                        E_NOTICE            => 'Notice',
                        E_CORE_ERROR        => 'Core Error',
                        E_CORE_WARNING      => 'Core Warning',
                        E_COMPILE_ERROR     => 'Compile Error',
                        E_COMPILE_WARNING   => 'Compile Warning',
                        E_USER_ERROR        => 'User Error',
                        E_USER_WARNING      => 'User Warning',
                        E_USER_NOTICE       => 'User Notice',
                        E_STRICT            => 'Runtime Notice',
                        E_RECOVERABLE_ERROR => 'Catchable Fatal Error'
                    );

    /**
     * Initialize.
     *
     * @access public
     * @param  string       $logDir
     * @param  int          $logStart
     */
    public function init($logDir, $logStart = 7)
    {
        if($logStart < 7) {
            $this->addFilter(new Zend_Log_Filter_Priority($logStart));
        }

        $date = date('Ymd');

        $logs = array(
                    'err'   => Zend_Log::ERR,
                    'warn'  => Zend_Log::WARN,
                    'info'  => Zend_Log::INFO,
                    'debug' => Zend_Log::DEBUG,
                );

        foreach($logs as $log => $priority) {
            if($priority > $logStart){ continue; }

            if(!file_exists($logDir)) {
                mkdir($logDir, 0777, true);
                chmod($logDir, 0777);
            }
            if(!is_dir($logDir) || !is_writable($logDir)) {
                echo 'Cannot write log directory.';
                exit(1);
            }

            if(!file_exists($logDir . '/' . $log . '.' . $date)) {
                touch($logDir . '/' . $log . '.' . $date);
                chmod($logDir . '/' . $log . '.' . $date, 0666);
            }

            $writer = new Zend_Log_Writer_Stream($logDir . '/' . $log . '.' . $date);
            $this->addWriter($writer);
            $writer->addFilter(new Zend_Log_Filter_Priority($priority));
        }
    }

    /**
     * Error handler.
     *
     * @access public
     * @param  int      $errno
     * @param  string   $errstr
     * @param  string   $errfile
     * @param  int      $errline
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        switch($errno) {
            case E_STRICT:
                return;
                break;
            case E_USER_NOTICE:
            case E_NOTICE:
                $isExit = false;
                $priority = Zend_Log::NOTICE;
                break;
            case E_USER_WARNING:
            case E_COMPILE_WARNING:
            case E_CORE_WARNING:
            case E_WARNING:
                $isExit = false;
                $priority = Zend_Log::WARN;
                break;
            case E_USER_ERROR:
            case E_COMPILE_ERROR:
            case E_CORE_ERROR:
            case E_ERROR:
                $isExit = true;
                $priority = Zend_Log::ERR;
                break;
            case E_PARSE:
                $isExit = true;
                $priority = Zend_Log::CRIT;
                break;
            default:
                $isExit = false;
                $priority = Zend_Log::DEBUG;
        }

        $currentDir = getcwd();
        $errfile = str_replace($currentDir, "", $errfile);

        $out = '[' . self::$_errorTypes[$errno] . ' (' . $errno . ')] ';
        $out .= $errstr . ' in ' . $errline . ' of file ' . $errfile . PHP_EOL;
        $out .= PHP_EOL;

        $trace = debug_backtrace();
        array_shift($trace);
        $out .= self::_formatTrace($trace);

        if(class_exists('Zend_Registry') && isset(Zend_Registry::getInstance()->logger)) {
            Zend_Registry::getInstance()->logger->log($out, $priority);
        } else {
            $isExit = true;
        }
echo "[error] $out\n";
return false;
        if($isExit) {
            echo nl2br($out);
            exit();
        }
    }

    /**
     * Get formated trace log.
     *
     * @access protected
     * @param  array        $traces
     * @return string
     */
    protected static function _formatTrace($traces)
    {
        $ret = '';
        $i = 0;
        $currentDir = getcwd();
        foreach($traces as $trace) {
            $file = str_replace($currentDir, "", $trace['file']);
            $ret .= '#' . $i . ' ' . $file . '(' . $trace['line'] . ') ';

            if(isset($trace['type']) && ($trace['type'] == '->' || $trace['type'] == '::')) {
                $ret .= $trace['class'] . $trace['type'] . $trace['function'];
            } else {
                $ret .= $trace['function'];
            }
            $ret .= PHP_EOL;
            $i++;
        }

        return $ret;
    }
}

