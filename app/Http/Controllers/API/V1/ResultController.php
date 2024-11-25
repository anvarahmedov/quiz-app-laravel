<?php

namespace App\Http\Controllers\V1;

use App\Models\V1\Result;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Filters\V1\ResultsFilter;
use App\Http\Resources\V1\ResultCollection;
use App\Http\Resources\V1\ResultResource;
use App\Http\Controllers\Controller;


class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter = new ResultsFilter();
        $queryItems = $filter->transform(request());
        $includeLatest = request()->query('includeLatest');



        if (count($queryItems) == 0) {
            return new ResultCollection(Result::paginate());
        } else {

            $results = Result::where($queryItems)->paginate();
            if ($includeLatest) {
             //   $results = Result::orderBy('id', 'ASC')->get();
            }

            return new ResultCollection($results->appends(request()->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        return new ResultResource($result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultRequest $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
