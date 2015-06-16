<?php
/**
 * AuthInterface.php
 * @auther: yuyangame<kangzhq@foxmail.com>
 */

namespace yuyangame\oauth;

use yii\authclient\OAuth2;
use yii\base\Exception;

class DoubanAuth extends OAuth2 implements AuthInterface
{

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://www.douban.com/service/auth2/auth';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://www.douban.com/service/auth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.douban.com';

    /**
     * @inheritdoc
     */
    public $scope = 'douban_basic_common';

    /**
     * Get authed user info
     * @return array
     * @see http://developers.douban.com/wiki/?title=user_v2#User
     */
    public function getUserInfo()
    {
        return $this->api('v2/user/~me', 'GET');
    }

    protected function defaultName()
    {
        return 'douban';
    }

    protected function defaultTitle()
    {
        return '豆瓣登陆';
    }

    protected function defaultViewOptions()
    {
        return [
            'popupWidth'  => 800,
            'popupHeight' => 500,
        ];
    }

    /**
     * @ineritdoc
     */
    public function api($apiSubUrl, $method = 'GET', array $params = [], array $headers = [])
    {
        if (preg_match('/^https?:\\/\\//is', $apiSubUrl)) {
            $url = $apiSubUrl;
        } else {
            $url = $this->apiBaseUrl . '/' . $apiSubUrl;
        }
        $accessToken = $this->getAccessToken();
        if (!is_object($accessToken) || !$accessToken->getIsValid()) {
            throw new Exception('Invalid access token.');
        }
        $headers[] = 'Authorization: Bearer ' . $accessToken->getToken();

        return $this->apiInternal($accessToken, $url, $method, $params, $headers);
    }

}
