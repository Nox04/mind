<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiaryEntryRequest;
use App\Http\Resources\DiaryEntryResource;
use App\Models\DiaryEntry;
use App\Models\User;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
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
        $this->authorizeResource('diaryEntry', null, ['except' => ['index', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return DiaryEntryResource::collection($this->diaryEntry->getAllDiaryEntries(Auth::id())->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DiaryEntryRequest $request
     * @return DiaryEntryResource
     */
    public function store(DiaryEntryRequest $request)
    {
        return new DiaryEntryResource(Auth::user()->diaryEntries()->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param DiaryEntry $diaryEntry
     * @return DiaryEntryResource
     */
    public function show(User $user, DiaryEntry $diaryEntry)
    {
        return new DiaryEntryResource($diaryEntry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DiaryEntryRequest $request
     * @param User $user
     * @param DiaryEntry $diaryEntry
     * @return DiaryEntryResource
     */
    public function update(DiaryEntryRequest $request, User $user, DiaryEntry $diaryEntry)
    {
        $diaryEntry->update($request->validated());

        return new DiaryEntryResource($diaryEntry);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param DiaryEntry $diaryEntry
     * @return Response
     * @throws Exception
     */
    public function destroy(User $user, DiaryEntry $diaryEntry)
    {
        $diaryEntry->delete();

        return response()->json(null, 204);
    }
}
