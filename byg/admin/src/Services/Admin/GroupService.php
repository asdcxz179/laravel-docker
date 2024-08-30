<?php

namespace Byg\Admin\Services\Admin;

use Illuminate\Support\Arr;
use Byg\Admin\Exceptions\Api\ErrorException;
use DataTables;

/**
 * Class GroupService.
 */
class GroupService
{
    protected $GroupRepository;

    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct() {
        $this->GroupRepository = app(config('admin.groups.model'));
    }

    /**
     * 管理員群組列表
     * @param array $data
     * @version 1.0
     * @author Henry
     * @return \DataTables
     */
    public function index($data) {
        $where = Arr::only($data,[]);
        return DataTables::of($this->GroupRepository->listQuery($where))->make();
    }

    /**
     * 取得單一管理員群組資料
     * @param string $uuid
     * @return object
     * @version 1.0
     * @author Henry
     */
    public function getGroup(string $uuid) {
        return $this->GroupRepository->getDetail($uuid);
    }

    /**
     * 建立管理員群組
     * @param array $data
     * @return object $user
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function store(array $data) {
        return \DB::transaction(function() use ($data) {
            $createData = Arr::only($data, array_merge(['password'], $this->GroupRepository->getDetailFields()));
            $user     =   $this->GroupRepository->create($createData);
            if(!$user){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.insertFail')]],__('admin::Admin.error.insertFail'),500);
            }
            return $user;
        });
    }

    /**
     * 更新管理員群組資料
     * @param array $data
     * @param string $uuid
     * @return object $user
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function update(array $data, string $uuid) {
        return \DB::transaction(function() use ($data, $uuid) {
            $updateData = Arr::only($data, $this->GroupRepository->getDetailFields());
            $model =  $this->GroupRepository->find($uuid);
            $user = $model->update($updateData);
            if(!$user){
                throw new ErrorException(['data' => ['error' => __('admin::Admin.error.updateFail')]],__('admin::Admin.error.updateFail'),500);
            }
            return $user;
        });
    }

    /**
     * 刪除管理員群組
     * @param string $uuid
     * @return object $user
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function delete(string $uuid) {
        $user = $this->GroupRepository->find($uuid)->delete();
        if(!$user){
            throw new ErrorException(['data' => ['error' => __('admin::Admin.error.deleteFail')]],__('admin::Admin.error.deleteFail'),500);
        }
        return $user;
    }

}