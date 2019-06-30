@extends('layouts.app')

@section('content')
<header class="flex items-center mb-6 py-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-muted font-light text-sm">
            <a href="/projects" class="text-muted text-sm no-underline">My Projects</a>/{{$project->title}}
        </p>
        <div class="flex items-center">
            @foreach ($project->members as $member)
                <img src="https://gravatar.com/avatar/{{md5($member->email)}}?s=60" alt="{{$member->name}}'s avatar" class="rounded-full w-8 mr-2">   
            @endforeach
                <img src="https://gravatar.com/avatar/{{md5($project->user->email)}}?s=60" alt="{{$project->user->name}}'s avatar" class="rounded-full w-8 mr-2">
                <a href="" class="button ml-4" @click.prevent="$modal.show('edit-project')">Edit Project</a>
        </div>
        
    </div>
    
</header>

<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3">
            <div class="mb-8">
                <h2 class="text-lg text-muted font-light mb-3">Tasks</h2>
                @foreach($project->task as $task)
                    <div class="card mb-3">
                        <form action="{{'/projects/' . $project->id . '/tasks/' . $task->id}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="flex">
                                <input value="{{$task->body}}" class="text-default bg-card w-full {{$task->completed? 'line-through text-muted':''}}" name="body">
                                <input type="checkbox" name="completed" onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                            </div>
                        </form> 
                    </div>
                @endforeach
                @can('manage', $project)
                    <div class="card mb-3">
                        <form action="{{'/projects/' . $project->id . '/tasks'}}" method="POST">
                            @csrf
                            <input 
                            placeholder="Add new task" 
                            class="text-default w-full bg-card"
                            name="body">
                        </form>
                    </div>
                @endcan
                @if ($errors->default->any())
                    @foreach ($errors->default->all() as $error)
                        <div class="w-full text-alert ml-4 text-sm">
                               <span>Hi {{auth()->user()->name}}! {{$error}}</span>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mb-6">
                <h2 class="text-lg text-muted font-light mb-3">General Notes</h2>
                <form action="{{'/projects/' . $project->id}}" method="POST">
                    @csrf
                    @method('patch')
                    <textarea 
                        class="card text-default w-full mb-4" 
                        style="min-height:200px" 
                        placeholder="Anything special that you want to make a note of?" 
                        name="notes"
                        >{{$project->notes}}
                    </textarea>
                    <input type="hidden" name="title" value="{{$project->title}}">
                    <input type="hidden" name="body" value="{{$project->body}}">
                    <button type="submit" class="button">Save</button>
                </form> 
                
            </div>
        </div>

        <div class="lg:w-1/4 px-3 lg:py-8">
            @include('projects.card')
            @include('projects.activity_card')
            @can('manage', $project) 
            {{-- dùng can check policy 'manage' --}}
                @include('projects.invite_card')
            @endcan
        </div>
    </div>
   
</main>
<update-project-modal id="{{$project->id}}"  oldtitle = "{{$project->title}}" oldbody="{{$project->body}}"></update-project-modal>
{{-- đây là các props pass qua file vue --}}

@endsection

@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
    @if($errors->invitations->has('email'))
    $("input[name='email']").focus();
    @elseif($errors->default->has('body'))
    $("input[name='body']").focus();
    @endif
});
</script>
    
@endsection
