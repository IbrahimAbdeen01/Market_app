<?php
namespace App\Services;
use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Requests\Cart\UpdateCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartService{
    public function getCart($user)
    { return $user->cart()->with('items.product')->first();
    }

    public function addItem($user,array $product)
    {
        $cart=$user->cart()->firstOrCreate();
        $item=$cart->items()->where('product_id',$product['product_id'])->first();
        if($item){
           $item->increment('quantity',$product['quantity']);
        }
        else{
            $cart->items()->create($product);
        }
        return $cart->load('items.product');

    }

    public function updateItem(CartItem $item, int $quantity )
    { $item->update(['quantity'=>$quantity]);

        return $item->fresh();

    }

    public function removeItem(CartItem $item)
    {
        return  $item->delete();
    }


}
