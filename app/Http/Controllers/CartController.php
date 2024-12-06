<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class CartController extends Controller
{
    // 商品をカートに追加
    public function add($id)
    {
        // 商品IDを基に商品を取得
        $item = Item::find($id);
        
        // アイテムが見つかった場合
        if ($item) {
            return $this->addToCart($item);
        }

        // アイテムが見つからなかった場合
        return redirect()->route('cart.index')->with('error', '商品が見つかりませんでした');
    }

    // カートの内容を表示
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // アイテムをカートに追加
    public function addToCart(Item $item)
    {
        $cart = session()->get('cart', []);

        // アイテムがカートにすでに存在する場合
        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity']++;
        } else {
            // 新しいアイテムをカートに追加
            $cart[$item->id] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'アイテムがカートに追加されました!');
    }

    // カートからアイテムを削除
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'アイテムがカートから削除されました!');
    }

    // カート内商品の数量を更新
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        // 指定されたアイテムがカートに存在する場合
        if (isset($cart[$id])) {
            $newQuantity = $request->input('quantity');
            
            // 数量が1以上の場合のみ更新
            if ($newQuantity > 0) {
                $cart[$id]['quantity'] = $newQuantity;
            } else {
                // 数量が0以下の場合はアイテムを削除
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', '数量を更新しました。');
    }
}
