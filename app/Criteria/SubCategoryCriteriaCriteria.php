<?php

namespace App\Criteria;

use App\Domain\Contracts\ProductContract;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SubCategoryCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class SubCategoryCriteriaCriteria implements CriteriaInterface
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
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
        return $model->where(ProductContract::SUBCATEGORY_ID, $this->id);
    }
}
