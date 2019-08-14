<?php
Mage::app('default');
function getMazeTable($tbl){
	$tableName = Mage::getSingleton('core/resource')->getTableName($tbl);
	return($tableName);
}
//customer will be re-directed to this file. this file handle all token, email etc things.
class Loginradius_Sharing_IndexController extends Mage_Core_Controller_Front_Action
{
	/**
	 * call LR api to login/register user.
	 */
	public function indexAction(){
		if(!isset($_POST['UserName']) || !isset($_POST['password'])){
			header('Location:'.Mage::getBaseUrl());
			die;
		}
		$loginRadiusObject = new Loginradius_Sharing_Block_Getconfig();
		$method = "";
		// api connection handler detection
		if(in_array('curl', get_loaded_extensions())){
			$response = $loginRadiusObject->login_radius_check_connection($method = "curl");
			if($response == "service connection timeout" || $response == "timeout"){
				die(
				   json_encode(
					   array(
						 'status' => 0,
						 'message' => 'Uh oh, looks like something went wrong. Try again in a sec!'
					   )
				   )
				);
			}elseif($response == "connection error"){
				die(
				   json_encode(
					   array(
						 'status' => 0,
						 'message' => 'Problem in communicating LoginRadius API. Please check if one of the API Connection method mentioned above is working.'
					   )
				   )
				);
			}
		}elseif(ini_get('allow_url_fopen') == 1){
			$response = $loginRadiusObject->login_radius_check_connection($method = "fopen");
			if($response == "service connection timeout" || $response == "timeout"){
				die(
				   json_encode(
					   array(
						 'status' => 0,
						 'message' => 'Uh oh, looks like something went wrong. Try again in a sec!'
					   )
				   )
				);
			}elseif($response == "connection error"){
				die(
				   json_encode(
					   array(
						 'status' => 0,
						 'message' => 'Problem in communicating LoginRadius API. Please check if one of the API Connection method mentioned above is working.'
					   )
				   )
				);
			}
		}else{
			die(
			   json_encode(
				   array(
					 'status' => 0,
					 'message' => 'Please check your php.ini settings to enable CURL or FSOCKOPEN'
				   )
			   )
			);
		}
		// if any value posted is blank, halt
		foreach($_POST as $value){
			if(trim($value) == ""){
				die(
				   json_encode(
					   array(
						 'status' => 0,
						 'message' => 'Unexpected error occurred'
					   )
				   )
				);
			}
		}
		if(isset($_POST['lrsite'])){
			$append = 'create';
		}else{
			$append = 'login';
		}
		$queryString = array(
			'UserName' => trim($_POST["UserName"]),
			'password' => trim($_POST["password"]),
			'ip' => $_SERVER["REMOTE_ADDR"],
			'Url' => Mage::getBaseUrl (Mage_Core_Model_Store::URL_TYPE_WEB),
			'Useragent' => $_SERVER["HTTP_USER_AGENT"],
			'Technology' => 'Magento'
		);
		// append LR site name
		if(isset($_POST['lrsite'])){
			$queryString['AppName'] = trim($_POST['lrsite']);
		}
		$apiEndpoint = 'https://www.loginradius.com/api/v1/user.'.$append.'?'.http_build_query($queryString);
		// call LR api function
		$result = $loginRadiusObject -> login_radius_lr_login($apiEndpoint, $method);
		if(isset($result -> errorCode)){
			// error in login/registration
			die(
			   json_encode(
				   array(
					 'status' => 0,
					 'message' => $result -> message 
				   )
			   )
			);
		}else{
			// if new user created at LR
			if(isset($_POST['lrsite'])){
				// send post registration emails
				$this -> login_radius_send_registration_emails(trim($_POST["UserName"]), isset($_POST['admin']) ? $_POST['admin'] : '');
				die(
				   json_encode(
					   array(
						 'status' => 1,
						 'message' => 'registration successful',
						 'apikey' => $result[0] -> apikey
					   )
				   )
				);
			}else{									// user login at LR
				// show APPs in admin
				die(
				   json_encode(
					   array(
						 'status' => 1,
						 'message' => 'login successful',
						 'result' => $result
					   )
				   )
				);
			}
		}
	}
	/**
	 * send post-registration emails to newly registered user at LR.
	 */
	private function login_radius_send_registration_emails($email, $adminName){
		// send welcome emails
		$loginRadiusSubject = 'Welcome to LoginRadius, leading social infrastructure provider';
		$loginRadiusMessage = '<html>
		<body style="margin: 0; padding: 0; background: #E3EEFA;">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		  <tr>
			<td align="center" bgcolor="#E3EEFA" style="margin: 0;"><table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family:\'proxima-nova\',sans-serif; color: #6f6f6f;">
				 <tr bgcolor="#fff;" style="background-color:#ffffff;">
				  <td height="6" bgcolor="#ffffff;" style="background-color:#ffffff;"><img src="https://www.loginradius.com/cdn/content/images/top.jpg" width="600" height="60" border="0" /></td>
				</tr>
				<tr bgcolor="#ffffff;" style="background-color:#ffffff;">
				  <td align="center" bgcolor="#ffffff;" style="background-color:#ffffff;border-bottom:1px solid #D7E1EE; padding-bottom: 20px;"><img src="https://www.loginradius.com/cdn/content/images/logo.png" alt="Logo" width="245" height="48" border="0" /></td>
				</tr>
				<tr>
				  <td height="20" bgcolor="ffffff"></td>
				</tr>
				<tr>
				  <td bgcolor="#ffffff" style="padding-left:40px;padding-right:40px;line-height:20px;padding-bottom:20px;">
				  <p style="color:#000; font-size:15px; margin: 0px; padding: 0px;">Hi '.$adminName.',<br />
					  <br />
					  Thank you for signing up with<a href="https://www.loginradius.com" target="_blank"> LoginRadius</a>. You can log into<a href="https://www.loginradius.com" target="_blank"> www.loginradius.com </a>
					  <span>with the following User Name :</span><br/>
					  <strong>Email:</strong> '.$email.'</p>
					  </p></td>
				</tr>
				<tr>
				  <td bgcolor="#ffffff" style="padding-left:40px;padding-right:40px;line-height:20px;padding-bottom:20px;">
				  <p style="color:#000; font-size:15px; margin: 0px; padding: 0px;">We will be sending another email in a few moments to explain how to get started with LoginRadius. </p></td>
				</tr>
				<tr>
				  <td bgcolor="#ffffff" style="padding-left:40px;padding-right:40px;line-height:20px;padding-bottom:20px;">
				  <p style="color:#000; font-size:15px; margin: 0px; padding: 0px;"> To stay tuned with LoginRadius updates, we highly recommend you connect with us on:<a href="https://www.facebook.com/pages/LoginRadius/119745918110130" target="_blank"> Facebook</a>, <a href="https://plus.google.com/114515662991809002122/" target="_blank">Google+</a>, <a href="https://twitter.com/LoginRadius">Twitter</a> and/or <a  href="http://www.linkedin.com/company/2748191?trk=tyah" target="_blank">Linkedin</a> </p></td>
				</tr>
				<tr>
				  <td bgcolor="#ffffff" style="padding:10px 0;"><table width="520" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ffffff" style="font-size: 13px;">
					  <tr>
						<td height="20"><p style="color:#000; font-size:14px; text-align: justify; padding-bottom:4px;margin: 0px;">Thank you,</p></td>
					  </tr>
					  <tr>
						<td height="20"><p style="color:#000; font-size:14px; text-align: justify; padding-bottom: 4px;margin: 0px;"><strong>LoginRadius Team</strong></p></td>
					  </tr>
					  <tr>
						<td height="20"><p style="color:#6c6c6c; font-size:14px; text-align: justify;margin: 0px; padding: 0px;"><a href="http://www.loginradius.com/" target="_blank">www.LoginRadius.com</a></p></td>
					  </tr>
					</table></td>
				</tr>
				<tr>
				  <td bgcolor="#ffffff"><table width="600" cellpadding="0" cellspacing="0" border="0" style="font-size: 11px;">
					  <tr>
						<td align="center">
						<p style="line-height: 18px; color: rgb(0, 0, 0); border-top: 1px solid rgb(215, 225, 238); padding-top: 20px; font-size: 12px;margin: 0px;">LoginRadius is <strong>Canada\'s Top 50 Startup </strong><br/>
							Partner with<strong> Mozilla, Microsoft, DynDNS, X-Cart </strong></b></p></td>
					  </tr>
					</table></td>
				</tr>
					  <tr>
				  <td bgcolor="#ffffff"><table width="600" cellpadding="0" cellspacing="0" border="0" style="font-size: 12px;">
					  <tr>
						<td align="center" style="padding-top:5px;"><table cellpadding="0" cellspacing="0" border="0">
							<tr>
							  <td><p style="line-height: 18px; color: rgb(0, 0, 0); font-size: 12px;margin: 0px; padding: 0px;"><strong>Connect to us :</strong> </p></td>
							  <td  style="padding-left:5px;"><a href="http://blog.LoginRadius.com"  target="_blank"><img src="https://www.loginradius.com/cdn/content/images/blog.png" border="0" alt="Blog" ></a></td>
							  <td  style="padding-left:5px;"><a href="https://www.facebook.com/pages/LoginRadius/119745918110130" target="_blank"><img src="https://www.loginradius.com/cdn/content/images/facebook.png" border="0" alt="Facebook" ></a></td>
							  <td  style="padding-left:5px;"><a href="https://plus.google.com/114515662991809002122/" target="_blank"><img src="https://www.loginradius.com/cdn/content/images/googleplus.png" border="0" alt="Google Plus" ></a></td>
							  <td  style="padding-left:5px;"><a href="https://twitter.com/LoginRadius"> <img src="https://www.loginradius.com/cdn/content/images/twitter.png" border="0" alt="Twitter" ></a></td>
							  <td  style="padding-left:5px;"><a  href="http://www.linkedin.com/company/2748191?trk=tyah" target="_blank"><img src="https://www.loginradius.com/cdn/content/images/linkedin.png" border="0" alt="Linkedin" ></a></td>
							</tr>
						  </table></td>
					  </tr>
					</table></td>
				</tr>
			   
		<tr>
				  <td height="6"><img src="https://www.loginradius.com/cdn/content/images/bottom.jpg" width="600" height="80" border="0" /></td>
				</tr>

			  </table></td>
		  </tr>
		</table>
		</body>
		</html>';
			$this -> loginRadiusEmail($loginRadiusSubject, $loginRadiusMessage, $email);
			$loginRadiusSubject = 'Getting started with LoginRadius - how to integrate social login';
			$loginRadiusMessage = '<html>
	<body style="margin: 0; padding: 0; background: #E3EEFA;">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	  <tr>
		<td align="center" bgcolor="#E3EEFA" style="margin: 0;"><table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family:\'proxima-nova\',sans-serif; color: #6f6f6f;">
				   <tr bgcolor="#fff;" style="background-color:#ffffff;">
			  <td height="6"><img src="https://www.loginradius.com/cdn/content/images/top.jpg" width="600" height="60" border="0" /></td>
			</tr>
			<tr bgcolor="#fff;" style="background-color:#ffffff;">
			  <td align="center" bgcolor="#ffffff;" style="background-color:#ffffff;border-bottom:1px solid #D7E1EE; padding-bottom: 20px;"><img src="https://www.loginradius.com/cdn/content/images/logo.png" alt="Logo" width="245" height="48" border="0" /></td>
			</tr>
			<tr>
			  <td height="20" bgcolor="ffffff"></td>
			</tr>
			<tr>
			  <td bgcolor="#ffffff" style="padding-left:40px;padding-right:40px;line-height:20px;padding-bottom:20px;">
			  <p style="color:#000; font-size:15px; margin: 0px; padding: 0px;">Hi '.$adminName.',<br />
				  <br />
				  To make sure that you successfully implement LoginRadius on your website, we want to share some important documents with you and to tell you how LoginRadius Support works. </p></td>
			</tr>
			<tr>
			  <td bgcolor="#ffffff" style="padding-left:40px;padding-right:40px;line-height:20px;padding-bottom:20px;">
			  <p style="color:#000; font-size:15px; margin: 0px; padding: 0px;"> <strong>Getting started</strong> </p>
				<ul>
				  <li style="color:#000; font-size:15px;"><a href="http://support.loginradius.com/customer/portal/articles/593958-how-do-i-implement-loginradius-on-my-website-" target="_blank">How to implement LoginRadius on a website?</a></li>
				  <li style="color:#000; font-size:15px; padding-top: 7px;"><a href="http://support.loginradius.com/customer/portal/articles/677100-how-to-get-loginradius-api-key-and-secret" target="_blank">How to get LoginRadius API Key and Secret?</a></li>
				  <li style="color:#000; font-size:15px; padding-top: 7px;"><a href="http://support.loginradius.com/customer/portal/topics/277795-id-providers-apps/articles" target="_blank">How to get API Key and Secret for various ID Providers?</a></li>
				  <li style="color:#000; font-size:15px; padding-top: 7px;"><a href="http://support.loginradius.com/customer/portal/articles/594002-loginradius-add-ons" target="_blank">List of LoginRadius CMS Plugins</a></li>
				  <li style="color:#000; font-size:15px; padding-top: 7px;"><a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-sdks" target="_blank">List of LoginRadius Programming SDKs </a></li>
				</ul></td>
			</tr>
			<tr>
			  <td bgcolor="#ffffff" style="padding-left:40px;padding-right:40px;line-height:20px;padding-bottom:20px;">
			  <p style="color:#000; font-size:15px;margin: 0px; padding: 0px; "> <strong>How does LoginRadius Support work? </strong> </p>
				<ul>
				  <li style="color:#000; font-size:15px;">You can access &amp; search all of our help documents at our <a href="http://support.loginradius.com/" target="_blank">Support Centre.</a></li>
				  <li style="color:#000; font-size:15px; padding-top: 7px;">For VIP customers, we provide <a href="http://support.loginradius.com/" target="_blank">24/7 email support.</a> (Click on \'Email Us\')</li>
				  <li style="color:#000; font-size:15px; padding-top: 7px;">For Basic (FREE) customers, we have a <a href="http://community.loginradius.com/" target="_blank">LoginRadius Developer Community</a>.</li>
				</ul></td>
			</tr>
			<tr>
							<td bgcolor="#ffffff" style="padding-left: 40px; padding-right: 40px; line-height: 20px;
								padding-bottom: 0px;">
								<p style="color: #000; font-size: 15px;">

								To stay tuned with LoginRadius updates, we highly recommend you connect with us on:  <a target="_blank"
										href="https://www.facebook.com/pages/LoginRadius/119745918110130">Facebook, 
									</a><a target="_blank" href="https://plus.google.com/114515662991809002122/">Google+</a>,
									<a target="_blank" href="https://twitter.com/LoginRadius">Twitter</a> and <a
										target="_blank" href="http://www.linkedin.com/company/2748191?trk=tyah">LinkedIn</a>
								</p>
							</td>
						</tr>
			<tr>
			  <td bgcolor="#ffffff" style="padding:10px 0;"><table width="520" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ffffff" style="font-size: 13px;">
				  <tr>
					<td height="20"><p style="color:#000; font-size:14px; text-align: justify; padding-bottom:4px;margin: 0px;">Thank you,</p></td>
				  </tr>
				  <tr>
					<td height="20"><p style="color:#000; font-size:14px; text-align: justify; padding-bottom: 4px;margin: 0px;"><strong>LoginRadius Team</strong></p></td>
				  </tr>
				  <tr>
					<td height="20"><p style="color:#6c6c6c; font-size:14px; text-align: justify;margin: 0px; padding: 0px;"><a href="http://www.LoginRadius.com/?utm_source=newsletter&utm_medium=email&utm_campaign=analytics" target="_blank">www.LoginRadius.com</a></p></td>
				  </tr> 
				  <tr>

					<td height="20">
				   </td>
				  </tr>
				</table></td>
			</tr>
			<tr>
			  <td bgcolor="#ffffff"><table width="600" cellpadding="0" cellspacing="0" border="0" style="font-size: 11px;">
				  <tr>
					<td align="center">
					<p style="line-height: 18px; color: rgb(0, 0, 0); border-top: 1px solid rgb(215, 225, 238); padding-top: 20px; font-size: 12px;margin: 0px;">LoginRadius is among <strong>Canada\'s Top 50 Startup </strong><br/>
						Partner with<strong> Mozilla, Microsoft, DynDNS, X-Cart </strong></b></p></td>
				  </tr>
				</table></td>
			</tr>
				  <tr>
			  <td bgcolor="#ffffff"><table width="600" cellpadding="0" cellspacing="0" border="0" style="font-size: 12px;">
				  <tr>
					<td align="center" style="padding-top:5px;"><table cellpadding="0" cellspacing="0" border="0">
						<tr>
						  <td><p style="line-height: 18px; color: rgb(0, 0, 0); font-size: 12px;margin: 0px; padding: 0px;"><strong>Connect to us :</strong> </p></td>
						  <td  style="padding-left:5px;"><a href="http://blog.LoginRadius.com"  target="_blank"><img src="https://www.loginradius.com/cdn/content/images/blog.png" border="0" alt="Blog" ></a></td>
						  <td  style="padding-left:5px;"><a href="https://www.facebook.com/pages/LoginRadius/119745918110130" target="_blank"><img src="https://www.loginradius.com/cdn/content/images/facebook.png" border="0" alt="Facebook" ></a></td>
						  <td  style="padding-left:5px;"><a href="https://plus.google.com/114515662991809002122/" target="_blank"><img src="https://www.loginradius.com/cdn/content/images/googleplus.png" border="0" alt="Google Plus" ></a></td>
						  <td  style="padding-left:5px;"><a href="https://twitter.com/LoginRadius"> <img src="https://www.loginradius.com/cdn/content/images/twitter.png" border="0" alt="Twitter" ></a></td>
						  <td  style="padding-left:5px;"><a  href="http://www.linkedin.com/company/2748191?trk=tyah" target="_blank"><img src="https://www.loginradius.com/cdn/content/images/linkedin.png" border="0" alt="Linkedin" ></a></td>
						</tr>
					  </table></td>
				  </tr>
				</table></td>
			</tr>   
			<tr>
			  <td height="6"><img src="https://www.loginradius.com/cdn/content/images/bottom.jpg" width="600" height="80" border="0" /></td>
			</tr>
		  </table></td>
			</tr>
			</table>
		</body>
		</html>';
		$this -> loginRadiusEmail($loginRadiusSubject, $loginRadiusMessage, $email);
	}
	/**
	 * Send email
	 */
	private function loginRadiusEmail( $subject, $message, $to, $toName = '' ){
		$mail = new Zend_Mail('UTF-8'); //class for mail
		$mail->addHeader('MIME-Version', '1.0');
		$mail->addHeader('Content-Type', 'text/html');
		$mail->setBodyHtml( $message ); //for sending message containing html code
		$mail->setFrom( "no-reply@loginradius.com", 'LoginRadius' );
		$mail->addTo( $to, $toName );
		$mail->setSubject( $subject );
		try{
		  $mail->send();
		}catch(Exception $ex) {
		}
	}
}