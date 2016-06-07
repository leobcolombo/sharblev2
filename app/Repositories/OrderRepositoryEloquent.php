<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use App\Models\Order;
use App\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{


    public function getByIdAndDeliveryman($id, $idDeliveryman) {
        $result = $this->with(['items','client','cupom'])->findWhere([
            'id' => $id,
            'user_deliveryman_id' => $idDeliveryman]);
        if($result instanceof Collection) {
            $result = $result->first();
            $result->items->each(function($item) {
            $item->product;
        });
        }
        return $result;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
