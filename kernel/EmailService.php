<?php
require_once ABSPATH . '/lib/phpmail/PHPMailerAutoload.php';
/**
 * 邮件发送类
 * */

class EmailService extends BaseService {

	/**
	 * 发送邮件的用户名
	 * */
	private $__smtpusername = null;
	
	/**
	 * 发送邮件的密码
	 * */
	private $__pass = null;
	
	/**
	 * 发送邮件的端口
	 * */
	private $__port = null;
	
	/**
	 * 发送邮件的smtp服务器
	 * */
	private $__smtp = null;

    /**
     * 构造函数
     */
    public function __construct($smtpusername, $pass, $port, $smtp) {
        parent::__construct();
        $this->__smtpusername = $smtpusername;
        $this->__pass = $pass;
        $this->__port = $port;
        $this->__smtp = $smtp;

    }

    // }}}
    // {{{ public function sendNormalMessage()
    
    /**
     * 发送普通消息
     *
     * @param string $receive 收件人
     * @param string $content 发送内容
     * @param string $name 发件人姓名
     * @param string $subject 主题
     * */
    public function sendmail($receiver,$content,$name,$subject="") {
    	if (!$receiver) {
    		throw new ValidatorException(193);
    		return false;
    	}
    	 
    	if (!$content) {
    		throw new ValidatorException(194);
    		return false;
    	}
    	if(!$name){
    		throw new ValidatorException(195);
    		return false;
    	}
    	$mail = new PHPMailer;
    	$mail->CharSet = 'UTF-8';
    	$mail->SMTPDebug = 0;
    	//Ask for HTML-friendly debug output
    	$mail->Debugoutput = 'html';
    	//Set the hostname of the mail server
    	$mail->Host = $this->__smtp;
    	//Set the SMTP port number - likely to be 25, 465 or 587
    	$mail->Port = $this->__port;
    	//Whether to use SMTP authentication
    	$mail->SMTPAuth = true;
    	//Username to use for SMTP authentication
    	$mail->Username = $this->__smtpusername;
    	//Password to use for SMTP authentication
    	$mail->Password = $this->__pass;
    	//Set who the message is to be sent from
    	$mail->setFrom($this->__smtpusername, $name);
    	//Set an alternative reply-to address
    	$mail->addReplyTo($this->__smtpusername, $name);
    	//Set who the message is to be sent to
    	$mail->addAddress($receiver, $receiver);
    	$mail->IsSMTP();
    	//Set the subject line
    	$mail->Subject = $subject;
    	
    	$mail->Body=$content;
    	//Read an HTML message body from an external file, convert referenced images to embedded,
    	//convert HTML into a basic plain-text alternative body
    	
    	//Attach an image file
    	
    	
    	
    	//send the message, check for errors
    	if (!$mail->send()) {
    			
    		return true;
    	} else {
    			
    		return false;
    	}
    	
       
    }
    
 
    
    
    
    
 
}
