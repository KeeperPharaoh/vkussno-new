<?php

namespace App\Criteria;

use App\Domain\Contracts\ProductContract;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NewCriteria.
 *
 * @package namespace App\Criteria;
 */
class NewCriteria implements CriteriaInterface
{
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
        return $model->where(ProductContract::NEW, true);
    }
}
