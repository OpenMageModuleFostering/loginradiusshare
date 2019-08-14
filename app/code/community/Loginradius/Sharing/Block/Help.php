<?php
class Loginradius_Sharing_Block_Help extends Mage_Adminhtml_Block_System_Config_Form_Fieldset {
    public function render(Varien_Data_Form_Element_Abstract $element) {
        $html = $this->_getHeaderHtml($element);
        $html.= $this->_getFieldHtml($element);
        $html .= $this->_getFooterHtml($element);
        return $html;
    }
    protected function _getFieldHtml($fieldset) {
        $content = '<ul style="float:left; margin-right:43px">
			<li><a target="_blank" href="http://support.loginradius.com/customer/portal/articles/1296571-magento-social-sharing-installation-configuration-and-troubleshooting">Extension Installation, Configuration and Troubleshooting</a></li>
			<li><a target="_blank" href="http://support.loginradius.com/customer/portal/articles/677100-how-to-get-loginradius-api-key-and-secret">How to get LoginRadius API Key</a></li>
			<li><a target="_blank" href="http://support.loginradius.com/customer/portal/articles/1056696-magento-social-login-installation-configuration-and-troubleshooting#multisite">Magento Multisite Feature</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/product/sociallogin">LoginRadius Products</a></li>
		</ul>
		<ul style="float:left; margin-right:43px">
			<li><a target="_blank" href="http://community.loginradius.com/">Discussion Forum</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/loginradius/about">About LoginRadius</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/addons">Social Plugins</a></li>
			<li><a target="_blank" href="http://www.loginradius.com/sdks/loginradiussdk">Social SDKs</a></li>
		</ul>';
        return $content;
    }
}