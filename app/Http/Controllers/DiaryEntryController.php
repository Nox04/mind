<?php

namespace App\Http\Controllers;

use App\Models\DiaryEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryEntryController extends Controller
{
    /**
     * @var DiaryEntry
     */
    private $diaryEntry;

    /**
     * Create a controller instance.
     * @param DiaryEntry $diaryEntry
     */
    public function __construct(DiaryEntry $diaryEntry)
    {
        $this->diaryEntry = $diaryEntry;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->diaryEntry->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiaryEntry  $diaryEntry
     * @return \Illuminate\Http\Response
     */
    public function show(DiaryEntry $diaryEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiaryEntry  $diaryEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(DiaryEntry $diaryEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiaryEntry  $diaryEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiaryEntry $diaryEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiaryEntry  $diaryEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiaryEntry $diaryEntry)
    {
        //
    }
}
