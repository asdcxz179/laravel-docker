<?php

namespace App\Services\AWS;

use Illuminate\Support\Facades\Storage;
use Byg\Admin\Exceptions\Api\ErrorException;

class S3Service {
    
    protected $storage = 's3Public';

    public function __construct() {
    }

    public function setStorage($disk) {
        $this->storage = $disk;
    }

    public function getFolders($path = '/') {
        return collect(Storage::disk($this->storage)->directories($path))->map(function($folder) {
            $data = explode('/', $folder);
            return [
                'label' => array_pop($data),
                'value' => $folder,
                'children' => $this->getFolders($folder)
            ];
        })->toArray();
    }

    public function getFiles($path) {
        return collect(Storage::disk($this->storage)->files($path))->map(function($file) {
            return [
                'label' => basename($file),
                'value' => $file,
                'path'  =>  env("AWS_IMAGE_PATH").$file,
            ];
        })->toArray();
    }

    public function insertFile($path, $file) {
        //上傳s3使用原檔名上傳
        $path = $path.'/'.$file->getClientOriginalName();
        if($this->checkFile($path) === true) {
            throw new ErrorException(['data' => ['error' => '檔案已存在']],'檔案已存在',500);
        }
        
        if(!Storage::disk($this->storage)->put($path, file_get_contents($file))) {
            throw new ErrorException(['data' => ['error' => '檔案上傳失敗']],'檔案上傳失敗',500);
        }
        return true;
    }

    public function deleteFile($path) {
        
        if($this->checkFile($path) === false) {
            throw new ErrorException(['data' => ['error' => '檔案不存在']],'檔案不存在',500);
        }

        if(!Storage::disk($this->storage)->delete($path)) {
            throw new ErrorException(['data' => ['error' => '檔案刪除失敗']],'檔案刪除失敗',500);
        }
        return true;
    }
    
    /**
     * 檢查檔案是否存在
     *
     * @param  mixed $path
     * @return void
     */
    public function checkFile($path) {
        $path = explode('/', $path);
        $fileName = array_pop($path);
        $folder = implode('/', $path);
        $files = Storage::disk($this->storage)->files($folder);
        if(!in_array($folder.'/'.$fileName, $files)) {
            return false;
        }
        return true;
    }

}