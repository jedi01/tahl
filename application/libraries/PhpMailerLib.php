<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhpMailerLib 
{

    private $mail;  

	function __construct()
	{
		require_once(APPPATH."third_party/phpmailer/PHPMailer.php");
        $this->mail = new \PHPMailer\PHPMailer\PHPMailer;
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = 'bitsclantest@gmail.com';
        $this->mail->Password = 'admin123/,.';
        $this->mail->SMTPSecure = 'ssl';                            
        $this->mail->Port = '465';
	}



        public function send_email($data)
        {

            $this->mail->setFrom($this->mail->Username, 'Rosenblatt Securities Inc.');
            $emails = explode(",",$data['emails']);
            foreach ($emails as $key1 => $value1) {
               $this->mail->addAddress($value1);
            }

          
            if(isset($data['cc'])){
                foreach ($data['cc'] as $key => $value) {
                    $this->mail->AddCC($value);
                }
            }
          
            $this->mail->isHTML(true);                                
            $this->mail->Subject = $data['subject'];
            $this->mail->Body    = $data['message'];

            $email = $this->mail->send();

            $res = array('res'=>$email,'data'=>$this->mail);
        
            return $res;
        }


      




    }


