<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function store(QuoteRequest $request)
    {
        $created_quote = Quote::create($request->validated());
        return new QuoteResource($created_quote);
    }

    public function show(Quote $quote)
    {
        return new QuoteResource($quote);
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return response()->noContent();
    }
}
