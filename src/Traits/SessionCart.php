<?php

namespace YiddisheKop\LaravelCommerce\Traits;

use Illuminate\Support\Facades\Session;
use YiddisheKop\LaravelCommerce\Facades\Cart;
use YiddisheKop\LaravelCommerce\Models\Order;

trait SessionCart {

  protected function getSessionCartKey(): string {
    return Session::get('cart');
  }

  protected function getSessionCart() {
    return Cart::find($this->getSessionCartKey());
  }

  public function hasSessionCart(): bool {
    return Session::has('cart');
  }

  protected function makeSessionCart() {
    $cart = Cart::create();

    Session::put('cart', $cart->id);

    return $cart;
  }

  protected function getOrMakeSessionCart(): Order {
    if ($this->hasSessionCart()) {
      return $this->getSessionCart();
    }

    return $this->makeSessionCart();
  }

  protected function forgetSessionCart() {
    Session::forget('cart');
  }

  protected function refreshSessionCart() {
    $this->forgetSessionCart();
    $this->makeSessionCart();
  }

}
