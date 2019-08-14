<?php
class Loginradius_Sharing_Helper_Data extends Mage_Core_Helper_Abstract {
    /**
     * Returns whether the Enabled config variable is set to true
     *
     * @return bool
     */
    public function isSharingEnabled() {
     if (Mage::getStoreConfig('sharing_options/messages/enabled') == '1'){
            return true;
	 }
        return false;
    }
}