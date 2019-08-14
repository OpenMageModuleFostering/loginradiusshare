<?php
class Loginradius_Sharing_Model_System_Config_Help extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
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
		<!-- Help & Documentation -->
		<fieldset class="loginRadiusHelpDiv" style="margin-right:13px; width:65%">
		<h4 style="border-bottom:#d7d7d7 1px solid;"><strong>Help &amp; Documentations</strong></h4>
		<ul style="float:left; margin-right:43px">
			<li><a target="_blank" href="http://support.loginradius.com/customer/portal/articles/1056696-magento-social-login-installation-configuration-and-troubleshooting">Extension Installation, Configuration and Troubleshooting</a></li>
			<li><a target="_blank" href="http://support.loginradius.com/customer/portal/articles/677100-how-to-get-loginradius-api-key-and-secret">How to get LoginRadius API Key &amp; Secret</a></li>
			<li><a target="_blank" href="http://support.loginradius.com/customer/portal/articles/1056696-magento-social-login-installation-configuration-and-troubleshooting#multisite">Magento Multisite Feature</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/product/sociallogin">LoginRadius Products</a></li>
		</ul>
		<ul style="float:left; margin-right:43px">
			<li><a target="_blank" href="http://community.loginradius.com/">Discussion Forum</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/loginradius/about">About LoginRadius</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/addons">Social Plugins</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/sdks/loginradiussdk">Social SDKs</a></li>
		</ul>
		</fieldset>
		<?php
    }
}