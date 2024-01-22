<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex mb-5">
                <x-button wire:click.prevent="edit" class="float-right">
                    {{ __('Create Company') }}
                </x-button>
            </div>
            <x-table wire:loading.class="opacity-75">
                <x-slot name="header">
                    <x-table.header>No.</x-table.header>
                    <x-table.header sortable wire:click.prevent="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">Name</x-table.header>
                    <x-table.header sortable wire:click.prevent="sortBy('description')"
                        :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.header>
                    <x-table.header sortable wire:click.prevent="sortBy('address')"
                        :direction="$sortField === 'address' ? $sortDirection : null">Address</x-table.header>
                    <x-table.header>Logo</x-table.header>

                    <x-table.header>Action</x-table.header>
                </x-slot>
                <x-slot name="body">
                    @php
                        $i = (request()->input('page', 1) - 1) * $perPage;
                    @endphp
                    @forelse ($companies as $key => $record)
                        <x-table.row>
                            <x-table.cell> {{ ++$i }}</x-table.cell>
                            <x-table.cell>{{ $record->name }}</x-table.cell>
                            <x-table.cell> {{ $record->description }}</x-table.cell>
                            <x-table.cell> {{ $record->address }}</x-table.cell>
                            <x-table.cell> <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                    src="{{ asset($record->logo) }}" alt="Company Logo"></x-table.cell>
                            <x-table.cell>
                                <button wire:click="edit('{{ $record->id }}')"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                <button wire:click="deleteId('{{ $record->id }}')"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan=4>
                                <div class="flex justify-center items-center">
                                    <span class="font-medium py-8 text-gray-400 text-xl">
                                        No data found...
                                    </span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            @if ($companies->hasPages())
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $companies->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $companies->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $companies->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <!-- Previous Page Link -->
                                <a wire:click="previousPage" href="#"
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- Page Links -->
                                @for ($i = 1; $i <= $companies->lastPage(); $i++)
                                    <a wire:click="gotoPage({{ $i }})"
                                        class="{{ $i === $companies->currentPage() ? 'bg-indigo-600 text-white' : 'text-gray-900' }} relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        {{ $i }}
                                    </a>
                                @endfor

                                <!-- Next Page Link -->
                                <a wire:click="nextPage" href="#"
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </nav>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <x-modals.form wire:model.live="isFormOpen">
        <x-slot name="title">
            {{ __('Add/Edit Record') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <x-input id="description" type="text" class="mt-1 block w-full" wire:model="description" />
                <x-input-error for="description" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" type="text" class="mt-1 block w-full" wire:model="address" />
                <x-input-error for="address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="logo" value="{{ __('Logo') }}" />
                <div class="mt-1 flex items-center">
                    <label for="logo"
                        class="cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2">
                        <span class="text-indigo-500">Upload Logo</span>
                        <input id="logo" type="file" class="hidden" wire:model="logo" accept="image/*" />
                    </label>
                    <span class="ml-2" wire:loading wire:target="logo">Uploading...</span>
                </div>
                <x-input-error for="logo" class="mt-2" />
            </div>

        </x-slot>
    </x-modals.form>
    <!-- Delete Confirmation Modal -->
    <x-confirmation-modal wire:model.live="isDeleteModalOpen">
        <x-slot name="title">
            {{ __('Delete Record') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this record?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="closeDelete">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click.prevent="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
