<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    private TaskRepositoryInterface $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepositoryInterface = $taskRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->taskRepositoryInterface
            ->forUser(Auth::user())
            ->paginate(5);

        return view('listing.index', [
            'user' => Auth::user(),
            'tasks' => TaskResource::collection($data),
        ]);
    }
}
