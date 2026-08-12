@foreach (session('flash_notification', []) as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @if ($message['level'] === 'success')
            <a href="{{ route('login') }}">
                <button 
                    class="rounded-md text-sm text-center
                    font-semibold text-white
                    h-10 w-48 bg-green-600"
                >
                    {!! $message['message'] !!}
                </button>
            </a>
        @elseif ($message['level'] === 'error')
            <a href="{{ route('login') }}">
                <button 
                    class="rounded-md text-sm text-center
                    font-semibold text-white
                    h-10 w-48 bg-red-600"
                >
                    {!! $message['message'] !!}
                </button>
            </a>
        @endif
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
