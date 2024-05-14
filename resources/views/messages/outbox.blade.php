<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Исходящие сообщения') }}
        </h2>
    </x-slot>
    <x-sidebar></x-sidebar> 

    <div class="container text-center">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">

                <div class="row text-center">
                    <div class="my-5">
                        <a href="{{ route('messages.create') }}" class="btn btn-dark btn-lg" role="button">{{ __('Отправить сообщение') }}</a>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Дата / время</th>
                        <th scope="col">Получатель</th>
                        <th scope="col">Тема</th>
                        <th scope="col">Сообщение</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody class="text-start">
                    @foreach($messages as $message)
                      <tr>
                        <td>{{\Carbon\Carbon::parse($message->created_at)->translatedFormat('d.m.Y / H:m:s')}}</td>
                        <td>{{$message->last_name}} {{$message->name}}</td>                     
                        <td>{{ Str::limit(($message->subject), 20, '...') }}</td>
                        <td>{{ Str::limit(($message->content), 40, '...') }}</td>
                        <td>
                            <a href="{{ route('messages.show', ['message' => $message->id]) }}" class="btn btn-secondary py-1" role="button">{{ __('Посмотреть') }}</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('messages.destroy', ['message' => $message->id]) }}" class="inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <x-danger-button>
                                    {{ __('Удалить') }}
                                </x-danger-button>                                                  
                            </form>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>