<div class="card flex flex-col mt-3">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-accent-light pl-4">
        Invite a User
    </h3>

    <form method="POST"  action="{{ '/projects/' . $project->id . '/invitations' }}">
        @csrf

        <div class="mb-3">
            <input type="email" name="email" value="{{old('email')}}" 
            class="border border-muted focus:border-alert rounded w-full py-2 px-3" 
            placeholder="Email address"
            >
        </div>
        @if ($errors->invitations->any())
                    @foreach ($errors->invitations->all() as $error)
                        <div class="w-full text-alert mb-2 text-sm">
                               <span>Hi {{auth()->user()->name}}! {{$error}}</span>
                        </div>
                    @endforeach
        @endif
        <button type="submit" class="button">Invite</button>

        
    </form>  
</div>
