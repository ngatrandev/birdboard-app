@extends('layouts.app')

@section('content')
<header class="flex items-center mb-8">
    <div class="flex w-1/2 justify-start">
        <a href="/projects" class="no-underline text-default hover:text-accent">My projects</a>
    </div>
    <div class="flex w-1/2 justify-end">
         <a href="" class="button mb-5" @click.prevent="$modal.show('new-project')">New Project</a>
     </div>
</header>
<div>
    <accordion-project :items="{{$project}}"></accordion-project>
</div>

<new-project-modal></new-project-modal>
@endsection