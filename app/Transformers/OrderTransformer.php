<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = [ 'client', 'cupom', 'items', 'deliveryman'];

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'total'         => (float) $model->total,
            'status'         => (int) $model->status,
            'created_at' => $model->created_at
        ];
    }

    public function includeClient(Order $model)
    {
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeDeliveryman(Order $model)
    {
        return $this->item($model->deliveryman, new DeliverymanTransformer());
    }

    public function includeCupom(Order $model)
    {
        if(!$model->cupom){
            return null;
        }
        return $this->item($model->cupom, new CupomTransformer());
    }

    public function includeItems(Order $model)
    {
        return $this->collection($model->items, new OrderItemTransformer());
    }
}
