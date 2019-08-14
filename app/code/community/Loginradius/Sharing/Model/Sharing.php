<?php
class Loginradius_Sharing_Model_Sociallogin extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sharing/sharing');
    }
}