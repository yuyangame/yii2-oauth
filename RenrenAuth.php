<?php
/**
 * AuthInterface.php
 * @auther: yuyangame<kangzhq@foxmail.com>
 */

namespace yuyangame\oauth;

use yii\authclient\OAuth2;

class RenrenAuth extends OAuth2 implements AuthInterface
{

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://graph.renren.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://graph.renren.com/oauth/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.renren.com';

    /**
     * Try to use getUserAttributes to get simple user info
     * @see http://wiki.dev.renren.com/wiki/Authentication
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->getAccessToken()->getParams()['user'];
    }

    /**
     * Get authed user info
     * @see http://wiki.dev.renren.com/wiki/V2/user/get
     * @return array
     */
    public function getUserInfo()
    {
        $user = $this->getUserAttributes();

        return $this->api("v2/user/get", 'GET', ['userId' => $user['id']]);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'renren';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return '人人登陆';
    }

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth'  => 800,
            'popupHeight' => 500,
        ];
    }

}
