@extends ('layouts.app')

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Edit your project
        </h1>

        <form method="POST" action="{{'/projects/' . $project->id}}">
            @csrf
            @method('patch')
            <div class="field mb-6">
                <label class="label text-sm mb-2 block" for="title">Title</label>
            
                <div class="control">
                    <input
                            type="text"
                            class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full"
                            name="title"
                            placeholder="Your project's title"
                            value="{{$project->title}}">
                </div>
            </div>
            
            <div class="field mb-6">
                <label class="label text-sm mb-2 block" for="description">Description</label>
            
                <div class="control">
                        <textarea
                            name="body"
                            rows="10"
                            class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-full"
                            placeholder="Your project's description"
                            >{{$project->body}}</textarea>
                </div>
            </div>
        
            <div class="field mb-3">
                <div class="control">
                    <button type="submit" class="button is-link mr-2">Update Project</button>
            
                    <a href="/projects/{{$project->id}}" class="text-default">Cancel</a>
                </div>
            </div>
        
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="w-full text-alert ml-4 text-sm">
                        <span>{{$error}}</span>
                    </div>
                @endforeach
            @endif
        </form>
    </div>
@endsection

@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
    @if($errors->has('title'))
    $("input[name='title']").focus();
    @elseif($errors->has('body'))
    $("textarea[name='body']").focus();
    @endif
});
</script>
    
@endsection