<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\CategoryRepository;
use Delivery\Entities\Category;
use Delivery\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function save(array $category)
    {
        $this->model->name = $category['name'];
        $this->model->save();
        return $this->model;
    }
}
