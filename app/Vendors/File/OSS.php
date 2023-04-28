<?php


namespace App\Vendors\File;


use Illuminate\Support\Facades\Config;
use Qcloud\Cos\Client;

class OSS
{
    private Client $ossClient;

    private array $ossConfig;

    /**
     * OSS constructor.
     */
    public function __construct($config = [])
    {
        $this->ossConfig = $config;
        $this->ossClient = new Client([
            'region'      => $this->ossConfig['region'],
            'credentials' => array(
                'secretId'  => $this->ossConfig['secretId'],
                'secretKey' => $this->ossConfig['secretKey'],
            )
        ]);
    }


    /**
     * 文件上传
     *
     * @param $ossKey
     * @param $filePath
     * @return object
     */
    public function upload($ossKey, $filePath): object
    {
        return  $this->ossClient->putObject([
            'Bucket' => $this->ossConfig['bucket'],
            'Key'    => $ossKey,
            'Body'   => fopen($filePath, 'rb')
        ]);
    }

}
