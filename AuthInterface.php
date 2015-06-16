<?php
/**
 * AuthInterface.php
 * @auther: yuyangame<kangzhq@foxmail.com>
 */

namespace yuyangame\oauth;


interface AuthInterface
{
    /**
     * get User Info
     * @return []
     */
    public function getUserInfo();
}