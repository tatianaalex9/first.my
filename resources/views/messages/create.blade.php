<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Отправка сообщения') }}
        </h2>
    </x-slot>
    <x-sidebar></x-sidebar> 

    <div class="container">
        <div class="row">
            <div class="col-2">               
                                  
            </div>
            <div class="col-10">

                <div class="container mt-5 w-75">
                    <div class="card">
                      
                      <div class="card-header text-center font-weight-bold">
                        <h2>Отправить сообщение</h2>
                      </div>
                      
                      <div class="card-body">
                        <form action="{{ route('messages.store') }}" method="post" enctype="multipart/form-data" id="upload-image"  >
                          {{ csrf_field() }}
                            
                            <select name="recipient_id" id="recipient_id" class="form-select" aria-label="Пример выбора по умолчанию">
                                <option selected>Выберите получателя сообщения</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }} {{ $user->email }}</option>
                                @endforeach                                
                            </select>

                            <div class="my-3">
                                <label for="subject" class="form-label">{{ __('Тема сообщения') }}</label>
                                <input id="subject" name="subject" type="text" class="form-control mt-1 block w-full" required autofocus autocomplete="subject" />
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">{{ __('Сообщение') }}</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>

                            <div class="col-md-12 hstack">
                                <button class="btn btn-dark">{{ __('Отправить') }}</button>
                                <a href="{{ route('messages.index') }}" class="btn btn-dark px-4 ms-auto" role="button">{{ __('Назад') }}</a>
                            </div> 
          
                        </form>
                      </div>     
                    </div>
                </div> 

               
            </div>
        </div>
    </div>


</x-app-layout>