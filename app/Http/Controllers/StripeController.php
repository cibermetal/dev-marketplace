<?php
namespace App\Http\Controllers;
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
//use App\User;
use App\Models\User;
use App\Models\Datospago;
use App\Models\Movimiento;

use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
class StripeController extends Controller {
    public function createSession(Request $request) {
        $session = Session::create([
            'success_url' => 'https://127.0.0.0:8000/success',
            'line_items' => [
              [
                'price' => 'price_H5ggYwtDq4fbrJ',
                'quantity' => 2,
              ],
            ],
            'mode' => 'payment',
        ]);
    }

    public function event(Request $request){

        $stripe = new \Stripe\StripeClient("sk_test_51Lp8NVH56QvMFB5rNDe7XvB6CwKYX2cXyCBXU5CYuzVK4sQ4Gh3X9PWTu0MK7lfA2T6MMYYn94Ej9rTg7stbrlhd008NZiq9zA");
        $line_items = $stripe->checkout->sessions->allLineItems('cs_test_a1xZWcDslBbpNvJeAxEUovoUJGeC7hwnQdiEhJsOqnXSKOv94C1KZUfoK3', ['limit' => 5]);

        /*OBTENGO LOS DATOS DE LA TRANSACCIÓN PARA EL DETERMINAR EL USUARIO USUARIO */
        /*BUSCO EN LA BASE DE DATOS EL ID DEL USUARIO */

        Datospago::create([
        ]);


        http_response_code(200);
    }


    public function getMovimiento(Request $request){

        $payload = $request ->json()->all();
        $movimiento = Movimiento::create([
            'datospago_id' => 1,
            'cantidad' => $payload['success'],
            'tipo' => 1,
            'payload' => $payload['results']
        ]);
        /* RESPONDER CON EL TOTAL DE MENSAJES */
        return response()->json(['payload' => $payload, 'message' => "Movimiento registrado."],200);
    }






}
