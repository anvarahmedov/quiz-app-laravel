<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Quiz;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\QuizResource;
use App\Http\Resources\V1\QuizCollection;
use Illuminate\Http\Request;
use App\Filters\V1\QuizzesFilter;
use Illuminate\Support\Arr;
use App\Http\Requests\BulkStoreQuizRequest;





class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new QuizzesFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new QuizCollection(Quiz::paginate());
        } else {
            $invoices = Quiz::where($queryItems)->paginate();
            return new QuizCollection($invoices->appends($request->query()));
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
    public function store(StoreQuizRequest $request)
    {
        //
    }

    public function bulkStore(BulkStoreQuizRequest $request) {
        $bulk = collect($request->all())->map(function($arr, $key) {
            return $arr;
        });

        Quiz::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        return new QuizResource($quiz);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        //
    }
}
