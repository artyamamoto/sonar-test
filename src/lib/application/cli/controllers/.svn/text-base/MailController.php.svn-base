<?php

class MailController extends BaseController
{
    /**
     * return action
     */
    public function returnAction()
    {
        $buffer = file_get_contents("php://stdin");

        $decoder = new Mail_mimeDecode($buffer);

        $config = Zend_Registry::getInstance()->config;

        // メールテンプレート取得
        $code = $this->_request->code;
        if(strlen($code) == 0) {
            echo 'Usage: php run.php -c mail -a return --code=[template code]' . PHP_EOL;
            exit();
        }

        if(APPLICATION_ENVIRONMENT == 'production') {
            $table = new MailTemplateReleaseTable();
        } else {
            $table = new MailTemplateTable();
        }
        $template = $table->fetchRow(array('code = ?' => $code));

        if(!$template) {
            echo 'Template is not found.' . PHP_EOL;
            exit();
        }

        //ユーザーへメール送信
        $structure = $decoder->decode($params);
        $to = $structure->headers['from'];
        
        if(preg_match("/<([^>]+)>/", $to, $matches)){
            $to = $matches[1];
        }

        $to = trim($to);
        $hash = md5($to . time());

        $from = $template->from;
        $subject = $template->subject;
        $body = $template->body;
        $url = 'http://' . $config->url->nomal . '/page/mail/hash/' . $hash . '?guid=ON';

        // ToDo: Smartyでのテンプレート処理

        $body = str_replace('{{$url}}', $url, $body);


        $subject = mb_convert_encoding($subject, "ISO-2022-JP", "utf-8");
        $subject = '=?ISO-2022-JP?B?' . base64_encode($subject) . '?=';
        $body = mb_convert_encoding($body, "ISO-2022-JP", "utf-8");

        try {
            // DBへ保存
            $mailTable = new MailTable();
            $ret = $mailTable->addMail($hash, $to);

            // メール送信
            $mail = new Ab_Mail('ISO-2022-JP');
            $mail->setBodyText($body)
                 ->setFrom($from)
                 ->addTo($to)
                 ->setSubject($subject)
                 ->setReturnPath($from)
                 ->send();
        } catch (Exception $e){
            Zend_Registry::getInstance()->logger->crit($e->getMessage());
        }

        exit();
    }
}

