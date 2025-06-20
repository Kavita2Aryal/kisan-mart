<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\ProductQuestionAnswerRequest;
use App\Services\Ecommerce\ProductQuestionAnswerService;
use Illuminate\Http\Request;


class ProductQuestionAnswerController extends Controller
{
    public function pending(Request $request)
    {
        $data = ProductQuestionAnswerService::_paging($request, 'pending');
        return view('modules.ecommerce.product-question-answer.pending', compact('data'));
    }

    public function replied(Request $request)
    {
        $data = ProductQuestionAnswerService::_paging($request, 'replied');
        return view('modules.ecommerce.product-question-answer.replied', compact('data'));
    }

    public function get_detail(Request $request)
    {
        if(!$request->ajax()){ abort(404); }
        $data = ProductQuestionAnswerService::_find($request->uuid);
        $indexing = indexing();
        $html = view('modules.ecommerce.product-question-answer.reply-modal', compact('data', 'indexing'))->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }

    public function update(Request $request)
    {
        if(!$request->ajax()){ abort(404); }
        if (ProductQuestionAnswerService::_updating($request->answer, $request->uuid)) {
            return response()->json(['status' => true, 'url' => route('product.question.answer.replied') ]);
        }
        return response()->json(['status' => false]);
    }

    public function change_status($uuid) 
    {
        $response = ProductQuestionAnswerService::_change_status($uuid);
        return response()->json($response, 200);
    }
}