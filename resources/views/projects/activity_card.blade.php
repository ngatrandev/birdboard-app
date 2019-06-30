<div class="card mt-6 overflow-y-auto" style="height:200px">
    <ul class="text-xs list-reset">
        @foreach ($activities as $activity)
        <li class="{{$loop->last ? '': 'pb-2'}} {{$loop->first ? 'text-alert' : ''}}">
            @if($activity->description === 'created')
                {{$activity->user->name}} created project: 
                <span class="text-blue-dark">"{{$activity->subject->title}}"</span>  
                <span class="text-muted">{{$activity->created_at->diffForHumans()}}</span>

            @elseif($activity->description === 'updated')
                {{-- Lưu ý cách viết as $key=>$value --}}
                @foreach($activity->changes['after'] as $key =>$value)
                    <p class="{{$loop->last ? '': 'pb-2'}}">
                        {{$activity->user->name}} updated {{$key}}:
                        <span class="text-blue-dark">"{{$value}}"</span> 
                        <span class="text-muted">{{$activity->created_at->diffForHumans()}}</span>
                    </p> 
                @endforeach

            @elseif($activity->description === 'created_task')
                {{$activity->user->name}} created task:
                <span class="text-blue-dark">"{{$activity->subject->body}}"</span> 
                <span class="text-muted">{{$activity->created_at->diffForHumans()}}</span>

            @elseif ($activity->description === 'updated_task')

                @foreach(array_reverse($activity->changes['after']) as $key =>$value)
                    @if ($key==='body')
                        <p>
                            {{$activity->user->name}} changed task:
                            <span class="text-blue-dark">"{{$value}}"</span> 
                            <span class="text-muted">{{$activity->created_at->diffForHumans()}}</span>
                        </p> 
                    @elseif ($key==='completed' && $value == 1)
                        <p>
                            {{$activity->user->name}} completed task:
                            <span class="text-blue-dark">"{{$activity->subject->body}}"</span>
                            <span class="text-muted">{{$activity->created_at->diffForHumans()}}</span>
                        </p>
                    @else
                        <p>
                            {{$activity->user->name}} incompleted task:
                             <span class="text-blue-dark">"{{$activity->subject->body}}"</span>
                            <span class="text-muted">{{$activity->created_at->diffForHumans()}}</span>
                        </p>
                    @endif
                    
                @endforeach
           
            @endif
        </li>
            
        @endforeach
    </ul>
</div>

