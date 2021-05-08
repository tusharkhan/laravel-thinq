<?php

namespace R64\LaravelThinq;

class ThinqConfig
{
    public $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getApiKey()
    {
        return $this->config['api_key'];
    }

    public function getAccountId()
    {
        return $this->config['account_id'];
    }

    public function shouldDisableApiCalls()
    {
        return $this->config['disable_api_calls'];
    }
    
    public function  getApiUser()
    {
        return $this->config['api_user'];
    }
}
