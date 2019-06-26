<div class="card flex flex-col" style="height:200px">
            <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-accent pl-4 mb-3">
                <a href="/projects/{{$project->id}}" class="text-default no-underline">{{$project->title}}</a>
            </h3>

            <div class="mb-4 flex-1">{{str_limit($project->body, 100)}}</div>
            @can('manage', $project)
                <footer>
                    <form action="{{'/projects/' . $project->id}}" method="POST" class="text-right ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-dark">Delete</button>
                    </form>
                </footer>
            @endcan
</div>