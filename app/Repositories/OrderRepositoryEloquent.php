<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Presenter\ModelFractalPresenter;
use App\Repositories\OrderRepository;
use App\Presenters\OrderPresenter;
use App\Models\Order;
use App\Validators\OrderValidator;

class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this->with(['client', 'items', 'cupom'])->findWhere(['id' => $id, 'user_deliveryman_id' => $idDeliveryman]);

        if($result instanceof Collection) {
            $result = $result->first();
        }else{
            if(isset($result['data']) && count($result['data']) == 1){
                $result = [
                    'data' => $result['data'][0]
                ];
            }else{
                throw new ModelNotFoundException("Order não existe");
            }
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

    public function presenter()
    {
        return OrderPresenter::class;
    }


}