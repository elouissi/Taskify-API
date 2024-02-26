<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepositorieInterface;

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
        $Tasks = $this->TaskRepositorieInterface->getAll();
       
        return response()->json($Tasks);
    
        
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
        $this->TaskRepositorieInterface->create($form);
        $Tasks = $this->TaskRepositorieInterface->getAll();
        return response()->json([
           "tasks" => $Tasks
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
