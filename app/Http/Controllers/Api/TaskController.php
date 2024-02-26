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
    public function index()
    {
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
    public function store(TaskRequest $request)
    {
        $form = $request->validated();
         $form['user_id'] = Auth::id();
        $this->TaskRepositorieInterface->create($form);
        $Tasks = $this->TaskRepositorieInterface->getAll();
        return TaskResource::collection($Tasks);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $task = $this->TaskRepositorieInterface->getById($id);
        return response()->json($task);

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
    public function update(TaskRequest $request, int $id)
    {
        
        $form = $request->validated();
        $this->TaskRepositorieInterface->update($id , $form);
        $Tasks = $this->TaskRepositorieInterface->getAll();
        return TaskResource::collection($Tasks);


        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->TaskRepositorieInterface->delete($id);
        $Tasks = $this->TaskRepositorieInterface->getAll();
        return TaskResource::collection($Tasks);



        
    }
}
