<?php

namespace App\Http\Controllers\Api\Deliveryman;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    //private $with = ['client', 'cupom', 'items'];

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $orders =  $this->orderRepository->with('items')->scopeQuery(function($query) use($id){
            return $query->where('user_deliveryman_id','=', $id);
        })->paginate();

        return $orders;
    }

    public function show($id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        return $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);
    }

    public function updateStatus(Request $request, $id)
    {
        if($request->get('status')){
            $idDeliveryman = Authorizer::getResourceOwnerId();
            $order = $this->orderService->updateStatus($id, $idDeliveryman, $request->get('status'));
            if ($order) {
                return $order;
            } else {
                abort(400, "Pedido não encontrado");
            }
        }
}

}
