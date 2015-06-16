yii2-oauth
==========
yii2-oauth
Include:QQ,Weibo,Weixin,Renren,Douban

#Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yuyangame/yii2-oauth "*"
```

or add

```
"yuyangame/yii2-oauth": "*"
```

to the require section of your `composer.json` file.


#Usage
-----

Once the extension is installed, simply use it in your code by  :

1.Add components configure
------
```php
'components' => [
    'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'qq' => [
                'class' => 'yuyangame\oauth\QqAuth',
                'clientId' => 'YOUR_OPEN_APPID',
                'clientSecret' => 'YOUR_OPEN_APPSCRET',
            ],
            'weibo' => [
                'class' => 'yuyangame\oauth\WeiboAuth',
                'clientId' => 'YOUR_OPEN_APPID',
                'clientSecret' => 'YOUR_OPEN_APPSCRET',
            ],
            'weixin' => [
                'class' => 'yuyangame\oauth\WeixinAuth',
                'clientId' => 'YOUR_OPEN_APPID',
                'clientSecret' => 'YOUR_OPEN_APPSCRET',
            ],
        ]
    ]
    ...
]
```

2.Add controller
----------
```php
class SiteController extends Controller
{
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * Success Callback
     * @param QqAuth|WeiboAuth $client
     * @see http://wiki.connect.qq.com/get_user_info
     * @see http://stuff.cebe.cc/yii2docs/yii-authclient-authaction.html
     */
    public function successCallback($client) {
        $id = $client->getId(); // qq | weibo | weixin
        $attributes = $client->getUserAttributes(); // basic info
        $userInfo = $client->getUserInfo(); // user extend info
        // login or signup
    }
}
```

3.Add view
-----------
```php
<?=
yii\authclient\widgets\AuthChoice::widget([
    'baseAuthUrl' => ['site/auth'],
    //'popupMode' => false,
])
?>
```