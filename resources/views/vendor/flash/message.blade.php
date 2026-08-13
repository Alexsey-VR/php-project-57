@foreach (session('flash_notification', []) as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @if ($message['level'] === 'success')
            <div class="w-full flex justify-center">
                <button
                    class="rounded-md text-sm text-center
                    font-semibold text-white
                    min-h-10 bg-green-600 w-full"
                >
                    {!! $message['message'] !!}
                </button>
            </div>
        @elseif ($message['level'] === 'error')
            <div class="w-full flex justify-center">
                <button
                    class="rounded-md text-sm text-center
                    font-semibold text-white
                    min-h-10 bg-red-600 w-full"
                >
                    {!! $message['message'] !!}
                </button>
            </div>    
        @endif
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
