<?php
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::get('/', function () {
    return redirect()->route('tasks.index');
});


Route::get('/tasks', function () {
    return view('index' , [
      'tasks'=> Task::latest()->get(),
    ]);

})->name('tasks.index');

Route::view('/tasks/create', 'create');




Route::post('/tasks', function (TaskRequest $request) {
    /*$data = $request->validated();
    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();*/
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    /*$data = $request->validated();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();*/

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully');
})->name('tasks.update');

Route::get('/tasks/{task}/edit', function(Task $task) {

    return view('edit', ['task' => $task
    ]);
})->name('tasks.edit');

Route::get('/tasks', function () {
return view('index', ['tasks' => Task::latest()->paginate()]);
})->name('tasks.index');

Route::view('tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}', function(Task $task) {

    return view('show', ['task' => $task
    ]);
})->name('tasks.show');


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success','Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully');
})->name('tasks.toggle-complete');
















//Route::fallback(function () {
  //  return 'Not avaible';
//});

/*Route::get('/', function () {
    return 'welcome back uche';
})->name('home');


Route::get('/Agbo', function () {
    return redirect()->route('home');

});*/

/*Route::get('tasks/{id}', function ($id) {
  //$task = collect()->firstWhere('id', $id);

  //if (!$task) {
    //abort (Response::HTTP_NOT_FOUND,'');
     //}
    return view('show',
    ['task' => \App\Models\Task::findorFail($id)
]);

})->name('tasks.show');*/


/*Route::get('/sales', function () {
    return 'good sale';
})->name('App');

Route::get('/nnamani', function () {
    return redirect()->route('App');
});*/

//Route::get('/{id}', function () use ( $tasks ) {
  //return 'single task';
//})->name('tasks.view');
