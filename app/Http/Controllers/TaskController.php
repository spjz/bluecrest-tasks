<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Interfaces\TaskRepositoryInterface;
use App\Classes\ResponseClass;
use App\Http\Resources\TaskResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    private TaskRepositoryInterface $taskRepositoryInterface;
    // private User $user;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepositoryInterface = $taskRepositoryInterface;
        // $this->user = auth('sanctum')->user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = $this->taskRepositoryInterface->forUser($this->user);

        $data = $this->taskRepositoryInterface->index();
        return ResponseClass::sendResponse(TaskResource::collection($data), '', Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $details = [
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ];

        error_log($request->user_id);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($request->user_id);
            $task = $this->taskRepositoryInterface->store($user, $details);

            DB::commit();
            return ResponseClass::sendResponse(new TaskResource($task), 'Task Creation Successful', Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = $this->taskRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new TaskResource($task), '', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $updateDetails = [
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ];
        DB::beginTransaction();
        try {
            $task = $this->taskRepositoryInterface->update($updateDetails, $id);

            DB::commit();
            return ResponseClass::sendResponse('Task Update Successful', '', Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->taskRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Task Delete Successful', '', Response::HTTP_NO_CONTENT);
    }
}
