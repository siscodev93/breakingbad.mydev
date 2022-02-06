<div class="character-searchable-list flex flex-row w-full h-screen bg-gray-300">
    <aside class="w-1/5 border rounded m-5 bg-white shadow-sm ">
        <div class="container p-2">
            <h4 class="text-center text-2xl">Character Search</h4>
            <hr>
            <div class="flex flex-col p-5">
                <label class="text-sm text-slate-700" >Character Name:</label>
                <input type="text" class="p-2 border-2" placeholder="Enter Character Name" wire:model='name'/>
            </div>
            <div class="flex flex-col p-5">
                <label class="text-sm text-slate-700" >Character Series:</label>
                <select class="p-2 border-2 bg-white" wire:model='series'>
                    <option value="">All Series</option>
                    <option value="breaking bad">Breaking Bad</option>
                    <option value="better call saul">Better Call Saul</option>
                </select>
            </div>

            <div class="flex flex-col p-5">
                <label class="text-sm text-slate-700" >Character Status:</label>
                <select class="p-2 border-2 bg-white" wire:model='status'>
                    <option value="">All Statuses</option>
                    <option value="alive">Alive</option>
                    <option value="deceased">Dead</option>
                </select>
            </div>


        </div>
    </aside>

    <div class="w-full border rounded m-5 ml-0 bg-white shadow-sm overflow-auto">
        <div class="container p-5">
            <h2 class="text-3xl">Characters</h2>

            <div class="flex flex-row flex-wrap space-3">
                @foreach ($characters as $character)
                <div class="border-box flex basis-1/5 flex-col gap-3 p-4 justify-center items-center m-5 rounded-md shadow-md transition-shadow duration-400 hover:shadow-2xl">
                    <div class="rounded-full w-40 h-40 overflow-hidden">
                        <img src="{{$character->img}}" class="w-fullobject-cover">
                    </div>
                    <p class=" text-xl text-center">{{$character->name}}</p>
                    <p class=" text-xl text-center">{{$character->status}}</p>
                    <div class="flex flex-col justify-center items-center">
                        <p>Plays in: </p>
                        <p class="text-center">
                            {{$character->category}}
                        </p>
                    </div>
                    <div class="flex flex-row">
                        <a href="#" class="text-blue-600">View Character</a>
                    </div>
                </div>
            @endforeach
            </div>


        </div>
    </div>
</div>
