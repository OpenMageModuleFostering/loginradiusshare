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
			<a href="https://www.loginradius.com/">LoginRadius</a> <a href="http://ish.re/9RZM" target="_blank">Social Login</a>,
                        <a href="http://ish.re/9RZO" target="_blank">Social Share</a>,
                        <a href="http://ish.re/9RZQ" target="_blank">Social Invite</a>,
                        <a href="http://ish.re/83Y8" target="_blank">User Social Profile Data</a>,
                        <a href="http://ish.re/83Y8" target="_blank">User Profile Access</a>,
                        <a href="http://ish.re/9RZS" target="_blank">Single Sign-On</a>,
                        <a href="http://ish.re/AQ5L" target="_blank">Social Engagement  Analytics</a>
                        as single Unified API.
		</p>
		<p>
			<?php echo $this->__('We also offer Social Plugins for') ?>
                <a href="http://ish.re/ADDT" target="_blank">Wordpress</a>,
                <a href="http://ish.re/8PE6" target="_blank">Joomla</a>,
                <a href="http://ish.re/8PE9" target="_blank">Drupal</a>,
                <a href="http://ish.re/8PED" target="_blank">vBulletin</a>,
                <a href="http://ish.re/8PEE" target="_blank">VanillaForum</a>,
                <a href="http://ish.re/8PEG" target="_blank">osCommerce</a>,
                <a href="http://ish.re/8PEH" target="_blank">PrestaShop</a>,
                <a href="http://ish.re/8PFQ" target="_blank">X-Cart</a>,
                <a href="http://ish.re/8PFR" target="_blank">Zen-Cart</a>,
                <a href="http://ish.re/8PFS" target="_blank">DotNetNuke</a>,
                <a href="http://ish.re/8PFT" target="_blank">SMF</a><?php echo $this->__('and') ?>
                <a href="http://ish.re/8PFV" target="_blank">phpBB</a> !
		</p>
                </br>
            <div style="margin-top:10px">
                <a style="text-decoration:none;margin-right:10px;" href="https://www.loginradius.com/" target="_blank">
                    <input class="form-button" type="button" value="<?php echo $this->__('Set up my FREE account!') ?>">
                </a>
                <a class="loginRadiusHow" target="_blank"
                   href="http://ish.re/ATM4">(<?php echo $this->__('How to set up an account?') ?>)</a>
            </div>
		</fieldset>
		<!-- Get Updates -->			
		<fieldset class="loginRadiusFieldset" style="width:26%; background-color: rgb(231, 255, 224); border: 1px solid rgb(191, 231, 176); padding-bottom:6px;">
		<div>
			<strong>Extension Version:</strong> <?php echo Mage::getConfig()->getNode()->modules->Loginradius_Sharing->version ?><br/>
			<strong>Author:</strong> LoginRadius<br/>
			<strong>Website:</strong> <a href="https://www.loginradius.com" target="_blank">www.loginradius.com</a> <br/>
			<strong>Community:</strong> <a href="http://community.loginradius.com" target="_blank">community.loginradius.com</a> <br/>
			To receive updates on new features, releases, etc. Please connect to one of our social media pages
			<div id="lr_media_pages_container">
                    <a target="_blank" href="https://www.facebook.com/loginradius"><img
                            src="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . 'adminhtml/default/default/Loginradius/Sharing/images/media-pages/facebook.png'; ?>"></a>
                    <a target="_blank" href="https://twitter.com/LoginRadius"><img
                            src="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . 'adminhtml/default/default/Loginradius/Sharing/images/media-pages/twitter.png'; ?>"></a>
                    <a target="_blank" href="https://plus.google.com/+Loginradius"> <img
                            src="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . 'adminhtml/default/default/Loginradius/Sharing/images/media-pages/google.png'; ?>"></a>
                    <a target="_blank" href="http://www.linkedin.com/company/loginradius"> <img
                            src="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . 'adminhtml/default/default/Loginradius/Sharing/images/media-pages/linkedin.png'; ?>"></a>
                    <a target="_blank" href="https://www.youtube.com/user/LoginRadius"> <img
                            src="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN) . 'adminhtml/default/default/Loginradius/Sharing/images/media-pages/youtube.png'; ?>"></a>
                </div>
		</div>
		</fieldset>
		<div style='clear:both'></div>
		<script type="text/javascript">var islrsharing = true; var islrsocialcounter = true;</script>
		<script type="text/javascript" src="//share.loginradius.com/Content/js/LoginRadius.js" id="lrsharescript"></script>
		<script type="text/javascript">
			window.onload = function(){
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
		</script>				
		<?php
    }
}