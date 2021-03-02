<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Models\Kitchen;
use App\Models\Order;
use App\Poster\IncomingOrder\IIncOrder;
use App\Service\Interfaces\DeliveryServiceInterface;

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

        $data = [
            'first_name' => $order->customer->name,
            'last_name' => $order->customer->surname,
            'email' => !empty($order->customer->email) ? $order->customer->email : '',
            'comment' => "Коментар: {$order->comment}.",
            'phone' => $order->customer->phone,
            'service_mode' => Order::SERVICE_MODE_POSTER[$order->type]
        ];

        if ($order->city_id) {
            $kitchen = $this->service->index($order->city_relation);
            $data['spot_id'] = $kitchen->spot_id;
            $delivery_price = $kitchen->price_delivery * 100;
            $city = $order->city_relation->name;
        } else {
            $kitchen = Kitchen::with('city_relation')->first();
            $city = $order->city_relation->name;
            $delivery_price = 0;
        }

        $data['spot_id'] = $kitchen->spot_id;

        if ($order->type === Order::ORDER_TYPE['DELIVERY']) {
            $payment_type = 'Спосіб оплати: ' . trans('app.cart.' . $order->pay_type) . '. ';

            $data['address'] = 'Місто: ' . $city . ', адрес: ' . $order->address . '. ';
            $data['address'] .= !is_null($order->apartment) ? 'Kвартира: ' . $order->apartment . '. ' : '';
            $data['address'] .= !is_null($order->entrance) ? 'Під\'їзд: ' . $order->entrance . '. ' : '';
            $data['address'] .= !is_null($order->floor) ? 'Поверх: ' . $order->floor . '. ' : '';
            $data['address'] .= !is_null($order->door_code) ? 'Код дверей: ' . $order->door_code . '. ' : '';;
            $data['delivery_price'] = $delivery_price;
            $data['comment'] .= ' ' . $payment_type;
        }

        foreach ($order->lines as $key => $line) {
            $data['products'][] = [
                'product_id' => $line['product_id'],
                'count' => $line['qty'],
            ];
        }

        $response = $this->incoming_order->store($data);
        $order->setIncomingOrderId($response->get('incoming_order_id'));
    }
}
