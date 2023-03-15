<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Validator;
use URL;
use Redirect;
use Input;
use App\Models\User;
use App\Models\Datospago;
use App\Models\Movimiento;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MarketplaceController extends Controller {
    
  public function index() {
        $prod = new Producto();
        $productos = $prod->all();

        return view('marketplace.index', ['productos' => $productos]);
    }

  public function success($CHECKOUT_SESSION_ID){
        $stripe = new \Stripe\StripeClient("sk_test_51Lp8NVH56QvMFB5rNDe7XvB6CwKYX2cXyCBXU5CYuzVK4sQ4Gh3X9PWTu0MK7lfA2T6MMYYn94Ej9rTg7stbrlhd008NZiq9zA");
        $line_items = $stripe->checkout->sessions->allLineItems($CHECKOUT_SESSION_ID, ['limit' => 5]);
        $cliente = $stripe->checkout->sessions->retrieve($CHECKOUT_SESSION_ID,[]);


        /*MEJORAR */
        foreach($line_items as $key => $value){
          $stripe_product = $value['price']['product'];
        }


        /*PRODUCT_ID => STRIPE_ID */
        /*$usuario = DB::table('users')->where('email', 'admin@gmail.com')->first();
        if($usuario!=NULL){
        }
        echo Auth::user()->name;*/

        Datospago::create([
          'user_id' => Auth::user()->id,
          'transaccion_id' => $CHECKOUT_SESSION_ID,
          'producto_id' => $stripe_product,
          'detalles' => $cliente,
          'correo_pago' => $cliente['customer_details']['email']
        ]);

        return view('marketplace.success', ['datos' => $line_items, 'cliente' => $cliente]);
  }

  public function misProductos(){
    return view('marketplace.misproductos');
  }

}


