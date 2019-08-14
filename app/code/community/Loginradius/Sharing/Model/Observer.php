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
 *  Sharing observer model
 *
 * @category    Loginradius
 * @package     Loginradius_Sharing
 * @author      LoginRadius Team
 */

/**
 * Class Loginradius_Sharing_Model_Observer responsible for LoginRadius api keys verification!
 */
class Loginradius_Sharing_Model_Observer extends Mage_Core_Helper_Abstract
{
    /**
     * @throws Exception while api keys are not valid!
     */
    public function validateLoginradiusKeys()
    {

        $post = Mage::app()->getRequest()->getPost();
        if (isset($post['config_state']['sharing_options_messages'])) {
            $apiKey = $post['groups']['messages']['fields']['appid']['value'];
            $data = array('addon' => 'Magento', 'version' => '2.0.0', 'agentstring' => $_SERVER["HTTP_USER_AGENT"], 'clientip' => $_SERVER["REMOTE_ADDR"], 'configuration' => 'Validating API Key');
            if (!empty($apiKey)) {
                $validateUrl = 'https://api.loginradius.com/api/v2/app/validatekey?apikey=' . rawurlencode($apiKey);
                $response = json_decode($this->accessLoginradiusApi($validateUrl, $data, true));
                $result['status'] = isset($response->Status) ? $response->Status : false;
                $result['message'] = isset($response->Messages[0]) ? $response->Messages[0] : 'an error occurred';

                if (isset($result['status']) && $result['status']) {
                    $result['message'] = '';
                    $result['status'] = 'Success';
                } else {
                    if ($result['message'] == 'API_KEY_NOT_FORMATED') {
                        $result['message'] = 'LoginRadius API key is not correct.';
                    } elseif ($result['message'] == 'API_SECRET_NOT_FORMATED') {
                        $result['message'] = 'LoginRadius API Secret key is not correct.';
                    } elseif ($result['message'] == 'API_KEY_NOT_VALID') {
                        $result['message'] = 'LoginRadius API key is not valid.';
                    } elseif ($result['message'] == 'API_SECRET_NOT_VALID') {
                        $result['message'] = 'LoginRadius API Secret key is not valid.';
                    } else {
                        $result['message'] = 'Some error occurred, please try again later';
                    }
                }
                if ($result['status'] != 'Success') {
                    throw new Exception($result['message']);
                }
            }
        }
    }

    public function addCustomLayoutHandle(Varien_Event_Observer $observer)
    {
        $controllerAction = $observer->getEvent()->getAction();
        $layout = $observer->getEvent()->getLayout();
        if ($controllerAction && $layout && $controllerAction instanceof Mage_Adminhtml_System_ConfigController) {
            if ($controllerAction->getRequest()->getParam('section') == 'sharing_options') {
                $layout->getUpdate()->addHandle('sharing_custom_handle');
            }
        }
        return $this;
    }

    /**
     * Function for caalling appropriate method ex. curl, fsockopen or magento default varien to call LoginRadius api.
     *
     * @param       $url
     * @param array $data
     * @param bool  $isPost
     *
     * @return mixed|string
     */
    public function accessLoginradiusApi($url, $data = array(), $isPost = false)
    {

        if ($this->isCurlEnabled()) {
            $JsonResponse = $this->curlApiMethod($url, $data, $isPost);
        } else {
            $JsonResponse = $this->fsockopenApiMethod($url, $data, $isPost);
        }
        $result = json_decode($JsonResponse);
        if (is_object($result) && isset($result->customError)) {
            $method = 'GET';

            $client = new Varien_Http_Client($url);
            $response = $client->request($method);
            $Response = $response->getBody();

            return $Response;

        }

        return $JsonResponse;

    }

    /**
     * Check if curl is enabled or not!
     *
     * @return bool
     */
    public function isCurlEnabled()
    {
        return function_exists('curl_version') ? '1' : '0';
    }

    /**
     * Function for calling LoginRadius Api using curl method
     *
     * @param      $url
     * @param      $data
     * @param bool $post
     *
     * @return mixed|string
     */
    public function curlApiMethod($url, $data = array(), $post = false)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        if ($post) {
            curl_setopt($curl_handle, CURLOPT_POST, 1);
            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        if (ini_get('open_basedir') == '' && (ini_get('safe_mode') == 'Off' or !ini_get('safe_mode'))) {
            curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        } else {
            curl_setopt($curl_handle, CURLOPT_HEADER, 1);
            $url = curl_getinfo($curl_handle, CURLINFO_EFFECTIVE_URL);
            curl_close($curl_handle);
            $curl_handle = curl_init();
            $url = str_replace('?', '/?', $url);
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        }
        $JsonResponse = curl_exec($curl_handle);
        $httpCode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        if (in_array($httpCode, array(400, 401, 403, 404, 500, 503))) {
            $JsonResponse = json_encode(array("customError" => true, "Messages" => "Error in using curl connection ,Service connection error occurred"));
        } else {
            if (curl_errno($curl_handle) == 28) {
                $JsonResponse = json_encode(array("customError" => true, "Messages" => "Connection timeout"));
            }
        }
        curl_close($curl_handle);

        return $JsonResponse;
    }

    /**
     * Function for calling LoginRadius Api using fsockopen method
     *
     * @param      $ValidateUrl
     * @param      $data
     * @param bool $post
     *
     * @return string
     */
    public function fsockopenApiMethod($ValidateUrl, $data, $post = false)
    {
        if (!empty($data)) {
            $options = array('http' => array('method' => 'POST', 'timeout' => 15, 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data));
            $context = stream_context_create($options);
        } else {
            $context = null;
        }
        $jsonResponse = @file_get_contents($ValidateUrl, false, $context);
        if (strpos(@$http_response_header[0], "400") !== false
            || strpos(@$http_response_header[0], "401") !== false
            || strpos(@$http_response_header[0], "403") !== false
            || strpos(@$http_response_header[0], "404") !== false
            || strpos(@$http_response_header[0], "500") !== false
            || strpos(@$http_response_header[0], "503") !== false
        ) {
            $jsonResponse = json_encode(array("customError" => true, "Messages" => "Error in using FSOCKOPEN connection method, Service connection timeout occurred"));
        }
        if (!$jsonResponse) {
            $jsonResponse = json_encode(array("customError" => true, "Messages" => "FSOCKOPEN not working"));
        }

        return $jsonResponse;
    }
}
