@extends('layouts.app')

@section('title',isset($task) ? 'Edit Task': 'Add Task')

@section('styles')
<style>
    .error-message {
        color: red;
        font-size: 0.8rem;
    }

</style>
@endsection

@section('content')


<form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">

    @csrf
    @isset($task)
        @method('PUT')
    @endisset

    <div class="mb-4">

        <label for="title"> Title</label>
        <input type="text" name="title" id="title"
        @class(['border-red-500' => $errors->has('title')])
        value="{{ old('title')}}" />

        @error('title')
        <p class="error-message">{{$message}}</p>
        @enderror

    </div>
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea name="description" id="description"
        @class(['border-red-500' => $errors->has('title')])
        rows="5"> {{ old('description')}}</textarea>

        @error('description')
        <p class="error-message">{{$message}}</p>

        @enderror
    </div>

    <div class="mb-4">

        <label for="long_description">Long Description</label>
        <textarea name="long_description" id="long_description"
         @class(['border-red-500' => $errors->has('title')])
         rows="10"> {{ old('long_description')}}</textarea>



        @error('long_description')

        <p class="error-message">{{$message}}</p>

        @enderror

    </div>

    <div>
        <button type="submit" class="btn">Add Task</button>
    </div>
</form>
@endsection

