<?php
/**
 * EncryptService.php
 * author lwz
 * time 2020/1/29
 */

namespace Service;

class EncryptService
{
    public function encryptParams($data)
    {
        return $this->encryptBase($data);
    }

    private function encryptBase($data)
    {
        $key = $this->getKey();
        $data = $this->base($data, $key);
        $params = $this->base($data, $this->getRandom());
        $encSecKey = $this->getEncSecKey();
        return compact('params', 'encSecKey');
    }

    private function getKey()
    {
        return '0CoJUm6Qyw8W8jud';
    }

    private function getIv()
    {
        return '0102030405060708';
    }

    private function getRandom()
    {
        return '9cxqkYv1WsSmRWZ1';
    }

    private function base($data, $key)
    {
        return \openssl_encrypt($data, 'AES-128-CBC', $key, 0, $this->getIv());
    }

    public function getEncSecKey()
    {
        return '96082b986b9f636e80c4de5868d9798cd4f5008d09d19c39c21817d36b3df39719a9c6d367e249eedba216ce536e839265edc6e1cc5486db3f9545e5c560f329476cf9bb962a3ef63c4ae48c08df1aac1244f056aa1a356becc10bd475bd95b80442d17515070f50b7730d43c9db00a151a0d530786d336767df354ab9189e50';
    }
}
