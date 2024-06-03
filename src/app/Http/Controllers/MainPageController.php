<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class MainPageController extends Controller
{
    public function mainView(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!empty($keyword)) {
            $queryItem = Item::query();

            $queryItem->where('item_name', 'LIKE', "%{$keyword}%");

            $results = $queryItem->get();

            $itemImages = Itemimage::whereIn('item_id', $results->pluck('id'))->get();

            $request->session()->put('search_keyword', $keyword);
            $request->session()->put('search_results', $results);
            $request->session()->put('search_results_images', $itemImages);

            return redirect()->route('mainSearchRefineView');
        }

        $items = Item::all();
        $itemImages = ItemImage::whereIn('item_id', $items->pluck('item_id'))->get();

        return view('main', compact('items', 'itemImages'));
    }

    public function mainSearchRefineView(Request $request)
    {
        $results = $request->session()->get('search_results');
        $itemImages = $request->session()->get('search_results_images');
        $request->session()->put('search_query', $request->all());
        $request->session()->put('selected_listedOrSoldout', $request->input('listedOrSoldout'));
        $request->session()->put('selected_orderBy', $request->input('orderBy'));
        $request->session()->put('selected_condition', $request->input('condition'));
        $request->session()->put('selected_category', $request->input('category'));

        $category = $request->input('category');
        $condition = $request->input('condition');
        $listedOrSoldout = $request->input('listedOrSoldout');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $orderBy = $request->input('orderBy');

        $queryItem = Item::query();

        if (!empty($category)) {
            $queryItem->whereHas('itemCategories', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }

        if (!empty($condition)) {
            $queryItem->where('condition', $condition);
        }

        if ($listedOrSoldout === 'listed') {
            $queryItem->whereHas('transaction', function ($query) {
                $query->where('transaction_type', 'listed');
            });
        } elseif ($listedOrSoldout === 'sold_out') {
            $queryItem->whereDoesntHave('transaction', function ($query) {
                $query->where('transaction_type', 'listed');
            });
        }

        if (!empty($minPrice)) {
            $queryItem->where('price', '>=', $minPrice);
        }

        if (!empty($maxPrice)) {
            $queryItem->where('price', '<=', $maxPrice);
        }

        switch ($orderBy) {
            case 'newest':
                $queryItem->orderBy('created_at', 'desc');
                break;
            case 'lowest_price':
                $queryItem->orderBy('price', 'asc');
                break;
            case 'highest_price':
                $queryItem->orderBy('price', 'desc');
                break;
            case 'most_likes':
                $queryItem->withCount('likes')->orderByDesc('likes_count');
                break;
            default:
                $queryItem->orderBy('created_at', 'desc');
                break;
        }

        $results = $queryItem->get();

        return view('mainSearchRefine', compact('results', 'itemImages'));
    }

    public function mainMyLikeItemsView()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインしてください');
        }

        $likeItems = Like::where('user_id', $user->id)
            ->with('item')
            ->orderBy('created_at', 'asc')
            ->get();

        $itemImages = ItemImage::whereIn('item_id', $likeItems->pluck('item_id'))->get()->keyBy('item_id');

        return view('mainMyLikeItems', compact('likeItems', 'itemImages'));
    }
}
