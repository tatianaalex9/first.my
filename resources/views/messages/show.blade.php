<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Сообщение пользователя
        </h2>
    </x-slot>

    {{-- <x-sidebar></x-sidebar>  --}}
    
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="container mt-5 w-75">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $message->subject }}</h5>
                            <p class="card-text">{{ $message->content }}</p>
                            <div class="hstack gap-3">
                                <a href="{{ route('messages.index') }}" class="btn btn-dark px-4" role="button">{{ __('Назад') }}</a>
                                <form method="post" action="{{ route('messages.destroy', ['message' => $message->id]) }}" class="me-auto">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <x-danger-button>
                                        {{ __('Удалить') }}
                                    </x-danger-button>                                                  
                                </form>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>  
    </div>

</x-app-layout>