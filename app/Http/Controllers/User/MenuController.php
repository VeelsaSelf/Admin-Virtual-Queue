<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public static function allItems(): array
    {
        return [
            'Coffee' => [
                ['id'=>1,'slug'=>'espresso','name'=>'Espresso','desc'=>'Pure, bold, and concentrated','price'=>20000,'img'=>'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
                ['id'=>2,'slug'=>'cappuccino','name'=>'Cappuccino','desc'=>'Equal parts espresso, milk, and foam','price'=>28000,'img'=>'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
                ['id'=>3,'slug'=>'iced-latte','name'=>'Iced Latte','desc'=>'Cold milk with smooth espresso','price'=>30000,'img'=>'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
                ['id'=>4,'slug'=>'caramel-latte','name'=>'Caramel Latte','desc'=>'Espresso with caramel sweetness','price'=>32000,'img'=>'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
                ['id'=>5,'slug'=>'americano','name'=>'Americano','desc'=>'Espresso with hot water','price'=>22000,'img'=>'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
                ['id'=>6,'slug'=>'spanish-latte','name'=>'Spanish Latte','desc'=>'Sweetened milk with espresso','price'=>30000,'img'=>'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
                ['id'=>7,'slug'=>'mocha','name'=>'Mocha','desc'=>'Espresso with chocolate and milk','price'=>32000,'img'=>'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
                ['id'=>8,'slug'=>'flat-white','name'=>'Flat White','desc'=>'Velvety milk with espresso base','price'=>30000,'img'=>'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=500&q=80','cat'=>'Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Medium','price'=>5000],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[['label'=>'Extra Chocolate','price'=>4000],['label'=>'Extra Ice Cream','price'=>6000]]],
            ],
            'Non-Coffee' => [
                ['id'=>9,'slug'=>'matcha-latte','name'=>'Matcha Latte','desc'=>'Earthy matcha with steamed milk','price'=>32000,'img'=>'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?w=500&q=80','cat'=>'Non-Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[]],
                ['id'=>10,'slug'=>'taro-latte','name'=>'Taro Latte','desc'=>'Sweet taro root with creamy milk','price'=>30000,'img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=80','cat'=>'Non-Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[]],
                ['id'=>11,'slug'=>'chocolate-milk','name'=>'Chocolate Milk','desc'=>'Rich creamy chocolate drink','price'=>25000,'img'=>'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=500&q=80','cat'=>'Non-Coffee','sizes'=>[['label'=>'Regular','price'=>0],['label'=>'Large','price'=>8000]],'sugar'=>['Normal','Less Sugar','No Sugar'],'ice'=>['Normal','Less Ice','No Ice'],'addons'=>[]],
            ],
            'Food' => [
                ['id'=>12,'slug'=>'chicken-teriyaki-rice-bowl','name'=>'Chicken Teriyaki Rice Bowl','desc'=>'Grilled chicken with teriyaki glaze','price'=>42000,'img'=>'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=500&q=80','cat'=>'Food','sizes'=>[],'sugar'=>[],'ice'=>[],'rice'=>['Regular Rice','Brown Rice'],'spicy'=>['Not Spicy','Mild Spicy Level','Medium Spicy','Extra Spicy'],'addons'=>[['label'=>'Extra Egg','price'=>5000],['label'=>'Extra Chicken','price'=>10000]]],
                ['id'=>13,'slug'=>'toast-with-butter','name'=>'Toast with Butter','desc'=>'Crispy toast with premium butter','price'=>18000,'img'=>'https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=500&q=80','cat'=>'Food','sizes'=>[],'sugar'=>[],'ice'=>[],'addons'=>[]],
            ],
            'Desserts' => [
                ['id'=>14,'slug'=>'chocolate-brownie','name'=>'Chocolate Brownie','desc'=>'Rich fudgy chocolate brownie','price'=>25000,'img'=>'https://images.unsplash.com/photo-1564355808539-22fda35bed7e?w=500&q=80','cat'=>'Desserts','sizes'=>[],'sugar'=>[],'ice'=>[],'serve'=>['Served Warm','Served Cold'],'addons'=>[['label'=>'Vanilla Ice Cream','price'=>8000],['label'=>'Whipped Cream','price'=>5000]]],
                ['id'=>15,'slug'=>'cheesecake','name'=>'Cheesecake','desc'=>'Creamy New York style cheesecake','price'=>35000,'img'=>'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=500&q=80','cat'=>'Desserts','sizes'=>[],'sugar'=>[],'ice'=>[],'addons'=>[]],
            ],
            'Snacks' => [
                ['id'=>16,'slug'=>'banana-fritter','name'=>'Banana Fritter','desc'=>'Crispy fried banana with honey','price'=>18000,'img'=>'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=500&q=80','cat'=>'Snacks','sizes'=>[],'sugar'=>[],'ice'=>[],'addons'=>[]],
                ['id'=>17,'slug'=>'fries','name'=>'French Fries','desc'=>'Crispy golden potato fries','price'=>20000,'img'=>'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=500&q=80','cat'=>'Snacks','sizes'=>[],'sugar'=>[],'ice'=>[],'addons'=>[]],
            ],
        ];
    }

    public function index(Request $request)
    {
        $all = self::allItems();
        $categories = array_keys($all);
        $active = $request->get('category', 'Coffee');
        if (!in_array($active, $categories)) $active = 'Coffee';
        $items = $all[$active];
        $cartCount = count(session('user_cart', []));
        return view('user.menu.index', compact('categories', 'active', 'items', 'cartCount'));
    }

    public function show(string $slug)
    {
        $item = null;
        foreach (self::allItems() as $items) {
            foreach ($items as $i) {
                if ($i['slug'] === $slug) { $item = $i; break 2; }
            }
        }
        if (!$item) abort(404);
        $cartCount = count(session('user_cart', []));
        return view('user.menu.show', compact('item', 'cartCount'));
    }
}