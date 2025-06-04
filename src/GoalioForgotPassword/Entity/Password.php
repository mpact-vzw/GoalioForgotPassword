<?php

namespace GoalioForgotPassword\Entity;

use LmcUser\Entity\User;

class Password extends User
{
    protected $requestKey;
    protected $requestTime;

    public function setRequestKey($key)
    {
        $this->requestKey = $key;
        return $this;
    }

    public function getRequestKey()
    {
        return $this->requestKey;
    }

    public function generateRequestKey()
    {
        $this->setRequestKey(strtoupper(substr(sha1(
            $this->getUserId() .
            '####' .
            $this->getRequestTime()->getTimestamp()
        ),0,15)));
    }

    public function setUserId($user_id)
    {
        return $this->setId($user_id);
    }

    public function getUserId()
    {
        return $this->getId();
    }

    public function setRequestTime($time)
    {
        if ( ! $time instanceof \DateTime ) {
            $time = new \DateTime($time);
        }
        $this->requestTime = $time;
        return $this;
    }

    public function getRequestTime()
    {
        if ( ! $this->requestTime instanceof \DateTime ) {
            $this->requestTime = new \DateTime('now');
        }
        return $this->requestTime;
    }

    public function validateExpired($resetExpire)
    {
        $expiryDate = new \DateTime($resetExpire . ' seconds ago');
        return $this->getRequestTime() < $expiryDate;
    }
}
