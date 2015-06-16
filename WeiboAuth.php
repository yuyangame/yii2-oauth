<?php
/**
 * AuthInterface.php
 * @auther: yuyangame<kangzhq@foxmail.com>
 */

namespace yuyangame\oauth;

use yii\authclient\OAuth2;

class WeiboAuth extends OAuth2 implements AuthInterface
{

    public $authUrl    = 'https://api.weibo.com/oauth2/authorize';
    public $tokenUrl   = 'https://api.weibo.com/oauth2/access_token';
    public $apiBaseUrl = 'https://api.weibo.com';

    /**
     * @return []
     * @see    http://open.weibo.com/wiki/Oauth2/get_token_info
     * @see    http://open.weibo.com/wiki/2/users/show
     */
    protected function initUserAttributes()
    {
        return $this->api('oauth2/get_token_info', 'POST');
    }

    /**
     * get UserInfo
     * @return []
     * @see    http://open.weibo.com/wiki/2/users/show
     */
    public function getUserInfo()
    {
        $openid = $this->getUserAttributes();

        return $this->api("2/users/show.json", 'GET', ['uid' => $openid['uid']]);
    }

    protected function defaultName()
    {
        return 'weibo';
    }

    protected function defaultTitle()
    {
        return '微博登陆';
    }

    protected function defaultViewOptions()
    {
        return [
            'popupWidth'  => 800,
            'popupHeight' => 500,
        ];
    }

}
