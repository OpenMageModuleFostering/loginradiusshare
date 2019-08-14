<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 *  Sharing system config info model
 *
 * @category    Loginradius
 * @package     Loginradius_Sharing
 * @author      LoginRadius Team
 */
class Loginradius_Sharing_Model_System_Config_Info extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     *
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        // Get LoginRadius Module Thanks message container..
        $this->render_module_thanks_message_container();

        // Get LoginRadius Module information container..
        $this->render_module_info_container();

        // Get LoginRadius Module Support Us container..
        $this->render_module_admin_script_container();
    }

    /**
     * Get LoginRadius Module Thanks message container..
     */
    public function render_module_thanks_message_container()
    {
        ?>
        <fieldset class="lr_admin_configuration_info_fieldsets lr_configuration_info_fieldsets_left" id="lr_thank_message_container">
            <h4 class="lr_admin_fieldset_title"><strong><?php echo $this->__('Thank you for installing LoginRadius Extension!') ?></strong></h4>

            <p>
                <a href="https://www.loginradius.com/">LoginRadius</a> provides <a href="http://ish.re/9RZM" target="_blank"> Social Login</a>,
                <a href="http://ish.re/9RZO" target="_blank">Social Share</a>,
                <a href="http://ish.re/HNIA" target="_blank">Social Invite</a>,
                <a href="http://ish.re/83Y8" target="_blank">User Social Profile Data</a>,
                <a href="http://ish.re/9RZS" target="_blank">Single Sign-On</a>,
                <a href="http://ish.re/AQ5L" target="_blank">Social Engagement Analytics</a>
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
                    <input class="form-button" type="button" onclick="window.open('https://www.loginradius.com')" value="<?php echo $this->__('Set up LoginRadius account!') ?>"/>
                <a class="loginRadiusHow" target="_blank" href="http://ish.re/ATM4">(<?php echo $this->__('How to set up an account?') ?>)</a>
            </div>
        </fieldset>
    <?php
    }

    /**
     * Get LoginRadius Module information container..
     */
    public function render_module_info_container()
    {
        ?>
        <fieldset class="lr_admin_configuration_info_fieldsets lr_configuration_info_fieldsets_right" id="lr_extension_info_container">
            <h4 class="lr_admin_fieldset_title"><strong><?php echo $this->__('Extension Information!') ?></strong></h4>

            <div style="margin:5px 0">
                <strong>Version: </strong>2.0.0 <br/>
                <strong>Author:</strong> LoginRadius<br/>
                <strong>Website:</strong> <a href="https://www.loginradius.com" target="_blank">www.loginradius.com</a>
                <br/>
                <strong>Community:</strong> <a href="http://community.loginradius.com" target="_blank">community.loginradius.com</a>
                <br/>

                <div id="sociallogin_get_update" style="float:left;">To receive updates on new features, releases, etc. Please connect to one of our social media pages
                </div>
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
    <?php
    }

    /**
     * Render script for extension admin configuration options
     */
    public function render_module_admin_script_container()
    {
        ?>
        <script type="text/javascript">var islrsharing = true;
            var islrsocialcounter = true;</script>
        <script type="text/javascript" src="//share.loginradius.com/Content/js/LoginRadius.js" id="lrsharescript"></script>
        <script type="text/javascript">
            window.onload = function () {
                var sharingType = ['horizontal', 'vertical'];
                var sharingModes = ['Sharing', 'Counter'];
                for (var i = 0; i < sharingType.length; i++) {
                    for (var j = 0; j < sharingModes.length; j++) {
                        if (sharingModes[j] == 'Counter') {
                            var providers = $SC.Providers.All;
                        } else {
                            var providers = $SS.Providers.More;
                        }
                        // populate sharing providers checkbox
                        loginRadiusCounterHtml = "<ul class='checkboxes'>";
                        // prepare HTML to be shown as Vertical Counter Providers
                        for (var ii = 0; ii < providers.length; ii++) {
                            loginRadiusCounterHtml += '<li><input type="checkbox" id="' + sharingType[i] + '_' + sharingModes[j] + '_' + providers[ii] + '" ';
                            loginRadiusCounterHtml += 'value="' + providers[ii] + '"> <label for="' + sharingType[i] + '_' + sharingModes[j] + '_' + providers[ii] + '">' + providers[ii] + '</label></li>';
                        }
                        loginRadiusCounterHtml += "</ul>";
                        var tds = document.getElementById('row_sharing_options_' + sharingType[i] + 'Sharing_' + sharingType[i] + sharingModes[j] + 'Providers').getElementsByTagName('td');
                        tds[1].innerHTML = loginRadiusCounterHtml;
                    }
                    document.getElementById('row_sharing_options_' + sharingType[i] + 'Sharing_' + sharingType[i] + 'CounterProvidersHidden').style.display = 'none';
                }
                loginRadiusSharingPrepareAdminUI();
            }
            // toggle sharing/counter providers according to the theme and sharing type
            function loginRadiusToggleSharingProviders(element, sharingType) {
                var sharingContainer = document.getElementById('row_sharing_options_' + sharingType + 'Sharing_' + sharingType + 'SharingProviders');
                var countercontainer = document.getElementById('row_sharing_options_' + sharingType + 'Sharing_' + sharingType + 'CounterProviders');
                var sharingContainerHidden = document.getElementById('row_sharing_options_' + sharingType + 'Sharing_' + sharingType + 'SharingProvidersHidden');
                if (element.value == '32' || element.value == '16' || element.value == 'responsive') {
                    sharingContainer.style.display = 'table-row';
                    countercontainer.style.display = 'none';
                    sharingContainerHidden.style.display = 'table-row';
                } else if (element.value == 'single_large' || element.value == 'single_small') {
                    sharingContainer.style.display = 'none';
                    countercontainer.style.display = 'none';
                    sharingContainerHidden.style.display = 'none';
                } else {
                    sharingContainer.style.display = 'none';
                    countercontainer.style.display = 'table-row';
                    sharingContainerHidden.style.display = 'none';
                }
            }
        </script>
    <?php
    }
}