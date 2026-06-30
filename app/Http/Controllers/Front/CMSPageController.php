<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMS;
use App\Http\Requests\Frontend\QuoteRequest;
use App\Jobs\Frontend\QuoteJob;

class CMSPageController extends Controller
{
    public function cmsPage($slug) {
        $content = CMS::where('slug', $slug)->value('content');

        return view('frontend.cms', compact('content'));
    }

    public function terms() {
        return view('frontend.terms');
    }

    public function policy() {
        return view('frontend.policy');
    }

    public function faq() {
        return view('frontend.faq');
    }

    public function carrer() {
        return view('frontend.carrer');
    }

    public function deliveryPolicy() {
        return view('frontend.delivery_policy');
    }

    public function getQuoteForm() {
        return view('frontend.quote');
    }

    public function storeQuoteForm(QuoteRequest $request) {

        $params = $request->all();
        
        dispatch(new QuoteJob($params));
 
        return redirect()->back()->with('message', 'Quote submitted Successfully.')
            ->with('type', 'success');
    }
}
