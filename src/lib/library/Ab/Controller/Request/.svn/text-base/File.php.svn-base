<?php

/**
 * @package Ab
 * @author  M/Kamoshida
 * @create  2010/12/02
 */
class Ab_Controller_Request_File
{
    /**
     * @var     Ab_Controller_Request_Http
     */
    protected $_request = null;

    /**
     * @var     array
     */
    protected $_files = array();

    /**
     * @var     string
     */
    protected $_tempDirectory = null;

    /**
     * Constructor.
     *
     * @param  Ab_Controller_Request_Http     $request
     */
    public function __construct(Ab_Controller_Request_Http $request)
    {
        $this->_request = $request;

        if(!$this->_isUploaded()) {
            return;
        }

        $this->_files = $_FILES;
    }

    /**
     * 全てのアップロードされたファイルを一時ディレクトリへ保存し、
     * Requestオブジェクトへファイル名を保存
     */
    public function saveFiles()
    {
        if(!$this->_isUploaded()) {
            return;
        }

        foreach($this->_files as $name => $value) {
            if(!$this->keyExists($name)) {
                continue;
            }

            $localName = $this->moveUploadedFile($name);

            $value['tmp_name'] = $localName;
            $this->_request->setParam($name, $value);
        }
    }

    /**
     * ファイルのアップロードリクエストがあるかチェック
     */
    protected function _isUploaded()
    {
        $contentType = $this->_request->getHeader('Content-Type');
        if($this->_request->isPost() &&
           strpos($contentType, 'multipart/form-data') !== FALSE &&
           !empty($_FILES)) {

            return true;
        }

        return false;
    }

    /**
     * 一時ディレクトリを指定
     *
     * @param  string       $directory
     */
    public function setTempDirectory($directory)
    {
        $this->_tempDirectory = $directory;

        if(!file_exists($this->_tempDirectory)) {
            $umask = umask();
            umask(0);
            mkdir($this->_tempDirectory, 0777, true);
            umask($umask);
        }
        if(!is_dir($this->_tempDirectory) || !is_writable($this->_tempDirectory)) {
            echo 'Cannot write upload directory.';
            exit(1);
        }
    }

    /**
     * 指定したキーのファイルが存在するかチェック
     *
     * @param  string       $key
     * @return boolean
     */
    public function keyExists($key)
    {
        return (isset($this->_files[$key]) && is_uploaded_file($this->_files[$key]["tmp_name"]));
    }

    /**
     * 指定したキーのファイル名を取得
     *
     * @param  string       $key
     * @return string
     */
    public function getFileName($key)
    {
        $info = pathinfo($this->_files[$key]['name']);
        return $info['basename'];
    }

    /**
     * アップロードファイルを一時ディレクトリに移動
     *
     * @param  string       $key
     * @return strint       アップロードファイル名
     * @throws Exception
     */
    public function moveUploadedFile($key, $uploadDir = null)
    {
        $info = pathinfo($this->_files[$key]['name']);

        if($uploadDir != null){
            $this->_tempDirectory = $uploadDir;
        }

        $fileName = Ab_Utils_File::getFileName($this->_tempDirectory, $info['extension']);

        move_uploaded_file($this->_files[$key]['tmp_name'], $this->_tempDirectory . '/' . $fileName);

        return $fileName;
    }
}

