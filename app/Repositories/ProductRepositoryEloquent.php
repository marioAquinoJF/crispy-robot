<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\ProductRepository;
use Delivery\Presenters\ProductPresenter;
use Delivery\Models\Product;
use Delivery\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function listing()
    {
        return $this->model->lists('name', 'id');
    }
    public function presenter()
    {
        return ProductPresenter::class;
    }
}
