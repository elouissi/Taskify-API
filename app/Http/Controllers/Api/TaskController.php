<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
 use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepositorieInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $TaskRepositorieInterface;


    public function __construct(TaskRepositorieInterface $TaskRepositorieInterface){
        $this->TaskRepositorieInterface = $TaskRepositorieInterface;
    }
   
    /**
     * Display a listing of the resource.
     */
       /**
     * @OA\Get(
     *     path="/api/Get_ALL_tasks",
     *     summary="Get all tasks",
     *     @OA\Response(response="200", description="List of tasks"),
     * )
     */
    public function index()
    {
        $this->authorize('viewAny', Task::class);
        $tasks = $this->TaskRepositorieInterface->getAll();
        return TaskResource::collection($tasks);
        
    }

    /**

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
      /**
     * @OA\Post(
     *     path="/api/Create_tasks",
     *     summary="Create a new task",
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Task description",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Task created"),
     * )
     */
    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);
        $form = $request->validated();
         $form['user_id'] = Auth::id();
        $this->TaskRepositorieInterface->create($form);
        $Tasks = $this->TaskRepositorieInterface->getAll();
        return TaskResource::collection($Tasks);

    }

    /**
     * Display the specified resource.
     */
       /**
     * @OA\Get(
     *     path="/api/Show_task/{id}",
     *     summary="Get a specific task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Task found"),
     *     @OA\Response(response="404", description="Task not found")
     * )
     */
    public function show(int $id)
    {
        $task = $this->TaskRepositorieInterface->getById($id);
        $this->authorize('view', $task);
        return response()->json($task);

    }
    public function getByUserId(){
        $user_id = Auth::id();
        $Task = $this->TaskRepositorieInterface->getByUserId($user_id);
        return response()->json($Task);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
      /**
     * @OA\Put(
     *     path="/api/Update_task/{id}",
     *     summary="Update a specific task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Task description",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Task updated"),
     *     @OA\Response(response="404", description="Task not found")
     * )
     */
    public function update(TaskRequest $request, int $id)
    {

        $task = Task::findOrFail($id);
        $this->authorize('update', $task);
        $form = $request->validated();
        $this->TaskRepositorieInterface->update($id , $form);
        $Tasks = $this->TaskRepositorieInterface->getAll();
        return TaskResource::collection($Tasks);


        
    }

    /**
     * Remove the specified resource from storage.
     */
    
    /**
     * @OA\Delete(
     *     path="/api/Delete_tasks/{id}",
     *     summary="Delete a specific task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Task deleted"),
     *     @OA\Response(response="404", description="Task not found")
     * )
     */
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('delete', $task);
        $this->TaskRepositorieInterface->delete($id);
        $Tasks = $this->TaskRepositorieInterface->getAll();
        return TaskResource::collection($Tasks);



        
    }
}
