<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuestionResource::collection(Questions::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        return new QuestionResource(Questions::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $questions = Questions::findOrFail($id);
        if($questions->delete()){
            return response()->json([
                'message' => 'Success'
            ],204);
        }else{
            return response()->json([
                'message' => 'Not found'
            ],404);
        }
    }
}
