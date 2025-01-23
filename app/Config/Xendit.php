<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Xendit extends BaseConfig
{
    public $apiKey;
    public $isProduction;

    public function __construct()
    {
        $this->apiKey = getenv('XENDIT_API_KEY');
        $this->isProduction = getenv('XENDIT_IS_PRODUCTION') ?? false;
    }
} 