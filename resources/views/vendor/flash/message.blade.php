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
                    font-semibold text-green-700
                    min-h-10 bg-green-50 w-full"
                >
                    {!! $message['message'] !!}
                </button>
            </div>
        @elseif (
            $message['level'] === 'error'
            || $message['level'] === 'danger'
        )
            <div class="w-full flex justify-center">
                <button
                    class="rounded-md text-sm text-center
                    font-semibold text-red-700
                    min-h-10 bg-red-50 w-full"
                >
                    {!! $message['message'] !!}
                </button>
            </div>    
        @endif
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
