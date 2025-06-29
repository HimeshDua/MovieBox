<x-admin-layout>
    <x-slot:title>
        Customers Information | MovieBox
    </x-slot>

    <x-slot:section_title>
        Customers Information
    </x-slot>

    <div class="space-y-12">

        <div class="bg-card border border-border rounded-xl p-6 shadow">
            {{-- <h2 class="text-xl font-semibold text-foreground mb-4">👤 Users Information</h2> --}}

            @if ($users->count())
                <ul class="space-y-4">
                    @foreach ($users as $user)
                        <li class="border border-border rounded-lg p-4">
                            <div class="text-sm text-muted-foreground space-y-1">
                                <p><span class="font-medium text-foreground">Name: </span>
                                    {{ $user->name }}</p>
                                <p><span class="font-medium text-foreground">Email: </span> {{ $user->email }}</p>
                                <p><span class="font-medium text-foreground">Age: </span> {{ $user->age }}
                                </p>

                                <p><span class="font-medium text-foreground">BirthDate: </span> {{ $user->birthdate }}
                                </p>
                                <p><span class="font-medium text-foreground">Total Spend:</span> Rs
                                    {{ $user->total_spend }}</p>
                                <p><span class="font-medium text-foreground">Joined:
                                    </span>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-muted-foreground">You haven’t booked any shows yet.</p>
            @endif
        </div>

    </div>
</x-admin-layout>
