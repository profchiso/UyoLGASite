<?php
require_once  ('vendor/autoload.php');

class Email
{
	const API_KEY = "key-e47c77a7034722c8d503d51f8714a4a7";
	const DOMAIN = "mx.eminentconcepts.com";
	private $mailgun=null;
	private $mail_config=array();
	private $url=null;

	public function __construct()
	{
		$this->mail_config = array(
			'from' => array(
				'email' => 'info@uyolga.gov.ng',
				'name' => 'Uyo LGA'
			),
			'key' => Email::API_KEY,
			'domain' => Email::DOMAIN
		);
		
		if (class_exists("\\Http\\Adapter\\Guzzle6\\Client")) {
			$client = \Http\Adapter\Guzzle6\Client::createWithConfig(array('verify' => false));
			$this->mailgun = new \Mailgun\Mailgun($this->mail_config['key'], $client);
		} else {
			$this->mailgun = new \Mailgun\Mailgun($this->mail_config['key']);
		}

            if(stripos($_SERVER['SERVER_NAME'], "127.0") !==FALSE){
                  $this->url="http://127.0.0.1/uyolga/";
            }elseif(stripos($_SERVER['SERVER_NAME'], "local.") !==FALSE){
                  $this->url="http://localhost/uyolga/";
            }else{
                  $server_protocol = "http://";
                  if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
                        $server_protocol = "https://";
                  }
                  $this->url=$server_protocol.$_SERVER['SERVER_NAME']."/";
            }

	}
	
	public  function notifyAdmin($email_data)
	{
		$message = '
			<table align="center" bgcolor="#ffffff" cellpadding="0" cellspacing="0" width="550">
				<tbody>
					<tr>
						 <td>
							<div style="padding:5px; text-align:center;background: #2F2F2F"><img style="width:100%;max-width: 100px;" src="' . ($this->url) . 'img/uyo.png" /></div>
						</td>
					</tr>
					<tr>
						<td style="text-align:left">
						<div style="padding:20px 20px 3px 20px; text-align:left; font-family:Arial, sans-serif; color:#003b64; font-size:16px;" class="message_temp_body" >
							' .
							$email_data['message'] .
							'
						 </div>
						    <br/>
						</td>
					</tr>
					<tr>
						<td bgcolor="#2F2F2F" height="10">&nbsp;</td>
					</tr>
				</tbody>
		</table>
				';
		$mg_message = array(
			'from' => $this->mail_config['from']['name'] . " <" . $this->mail_config['from']['email'] . ">",
			'h:Sender' => ucwords($this->mail_config['from']['name']) . " <" . $this->mail_config['from']['email'] . ">",
			'to' => !empty($email_data['to']) ? $email_data['to'] : '',
			'subject' => !empty($email_data['subject']) ? $email_data['subject'] : '',
			'html' => $message,
			'h:Reply-To' => trim(strtolower($this->mail_config['from']['email']))
		);
		$result = $this->mailgun->sendMessage(Email::DOMAIN, $mg_message);
		return $result;
		
	}
}