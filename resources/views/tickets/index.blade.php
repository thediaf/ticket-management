<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <input type="text" name="title" placeholder="Titre du ticket"
                class="my-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
            <textarea
                name="description"
                placeholder="{{ __('La description du ticket') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Enregistrer') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

            @foreach ($tickets as $ticket)
            

                 <div class="p-6 flex space-x-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />

                    </svg>

                    <div class="flex-1">

                        <div class="flex justify-between items-center">

                            <div>

                                <span class="text-gray-800">
                                    {{ $ticket->proparty->name }}</span>

                                <small class="ml-2 text-sm text-gray-600">{{ $ticket->created_at->format('j M Y, g:i a') }}</small>

                            </div>

                        </div>

                        
                        <div class="my-4 text-lg text-gray-900">
                            {{ $ticket->title }}
                            <div>Etat: 
                                <i>{{ $ticket->state }}</i>
                            </div>
                        </div>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class=" rounded-md text-white p-2 bg-blue-800">Voir</a>

                    </div>

                </div>
                @if (auth()->user()->role == 'support')
                {{-- @unless ($ticket->assignTo) --}}
                    
                    <form method="POST" action="{{ route('tickets.state', $ticket) }}" class="m-3">
                        @csrf
                        <div class="w-full md:w-1/2 px-3 md:my-6 my-2 md:mb-0">
                            <label for="etat">Changer l'etat</label>
                            <select id="etat" name="etat" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                <option value="">Etat</option>
                                <option value="EN ATTENTE">En attente</option>
                                <option value="NE PAS TRAITER">Ne pas traiter</option>
                                <option value="TERMINÉ">Termin&eacute;</option>
                                <option value="CLÔTURÉ">Clotur&eacute;</option>
                                
                            </select>
                        </div>
                        <button type="submit" class="ml-9 mb-2 text-white p-2 bg-blue-800">Attribuer</button>
                    </form>
                    {{-- @endunless --}}
                @endif
            @endforeach 

        </div>
    </div>
</x-app-layout>