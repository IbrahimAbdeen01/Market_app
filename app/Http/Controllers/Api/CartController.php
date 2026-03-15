<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Requests\Cart\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    ){}
    public function index()
    { $cart= $this->cartService->getCart(auth()->user());
        return response()->json(['data'=>$cart]);
    }

    public function store(AddToCartRequest $request)
    { $cart=$this->cartService->addItem(auth()->user(),$request->validated());
        return response()->json(['data'=>$cart]);
    }

    public function update(UpdateCartItemRequest $request,CartItem $cartItem){

        $item=$this->cartService->updateItem(
            $cartItem,
            $request->quantity);
        return response()->json(['data'=>$item]);

    }

    public function destroy(CartItem $cartItem){
        $this->cartService->removeItem($cartItem);
        return response()->json([
            'message' => 'removed Item successfully']);

    }




}
