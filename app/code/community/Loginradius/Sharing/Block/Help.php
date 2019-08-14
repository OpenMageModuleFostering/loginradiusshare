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
			<li><a target="_blank" href="http://ish.re/9WBZ">Extension Installation, Configuration and Troubleshooting</a></li>
			<li><a target="_blank" href="http://ish.re/AEFD">How to get LoginRadius API Key</a></li>
			<li><a target="_blank" href="http://ish.re/9WBZ">Magento Multisite Feature</a></li>
			<li><a target="_blank" href="http://ish.re/5P2D">LoginRadius Products</a></li>
		</ul>
		<ul style="float:left; margin-right:43px">
			<li><a target="_blank" href="http://community.loginradius.com/">Discussion Forum</a></li>
			<li><a target="_blank" href="http://ish.re/HC0B">About LoginRadius</a></li>
			<li><a target="_blank" href="http://ish.re/8PFR">Social Plugins</a></li>
			<li><a target="_blank" href="http://ish.re/C9F7">Social SDKs</a></li>
		</ul>';
        return $content;
    }
}