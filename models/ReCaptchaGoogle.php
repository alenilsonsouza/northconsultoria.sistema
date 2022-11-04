<?php

class ReCaptchaGoogle 
{
    private $secretKey = "6LckTNwiAAAAAAIyLunsEUHgitUIeMt38wUdc-V3";

    public function verify($token)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "secret=$this->secretKey&response=$token&remoteip="
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);
        
        $response = json_decode($response, true);

        return $response;
    }
}