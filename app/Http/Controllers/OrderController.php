<?php

namespace App\Http\Controllers;

use App\Components\Cart\Cart;
use App\Components\Cart\CartItem;
use App\Entity\Order;
use App\Entity\Product;
use App\Http\Requests\Order\CreateRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function callAction($method, $parameters)
    {
        $this->cart->loadItems();
        return parent::callAction($method, $parameters);
    }

    public function add($id, $count = 1)
    {
        $product = Product::find($id);

        $this->cart->add($product->id, $count, $product->price);

        return redirect()->route('home');
    }

    public function remove($id)
    {
        $this->cart->remove($id);

        return redirect()->route('order.index');
    }

    public function clear()
    {
        $this->cart->clear();
    }

    private function getCartSummary()
    {
        $cart = $this->cart->getItems();
        $items = [];
        foreach ($cart as $item) {
            /* @var $item CartItem */
            $items[] = [
                'cart' => $item,
                'product' => Product::find($item->getId())
            ];
        }
        $total_cost = $this->cart->getCost();

        return [$items, $total_cost];
    }

    public function index()
    {
        [$items, $total_cost] = $this->getCartSummary();
        if (empty($items)) {
            return redirect()->route('home');
        }

        return view('order.cart', compact('items', 'total_cost'));
    }

    public function checkout(Order $order)
    {
        [$items, $total_cost] = $this->getCartSummary();
        if (empty($items)) {
            return redirect()->route('home');
        }

        return view('order.checkout', compact('order','items', 'total_cost'));
    }

    public function create(CreateRequest $request)
    {
        [$items, $total_cost] = $this->getCartSummary();
        if (empty($items)) {
            return redirect()->route('home');
        }

        $create_order = Order::create([
            'customer_email' => $request['customer_email'],
            'price_total' => $total_cost,
            'delivery_price' => 0,
            'user_id' => \Auth::id() ?? null
        ]);

        foreach ($items as $item) {
            /* @var $cart_item CartItem */
            $cart_item = $item['cart'];

            DB::table('order_product')->insert(
                [
                    'order_id' => $create_order->id,
                    'product_id' => $cart_item->getId(),
                    'count' => $cart_item->getCount(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
        }

        $this->cart->clear();

        return redirect()->home();
    }
}
