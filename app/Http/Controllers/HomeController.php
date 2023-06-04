<?php

namespace App\Http\Controllers;

use App\Models\GroupProduct;
use App\Models\ItemReceive;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $user;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function authSession()
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(): View
    public function index()
    {
        $title = 'Dashboard';
        $subtitle = 'Halaman Dashboard';

        $count_sales = Sales::get()->count();
        $count_item = Product::get()->count();
        $count_item_receive = ItemReceive::get()->count();
        $count_order = Order::get()->count();
        $count_stock = GroupProduct::sum('qty');

        return view('home', [
            'title' => $title,
            'subtitle' => $subtitle,
            'user' => $this->authSession(),
            'count_sales' => $count_sales,
            'count_item' => $count_item,
            'count_item_receive' => $count_item_receive,
            'count_order' => $count_order,
            'count_stock' => $count_stock,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome(): View
    {
        return view('home');
    }
}
