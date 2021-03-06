<?php
namespace tecai\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use tecai\Repositories\Interfaces\CommonRepository;

abstract class CommonRepositoryEloquent extends BaseRepository implements CommonRepository {//这个抽象类其实没必要的，下面的方法是可以放入BaseRepository里
//    use CacheableRepository;
    /**
     * 不可更新字段
     * @var array
     */
    protected $fieldUnchangeable = [];

    /**
     * 获取不可更新字段
     * @return array
     */
    public function getFieldUnchangeable() {
        return $this->fieldUnchangeable;
    }

    /**
     * 通过字段查找一条记录
     * @param       $field
     * @param       $value
     * @param array $columns
     * @return mixed
     */
    public function findOneByField($field, $value = null, $columns = ['*']) {
        $model = $this->findWhere([$field => $value] ,$columns)->first();
        if( is_null($model) ) {
            throw (new ModelNotFoundException)->setModel(get_class($this->model));
        }
        return $model;
    }

    public function deleteByField($field, $value) {
        return $this->deleteWhere([$field => $value]);
    }

    public function update(array $attr, $id)
    {
        return parent::update(array_unallow($this->getFieldUnchangeable(), $attr), $id);
    }

    protected function isIn($needle, array $enum)
    {
        if(!in_array($needle, $enum)) {
            throw new BadRequestHttpException();
        }
    }

}
