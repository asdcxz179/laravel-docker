<?php

namespace Byg\Admin\Traits;

trait QueryTrait
{
    /**
     * 列表SQL
     * @param  array $where
     * @return $query
     * @version 1.0
     * @author Henry
     */
    public function listQuery(array $where) {
        $query = $this->where($where);
        if(isset($this->withs) && $this->withs) {
            $query = $query->with($this->withs);
        }
        if(isset($this->detail) && $this->detail) {
            $query = $query->select($this->detail);
        }
        return $query;
    }

    /**
     * 取得單筆資料
     * @param string $id
     * @return object
     * @version 1.0
     * @author Henry
     */
    public function getDetail(string $id, $where = []) {
        $query = $this->select($this->detail);
        if(isset($this->withs) && $this->withs) {
            $query = $query->with($this->withs);
        }
        if($where) {
            $query = $query->where($where);
        }
        return $query->where($this->getKeyName(), $id)->first();
    }

    /**
     * 搜尋單筆資料
     * @param string $id
     * @return object
     * @version 1.0
     * @author Henry
     */
    public function search(array $where) {
        return $this->listQuery($where)->first();
    }

    public function getDetailFields() {
        return $this->detail??[];
    }
}