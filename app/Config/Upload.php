<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Upload extends BaseConfig
{
    public string $uploadPath = '/uploads/users';
    public string $allowedTypes = 'gif|jpg|jpeg|png';
    public int $maxSize = 4096;
    public int $maxWidth = 0;
    public int $maxHeight = 0;
    public bool $overwrite = true;
} 