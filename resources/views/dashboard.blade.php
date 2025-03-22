<x-app-layout>
    @if(auth()->user()->status == 'pending')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-center p-6 text-gray-900">
                    {{ __("Your account is pending approval, You cannot vote or receive votes until approved 😚.") }}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h2 class="text-primary">Vote for Users</h2>
                        <div class="row mt-2">
                            @foreach ($approvedUsers as $user)
                            <div class="col-md-4 mb-4">
                                <div class="card pt-2">
                                    <h5 class="text-center card-title text-danger">{{ $user->name }}</h5>
                                    <div class="card-body">
                                        <img src="{{ asset('defaultImage.jpg') }}" style="width: 100px; height:70px;" class="rounded card-img-top" alt="{{ $user->name }}">
                                        <form id="voteForm" action="{{ route('vote') }}" method="POST" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="hidden" name="voted_from_id" value="{{ auth()->user()->id }}">
                                            <input type="text" name="text" class="w-full p-2 border border-gray-300 rounded mb-2"
                                @if($user->id && \App\Models\Vote::where('user_id', $user->id)->where('voted_from_id', auth()->user()->id)->exists()) hidden @endif
                                                placeholder="Enter your voting">
                                            <button type="submit" class="send-ajax w-full p-2 bg-blue-500 text-blue rounded hover:bg-blue-600">Vote </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $approvedUsers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @push('script')
    <script>
        $(document).ready(function () {
            @if (session('success'))
            Swal.fire({
                toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
                @endif
            });
    </script>
    @endpush
</x-app-layout>
