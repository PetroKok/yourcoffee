<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Models\Order;
use App\Poster\IncomingOrder\IIncOrder;
use App\Service\Interfaces\DeliveryServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShipmentToPoster
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private IIncOrder $incoming_order;
    private DeliveryServiceInterface $service;

    public function __construct(IIncOrder $order, DeliveryServiceInterface $service)
    {
        $this->incoming_order = $order;
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param OrderShipped $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        $order = $event->order;
        $order->load('lines', 'city_relation', 'customer');

        $data = [];

        if ($order->city_id) {
            $kitchen = $this->service->index($order->city_relation);
            $data['spot_id'] = $kitchen->spot_id;
        }else{
            dd('THERE IS NO CITY');
        }

        $data = [
            'first_name' => $order->customer->name,
            'last_name' => $order->customer->surname,
            'email' => !empty($order->customer->email) ? $order->customer->email : '',
            'comment' => 'Спосіб оплати: ' . trans('app.cart.' . $order->pay_type) . '. Коментар: Тут користувач може написати "без цибулі"!',
            'phone' => $order->customer->phone,
        ];

        if ($order->type === Order::ORDER_TYPE['DELIVERY']) {
            $data['address'] = $order->address;
        }

        foreach ($order->lines as $key => $line) {
            $data['products'][] = [
                'product_id' => $line['product_id'],
                'count' => $line['qty'],
            ];
        }

        dd('Check send');

//        $response = $this->incoming_order->store($data);

//        $order->setIncomingOrderId($response->get('incoming_order_id'));
    }
}
