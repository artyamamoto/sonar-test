<?php

class ContactController extends BaseController
{
    public function indexAction() 
    {
        $this->_forward('form');
    }

    public function noticeAction() 
    {
    }

    public function formAction() 
    {
        $device = Ab_Device::getInstance();

        if($device->isMobile()){
            $carrier = Ab_Device::getInstance()->getCarrier();
            if($carrier == "SoftBank"){
                $dm = Ab_Device::getInstance()->getModel();
                $dm = substr($dm,0,2);
                if($dm == "DM"){
                    $carrier = "disney";
                }
            }
            $this->view->carrier = $carrier;
        }
    }

    public function compAction() 
    {
    
        $device = Ab_Device::getInstance();
        
        $err = array();
        
        if($device->isMobile()){
            //ガラケー用
            $rules = array(
                'mailad' => array(
                            'Zend_Validate_NotEmpty' => array(),
                            'Zend_Validate_Regex' => array('/^([*+!.&#$|\'\\%\/0-9a-z^_`{}=?~:-]+)$/'),
                        ),
                'domain' => array(
                            'Zend_Validate_NotEmpty' => array(),
                        ),
                'maintext' => array(
                            'Zend_Validate_NotEmpty' => array(),
                        ),
            );
        }else{
            //スマホ用
            $rules = array(
                'mail_address' => array(
                            'Zend_Validate_NotEmpty' => array(),
                        ),
                'contents' => array(
                            'Zend_Validate_NotEmpty' => array(),
                        ),
            );
        }
        
        $validator = new Ab_Validate_Request($rules);

        if ($validator->isValid($this->_request->getParams())) {
            $this->view->errors = $validator->getErrors();
            $this->_forward('form');
            return;
        }
        
        if($device->isMobile()){
            $maintext = $this->_request->maintext;
 
            $mailAdd = $this->_request->mailad . $this->_request->domain;
        }else{
            $maintext = $this->_request->contents;
            $mailAdd = $this->_request->mail_address;
        }

        $ua = Ab_Device::getInstance()->getUseragent();

        //ユーザーへメール送信
        $from = 'noreply@' . $this->_domain;
        $to      = $mailAdd;
        $subject = '受付確認';
        $body = 'お問い合わせを受け付けいたしました。'. "\n\n" .
        '-お問い合わせ内容-'. "\n" .
        $maintext . "\n\n" .
        '------------------'. "\n\n" .
        '回答までにはお時間を頂く場合がございますので、しばらくお待ちくださいますよう、お願い申し上げます。'. "\n" .
        'お問い合わせ内容によっては、ご回答できない場合もございますので、ご了承下さい。'. "\n" .
        '※このメールは自動で返信されておりますので、このメールにご返信いただいても回答はできませんのでご了承ください。'. "\n" .
        '※このメールにお心当たりがない場合は、大変お手数ですが、当メールを削除していただけますよう、お願い申し上げます。';

        $subject = mb_convert_encoding($subject, "ISO-2022-JP", "UTF-8");
        $subject = '=?ISO-2022-JP?B?' . base64_encode($subject) . '?=';
        $body = mb_convert_encoding($body, "JIS", "UTF-8");
        
        $mail = new Ab_Mail('ISO-2022-JP');

        //ユーザーへメール
        $transport = new Zend_Mail_Transport_Sendmail('-f ' . $from);
        $mail->setBodyText($body)
                 ->setFrom($from)
                 ->addTo($to)
                 ->setSubject($subject)
                 ->setReturnPath($from)
                 ->send($transport);

        //運営へメール送信
        $from = $mailAdd;

        $config = Zend_Registry::getInstance()->config;
        $d = array_shift(explode('.', $this->_domain));
        $to = explode(',', $config->mail->contact->to->{$d});

        $subject = '[' . $this->_campaign . ']' . substr($maintext, 0, 40);
        $body = $maintext . "\n\n" .
        '--------------------'. "\n" .
        'UA:'. $ua . "\n" .
        'UID:'. $this->_uid. "\n" .
        'MAIL:'. $mailAdd. "\n";

        $subject = mb_convert_encoding($subject, "ISO-2022-JP", "utf-8");
        $subject = '=?ISO-2022-JP?B?' . base64_encode($subject) . '?=';
        $body = mb_convert_encoding($body, "JIS", "utf-8");

        $transport = new Zend_Mail_Transport_Sendmail('-f ' . $from);

        $mail = new Ab_Mail('ISO-2022-JP');
        $mail->setBodyText($body)
                 ->setFrom($from)
                 ->setSubject($subject);
        foreach($to as $t) {
            $mail->addTo($t);
        }
        $mail->send($transport);
    }
}

