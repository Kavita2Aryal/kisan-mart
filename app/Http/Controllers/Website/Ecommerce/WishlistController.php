<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Support;
use App\Models\Ecommerce\Wishlist;
use Response;
use Validator;
use Auth;

use App\Models\ProductImages;

class WishlistController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $_auth = new Support();
            $wishlists = $_auth->_customer ? $_auth->wishlist_get() : [];
            return view('ecommerce.wishlist.index', compact('wishlists', '_auth'));
        } else {
            return redirect()->route('login')->with('error', 'You need to login to proceed');
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) { abort(403); }
        if (Auth::user()) {
            $validator = Validator::make($request->all(), [
                'product' => 'sometimes|uuid|exists:products,uuid',
                'gift_voucher' => 'sometimes|uuid|exists:gift_vouchers,uuid'
            ]);
            if (!$validator->fails()) {
                
                $_auth = new Support();
                $status = $_auth->wishlist_addup($request->all());
                $count = $_auth->wishlist_count();
                $wishlists = $_auth->wishlist_get();
                $html = view('includes.wishlist-flip', compact('wishlists'))->render();
                return Response::json(['status' => $status, 'count' => $count, 'html' => $html]);
            }
            return Response::json(['status' => false]);
        }
        $customer_login_url = route('login');
        return Response::json(['status' => false, 'auth' => false, 'customer_login_url' => $customer_login_url]);
        
        
    }

    public function remove(Request $request)
    {
        if (!$request->ajax()) { abort(403); }
        $validator = Validator::make($request->all(), [
            'uuid' => 'sometimes|uuid|exists:wishlists,uuid'
        ]);
        if (!$validator->fails()) {
            $_auth = new Support();
            $status = $_auth->wishlist_remove($request->all());
            $count = $_auth->wishlist_count();
            $wishlists = $_auth->wishlist_get();
            $html = view('includes.wishlist-flip', compact('wishlists'))->render();
            return Response::json(['status' => $status, 'count' => $count, 'html' => $html]);
        }
        return Response::json(['status' => false]);
        
    }

    public function removeAll(Request $request)
    {
        if (Wishlist::where(['customer_id' => Auth::user()->id])->delete()) {
            return redirect()->back()->with('success', 'Removed all proucts from your wishlist.');
        }
        return redirect()->back()->with('error', 'Sorry! Something went wrong. Please try again later.');
    }

    public function destroy(Request $request)
    {
        if (Auth::user()) {
            Wishlist::where('customer_id', Auth::user()->id)->delete();
            return redirect()->back()->with('success', 'Success');
        }
        return redirect()->back()->with('error', 'auth-failed');
    }
}
