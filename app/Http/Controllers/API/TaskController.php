<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Task;
use Validator;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("inside tasks");
        $tasks = Task::all();
    
        return $this->sendResponse(TaskResource::collection($tasks), 'Tasks retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        //return $input;
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        //$task = Task::create($input);

        $task = Auth::user()->tasks()->create([
            'title' => $request['title'],
            'description' => $request['description'],
            'is_complete' => false,
            'author' => Auth::user()->name,
        ]);
         
        return $this->sendResponse($task, 'Task created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
  
        if (is_null($task)) {
            return $this->sendError('Task not found.');
        }
   
        return $this->sendResponse(new TaskResource($task), 'Task retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $task->title = $input['title'];
        $task->description = $input['description'];
        $task->is_complete = false;
        $task->author = Auth::user()->name;
        $task->save();
   
        return $this->sendResponse(new TaskResource($task), 'Task updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
   
        return $this->sendResponse([], 'Task deleted successfully.');
    }
}