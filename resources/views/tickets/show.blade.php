<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

                <div class="p-6 flex space-x-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />

                    </svg>

                    <div class="flex-1">

                        <div class="flex justify-between items-center">

                            <div>

                                <span class="text-gray-800">{{ $ticket->proparty->name }}</span>

                                <small class="ml-2 text-sm text-gray-600">{{ $ticket->created_at->format('j M Y, g:i a') }}</small>
                                <span class="ml-9"> Attribuer a {{ $ticket->assignTo ? $ticket->assignTo->name : '---' }}</span>
                            </div>

                        </div>

                        <div class="mt-4 text-lg text-gray-900">{{ $ticket->description }}
                            <div>Etat: 
                                <i>{{ $ticket->state }}</i>
                            </div>
                        </div>

                    </div>

                </div>


        </div>

        @if (auth()->user()->role == 'admin')
        @unless ($ticket->assignTo)
            
            <form method="POST" action="{{ route('tickets.assign', $ticket) }}">
                @csrf
                <div class="w-full md:w-1/2 px-3 md:my-6 my-2 md:mb-0">
                    <label for="user_id">Attribuer à</label>
                    <select id="user_id" name="user_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                        <option value="">Choisissez un utilisateur</option>
                        @foreach ($supports as $support)
                            {{-- @if ($user->role == \App\Models\User::ROLE_SUPPORT) --}}
                                <option value="{{ $support->id }}">{{ $support->name }}</option>
                            {{-- @endif --}}
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="ml-9 text-white p-2 bg-blue-800">Attribuer</button>
            </form>
            @endunless
        @endif

    </div>
</x-app-layout>