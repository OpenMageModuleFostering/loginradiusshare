<?php
class Loginradius_Sharing_Model_System_Config_Info extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{
	/**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element){
        $html = $element->getComment();
        if(!$html){
        	$html = $element->getText();
    	}
		?>
		<fieldset class="loginRadiusFieldset" style="margin-right:13px; background-color:#EAF7FF; border-color:rgb(195, 239, 250); padding-bottom:25px; width:65%; height: 173px">
		<h4 style="color:#000"><strong>Thank you for installing LoginRadius Simplified Social Share extension!</strong></h4>
		<p>
			<a href="https://www.loginradius.com/">LoginRadius</a> provides <a target="_blank" href="https://www.loginradius.com/loginradius/product-overview#SocialLoginTab">Social Login</a>, <a target="_blank" href="https://www.loginradius.com/loginradius/product-overview#SocialSharingTab">Social Share</a>, <a target="_blank" href="https://www.loginradius.com/loginradius/product-overview#FriendsInviteTab">Friend Invite</a>, <a target="_blank" href="https://www.loginradius.com/loginradius/product-overview#UserProfileDataTab">User Social Profile Data</a>, <a target="_blank" href="https://www.loginradius.com/loginradius/product-overview#OnlineTab">User Profile Access</a>, <a target="_blank" href="https://www.loginradius.com/loginradius/product-overview#SingleSignOnTab">Single Sign-on</a> and <a target="_blank" href="https://www.loginradius.com/loginradius/product-overview#SocialAnalyticsTab">Social Analytics</a> as single Unified API.
		</p>
		<p>
			We also have ready to use plugins for <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#wordpressplugin" target="_blank">Wordpress</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#joomlaextension" target="_blank">Joomla</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#drupalmodule" target="_blank">Drupal</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#vBulletinplugin" target="_blank">vBulletin</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#vanillaaddons" target="_blank">VanillaForum</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#osCommerceaddons" target="_blank">OSCommerce</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#prestashopmodule" target="_blank">PrestaShop</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#xcartextension" target="_blank">X-Cart</a>, <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#zencartplugin" target="_blank">Zen-Cart</a> and <a href="https://www.loginradius.com/loginradius-for-developers/loginRadius-cms#dotnetnukemodule" target="_blank">DotNetNuke</a>!
		</p>
		</fieldset>
		<!-- Get Updates -->			
		<fieldset class="loginRadiusFieldset" style="width:26%; background-color: rgb(231, 255, 224); border: 1px solid rgb(191, 231, 176); padding-bottom:6px;">
		<div>
			<strong>Extension Version:</strong> <?php echo Mage::getConfig()->getNode()->modules->Loginradius_Sharing->version ?><br/>
			<strong>Author:</strong> LoginRadius<br/>
			<strong>Website:</strong> <a href="https://www.loginradius.com" target="_blank">www.loginradius.com</a> <br/>
			<strong>Community:</strong> <a href="http://community.loginradius.com" target="_blank">community.loginradius.com</a> <br/>
			To receive updates on new features, future releases and other updates, please connect with us on
			Facebook-
			<div>
				<div style="float:left">
					<iframe rel="tooltip" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 46px; height: 61px; margin-right:10px" src="//www.facebook.com/plugins/like.php?app_id=194112853990900&amp;href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FLoginRadius%2F119745918110130&amp;send=false&amp;layout=box_count&amp;width=90&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=90" data-original-title="Like us on Facebook"></iframe>
				</div>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>
		</fieldset>
		<div style='clear:both'></div>
		<?php
		$loginRadiusObject = new Loginradius_Sharing_Block_Getconfig();
		if(trim($loginRadiusObject -> getApikey()) == ''){
		?>
		<div id="loginRadiusLoginForm">
			<h4 id="loginRadiusFormTitle">Register your LoginRadius Account to change settings as per your requirements!</h4>
			<form id="loginRadiusLRForm">
			<table class="form-table">
				<tbody>
				<tr>
					<th><label for="username">Email</label></th>
					<td>
						<input type="text" name="username" id="username" class="regular-text">
					</td>
				</tr>
				<tr>
					<th><label for="password">Password</label></th>
					<td><input type="password" name="password" id="password" value="" class="regular-text"></td>
				</tr>
				<tr id="confirmPasswordRow">
					<th><label for="confirm_password">Confirm Password</label></th>
					<td><input onblur="loginRadiusConfirmPasswordValidate()" type="password" name="confirm_password" id="confirm_password" value="" class="regular-text"></td>
				</tr>
				<tr id="lrsiteRow">
					<th><label for="lrsite">LoginRadius Site</label></th>
					<td><input type="text" name="lrsite" id="lrsite" value="" class="regular-text"></td>
				</tr>
				<tr id="lrSiteMessageRow">
					<th></th>
					<td><span style="font-size:11px">(Your LoginRadius Site Name must not include periods ('.') or any other special symbols. Just use letters (A-Z), digits (0-9) or dash ( - )!)</span></td>
				</tr>
				<tr>
					<td><input type="button" id="loginRadiusSubmit" class="form-button" value="Register" /></td>
					<td><div id="loginRadiusMessage"></div></td>
				</tr>
				<tr>
					<td style="width:200px">
					<a style="text-decoration:none" id="loginRadiusToggleFormLink" href="javascript:void(0)" onclick="loginRadiusToggleForm('login')">Already have an account?</a><br/>
					<a style="text-decoration:none" target="_blank" href="https://www.loginradius.com/login/forgotten" onclick="loginRadiusToggleForm('login')">Forgot your password?</a>
					</td>
				</tr>
				</tbody>
			</table>
			</form>
		</div>
		<?php
		}
		?>
		<script type="text/javascript">var islrsharing = true; var islrsocialcounter = true;</script>
		<script type="text/javascript" src="//share.loginradius.com/Content/js/LoginRadius.js" id="lrsharescript"></script>
		<script type="text/javascript">
			window.onload = function(){
				<?php
				if(trim($loginRadiusObject -> getApikey()) == ''){
					?>
					$loginRadiusSharingJquery('.section-config, .entry-edit-head, .collapseable, .config, .collapseable').css('display', 'none');
					// bind LR login/register API call to the form button
					document.getElementById('loginRadiusSubmit').onclick = function(){
						loginRadiusLRLogin(this);
					};
				<?php
				}
				?>
				var sharingType = ['horizontal', 'vertical'];
				var sharingModes = ['Sharing', 'Counter'];
				for(var i = 0; i < sharingType.length; i++){
					for(var j = 0; j < sharingModes.length; j++){
						if(sharingModes[j] == 'Counter'){
							var providers = $SC.Providers.All;
						}else{
							var providers = $SS.Providers.More;
						}
						// populate sharing providers checkbox
						loginRadiusCounterHtml = "<ul class='checkboxes'>";
						// prepare HTML to be shown as Vertical Counter Providers
						for(var ii = 0; ii < providers.length; ii++){
							loginRadiusCounterHtml += '<li><input type="checkbox" id="'+sharingType[i]+'_'+sharingModes[j]+'_'+providers[ii]+'" ';
							loginRadiusCounterHtml += 'value="'+providers[ii]+'"> <label for="'+sharingType[i]+'_'+sharingModes[j]+'_'+providers[ii]+'">'+providers[ii]+'</label></li>';
						}
						loginRadiusCounterHtml += "</ul>";
						var tds = document.getElementById('row_sharing_options_'+sharingType[i]+'Sharing_'+sharingType[i]+sharingModes[j]+'Providers').getElementsByTagName('td');
						tds[1].innerHTML = loginRadiusCounterHtml;
					}
					document.getElementById('row_sharing_options_'+sharingType[i]+'Sharing_'+sharingType[i]+'CounterProvidersHidden').style.display = 'none';
				}
				loginRadiusSharingPrepareAdminUI();
			}
			// toggle sharing/counter providers according to the theme and sharing type
			function loginRadiusToggleSharingProviders(element, sharingType){
				if(element.value == '32' || element.value == '16'){
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'SharingProviders').style.display = 'table-row';
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'CounterProviders').style.display = 'none';
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'SharingProvidersHidden').style.display = 'table-row';
				}else if(element.value == 'single_large' || element.value == 'single_small'){
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'SharingProviders').style.display = 'none';
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'CounterProviders').style.display = 'none';
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'SharingProvidersHidden').style.display = 'none';
				}else{
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'SharingProviders').style.display = 'none';
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'CounterProviders').style.display = 'table-row';
					document.getElementById('row_sharing_options_'+sharingType+'Sharing_'+sharingType+'SharingProvidersHidden').style.display = 'none';
				}
			}
			<?php
			if(trim($loginRadiusObject -> getApikey()) == ''){
			?>
			// ajax for user registration/login to LR.com. Password validation
			function loginRadiusLRLogin(elem){
				
				// form validation
				var email = $loginRadiusSharingJquery('#username').val().trim();
				if(email == "" || $loginRadiusSharingJquery('#password').val().trim() == "" || ($loginRadiusSharingJquery('#lrsiteRow').css('display') != 'none' && $loginRadiusSharingJquery('#lrsite').val().trim() == "")){
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Please fill all the fields.').css('color', 'red');
					return;
				}
				// email validation
				var atPosition = email.indexOf("@");
				var dotPosition = email.lastIndexOf(".");
				if(atPosition < 1 || dotPosition < atPosition+2 || dotPosition+2>=email.length){
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Please enter a valid email address.').css('color', 'red');
					return;
				}
				//password length validation
				if($loginRadiusSharingJquery('#password').val().length < 6 || $loginRadiusSharingJquery('#password').val().length > 32 ) {
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Password length should be minimum of 6 characters and maximum 32 characters').css('color', 'red');
					return;
				}
				
				// confirm password validation
				if($loginRadiusSharingJquery('#confirmPasswordRow').css('display') != 'none' && !loginRadiusConfirmPasswordValidate()){
					return;
				}
				//Site Name validation
				if ($loginRadiusSharingJquery('#lrsiteRow').css('display') != 'none' && $loginRadiusSharingJquery('#lrsite').val().match(/[.]/g)) {
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Symbol "." not allowed in LoginRadius Site name.').css('color', 'red');
					return;
				}
				if ($loginRadiusSharingJquery('#lrsiteRow').css('display') != 'none' && $loginRadiusSharingJquery('#lrsite').val().match(/[_]/g)) {
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Symbol "_" not allowed in LoginRadius Site name.').css('color', 'red');
					return;
				}
				if($loginRadiusSharingJquery('#lrsiteRow').css('display') != 'none' && $loginRadiusSharingJquery('#lrsite').val().length < 4 ) {
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Site name must be longer than three characters.').css('color', 'red');
					return;
				}
				 var url = "https://" + $loginRadiusSharingJquery('#lrsite').val().trim() + ".hub.loginradius.com";
				 var regularExpression = "^(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&%\$#_]*)?$";
				if ($loginRadiusSharingJquery('#lrsiteRow').css('display') != 'none' && !url.match(regularExpression)) {
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Site Name is not valid.').css('color', 'red');
					return;
				}
				// processing message
				$loginRadiusSharingJquery('#loginRadiusMessage').html('<img width="20" height="20" src="<?php echo Mage::getDesign()->getSkinUrl('Loginradius/Sharing/images/loading_icon.gif',array('_area'=>'frontend')); ?>" style="float:left;margin-right: 5px;" /><span style="color:blue; width:auto">Please wait. This may take a few minutes...</span>');
				// create data object
				var dataObject = {
				<?php
				$adminDetails = Mage::getSingleton('admin/session')->getUser()->getData();
				$adminName = '';
				if(isset($adminDetails['firstname']) && $adminDetails['firstname'] != ''){
					$adminName .= $adminDetails['firstname'];
				}
				if(isset($adminDetails['lastname']) && $adminDetails['lastname'] != ''){
					$adminName .= ' ' . $adminDetails['lastname'];
				}
				if($adminName == ''){
					$adminName = isset($adminDetails['username']) ? $adminDetails['username'] : '';
				}
				?>
					UserName: $loginRadiusSharingJquery('#username').val().trim(),
					password: $loginRadiusSharingJquery('#password').val().trim(),
					<?php
					if($adminName != ''){
						?>
						admin: '<?php echo $adminName; ?>'
						<?php
					}
					?>
				};
				if($loginRadiusSharingJquery('#lrsiteRow').css('display') != 'none'){
					dataObject.lrsite = $loginRadiusSharingJquery('#lrsite').val().trim();
				}
				$loginRadiusSharingJquery.ajax({
				  type: 'POST',
				  url: '<?php echo Mage::getBaseUrl().'sharing'; ?>',
				  data: dataObject,
				  dataType: 'json',
				  success: function(data, textStatus, XMLHttpRequest){
					if(data.status == 0){
						// show the message
						$loginRadiusSharingJquery('#loginRadiusMessage').html(data.message).css('color', 'red');
					}else if(data.status == 1 && data.message == 'registration successful'){
						document.getElementById('sharing_options_messages_appid').value = data.apikey;
						$loginRadiusSharingJquery('#loginRadiusMessage').html('<img width="20" height="20" src="<?php echo Mage::getDesign()->getSkinUrl('Loginradius/Sharing/images/loading_icon.gif',array('_area'=>'frontend')); ?>" style="float:left;margin-right: 5px;" /><span style="color:blue; width:auto">Please wait. This may take a few minutes...</span>');
						// save the options
						configForm.submit();
					}else if(data.status == 1 && data.message == 'login successful'){
						// display the app list
						var html = '<h3 id="loginRadiusFormTitle">Site Selection</h3><table class="form-table"><tbody><tr><th><label for="lrSites">Select a LoginRadius site</label></th><td><select id="lrSites"><option value="">--Select a Site--</option>';
						for(var i = 0; i < data.result.length; i++){
							html += '<option value="'+data.result[i].apikey+'">'+data.result[i].appName+'</option>';
						}
						html += '</select>';
						html += '</td></tr><tr><td><input type="button" id="loginRadiusLRSiteSave" class="form-button" value="Save" /></td><td><div id="loginRadiusMessage"></div></td></tr>';
						$loginRadiusSharingJquery('#loginRadiusLoginForm').html(html);
						document.getElementById('loginRadiusLRSiteSave').onclick = function(){
							loginRadiusSaveLRSite();
						};
					}
				  },
				  error: function(a, b, c){
					alert(JSON.stringify(a, null, 4)+"\n"+b+"\n"+c)
				  }
				});
			}
			// toggle between login and registration form
			function loginRadiusToggleForm(val){
				if(val == 'login'){
					document.getElementById('lrsiteRow').style.display = 'none';
					document.getElementById('lrSiteMessageRow').style.display = 'none';
					document.getElementById('confirmPasswordRow').style.display = 'none';
					document.getElementById('loginRadiusToggleFormLink').innerHTML = 'New to LoginRadius, Register Now!';
					document.getElementById('loginRadiusToggleFormLink').setAttribute('onclick', 'loginRadiusToggleForm("register")');
					document.getElementById('loginRadiusSubmit').value = 'Login';
					document.getElementById('loginRadiusFormTitle').innerHTML = 'Login to your LoginRadius Account to change settings as per your requirements!';
				}else{
					document.getElementById('lrsiteRow').style.display = 'table-row';
					document.getElementById('lrSiteMessageRow').style.display = 'table-row';
					document.getElementById('confirmPasswordRow').style.display = 'table-row';
					document.getElementById('loginRadiusToggleFormLink').innerHTML = 'Already have an account?';
					document.getElementById('loginRadiusToggleFormLink').setAttribute('onclick', 'loginRadiusToggleForm("login")');
					document.getElementById('loginRadiusSubmit').value = 'Register';
					document.getElementById('loginRadiusFormTitle').innerHTML = 'Register your LoginRadius Account to change settings as per your requirements!';
				}
				document.getElementById('loginRadiusMessage').innerHTML = '';
			}
			// confirm password validation
			function loginRadiusConfirmPasswordValidate(){
				var loginRadiusNotificationDiv = document.getElementById('loginRadiusMessage');
				if(document.getElementById('password').value.trim() != document.getElementById('confirm_password').value.trim()){
					loginRadiusNotificationDiv.innerHTML = 'Passwords do not match.';
					loginRadiusNotificationDiv.style.color = 'red';
					return false;
				}else{
					loginRadiusNotificationDiv.innerHTML = '';
					return true;
				}
			}
			
			// save selected LR Site API Key
			function loginRadiusSaveLRSite(){
				if($loginRadiusSharingJquery('#lrSites').val().trim() == ""){
					$loginRadiusSharingJquery('#loginRadiusMessage').html('Please select a site').css('color', 'red');
					return;
				}
				document.getElementById('sharing_options_messages_appid').value = $loginRadiusSharingJquery('#lrSites').val();
				$loginRadiusSharingJquery('#loginRadiusMessage').html('<img width="20" height="20" src="<?php echo Mage::getDesign()->getSkinUrl('Loginradius/Sharing/images/loading_icon.gif',array('_area'=>'frontend')); ?>" style="float:left;margin-right: 5px;" /><span style="color:blue; width:auto">Please wait. This may take a few minutes...</span>');
				// save the options
				configForm.submit();
			}
			<?php
			}
			?>
		</script>				
		<?php
    }
}