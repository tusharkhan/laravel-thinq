<?php

namespace R64\LaravelThinq;

use Exception;
use Illuminate\Support\Facades\App;

class Thinq
{
    public $config;
    public $thinqMessage;

    public function __construct(ThinqConfig $config)
    {
        $this->config = $config;
    }

    public function withMessage(ThinqMessage $message)
    {
        $this->thinqMessage = $message;

        return $this;
    }


    public function sentSms()
    {
        // Since thinq is restricted to IP, disable or enable api call when testing
        if ($this->shouldDisableApiCall()) {
            return;
        }

        $apiKey = $this->config->getApiKey();
        $accountId = $this->config->getAccountId();

        $data = $this->thinqMessage->getMessage();

        $user = $this->config->getApiUser();
        $authorization = base64_encode( $user . ':' . $apiKey);
        $url = "https://api.thinq.com/account/{$accountId}/product/origination/sms/send";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Basic {$authorization}",
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data)))
        );

        $result = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($httpcode >= 400) {
            throw new Exception($result);
        }
    }

    public function sentSilentSms()
    {
        try {
            $this->sentSms();
        } catch(Exception $exception) {

        }
    }

    private function shouldDisableApiCall()
    {
        return $this->config->shouldDisableApiCalls();
    }
}
