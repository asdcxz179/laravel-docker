<?php

namespace App\Services\System;

use DB;
use Byg\Admin\Exceptions\Api\ErrorException;
use Illuminate\Support\Arr;
use DataTables;

class WebsiteService {
    
    protected $website;

    public function __construct() {
        $this->website = app(config('website.model'));
    }

    /**
     * 取得站點列表
     *
     * @param  mixed $request
     * @return void
     */
    public function index($data) {
        $where = Arr::only($data, []);
        return DataTables::of($this->website->listQuery($where))->make();
    }
    
    /**
     * 取得站點資料
     *
     * @param  mixed $id
     * @return void
     */
    public function getWebsite($id) {
        return $this->website->getDetail($id);
    }
    
    
    /**
     * 新增站點
     *
     * @param  mixed $data
     * @return void
     */
    public function store(array $data) {
        return DB::transaction(function() use ($data) {
            $createData =   Arr::only($data, $this->website->getDetailFields());
            $model     =   $this->website->create($createData);
            if(!$model){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.insertFail')]],__('admin::Admin.error.insertFail'),500);
            }
            $result = $this->updateSetting($model, $data['settings']??[]);
            if(!$result){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.insertFail')]],__('admin::Admin.error.insertFail'),500);
            }
            return $model;
        });
    }

    /**
     * 更新站點
     *
     * @param  mixed $model
     * @param  mixed $data
     * @return void
     */
    public function update($model, array $data) {
        return DB::transaction(function() use ($model, $data) {
            $updateData =   Arr::only($data, $this->website->getDetailFields());
            $result = $model->update($updateData);
            if(!$result){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.updateFail')]],__('admin::Admin.error.updateFail'),500);
            }
            $result = $this->updateSetting($model, $data['settings']??[]);
            if(!$result){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.updateFail')]],__('admin::Admin.error.updateFail'),500);
            }
            return $model;
        });
    }
    
    /**
     * 更新網站設定
     *
     * @param  mixed $model
     * @param  mixed $data
     * @return void
     */
    public function updateSetting($model, array $data) {
        $settings = config('website.settings');
        foreach(Arr::only($data, $settings) as $key => $value){
            $result = $model->settings()->updateOrCreate(["key" => $key],["value" => $value]);
            if(!$result) {
                return false;
            }
        }
        return true;
    }
}