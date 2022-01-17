<?php

namespace App\Criteria;

use App\Domain\Contracts\ProductContract;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SubCategoryByCategoryCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class SubCategoryByCategoryCriteriaCriteria implements CriteriaInterface
{
    private $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereIn(ProductContract::SUBCATEGORY_ID, $this->ids);
    }
}
