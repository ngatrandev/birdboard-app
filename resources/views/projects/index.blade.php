@extends('layouts.app')

@section('content')


<header class="flex items-center">
    <div class="flex w-1/2 justify-start">
       <project-dropdown :value1="{{$ownProject}}" :value2="{{$shareProject}}"></project-dropdown>
       <info-dropdown :value1="{{$user}}" value2="{{$ownProjectCount}}" value3="{{$shareProjectCount}}"></info-dropdown>
    </div>
    <div class="flex w-1/2 justify-end">
         <a href="" class="button mb-5" @click.prevent="$modal.show('new-project')">New Project</a>
     </div>
</header>
<portal-target name="project-list"></portal-target>
<portal-target name="info-list"></portal-target>
{{-- Dùng Portal Vue có thể send thẻ div trong template (file vue)
    đến 1 vị trí bất kì trong DOM.
    Thường dùng khi template (file vue) chứa các thẻ div ở các vị trí 
    ngẫu nhiên trong DOM --}}
<div class=" flex font-normal text-2xl text-muted text-justify font-serif italic py-4 -ml-5 pl-4 mb-6 border-t-4 border-b-4 border-muted-light" style="height:200px">
   
    <div class="lg:w-1/3 px-3">
        <svg class="h-12 w-12 fill-current text-accent float-left mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1z"/></svg>
        <p class="hover:text-accent">Birdboard securely stores your data and keeps them updated across all your devices. It lets you easily share tasks and chat with friends and family.</p>
    </div>
    <div class="lg:w-1/3 px-3">
        <svg class="h-12 w-12 fill-current text-default float-left mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"/></svg>
        <p class="hover:text-default">Add all your friends in Birdboard group by single click. You're easy to use individual task in certainly time to complete your project.</p>
    </div>
    <div class="lg:w-1/3 px-3">
        <svg class="h-12 w-12 fill-current text-alert float-left mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8a6 6 0 0 1 4.03-5.67 2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 1 1-4 0h4z"/></svg>
        <p class="hover:text-alert">Send notification immediately when your project has new activity. All members in your team follow project progress easily.</p>
    </div>
</div>

<main class="lg:flex lg:flex-wrap -mx-3"> 
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6" >
        @include('projects.card')
    </div>
        
    @empty
        <div>No projects yet.</div>
    @endforelse
</main>

<new-project-modal></new-project-modal>


@endsection

 <!-- Thêm lg thành lg:flex để các card biến đổi layout khi thay đổi size của page -->