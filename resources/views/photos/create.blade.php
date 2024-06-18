<x-app-layout>

    @section('title')
        <title>My images</title>
    @endsection 

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Добавить изображение') }}
      </h2>
    </x-slot>
    
@section('content')

  <div class="container">
    <div class="row">
      {{-- <div class="col-2">               
              <x-sidebar></x-sidebar>               
      </div> --}}
      <div class="col">

        <div class="container mt-5 w-75">
          <div class="card">
            
            <div class="card-header text-center font-weight-bold">
              <h2>Загрузите изображение</h2>
            </div>
            
            <div class="card-body">
              <form action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data" id="upload-image"  >
                {{ csrf_field() }}
                          
                  <div class="mb-3">
                      <label for="title" class="form-label">{{ __('Название') }}</label>
                      <input id="title" name="title" type="text" class="form-control mt-1 block w-full" required autofocus autocomplete="title" />
                  </div>
                  
                  <div class="mb-3">
                    <input id="path" name="path" type="file" class="form-control" required autofocus autocomplete="path"/>
                      {{-- <input class="form-control" type="file" id="formFileMultiple" multiple> --}}
                  </div>

                  <div class="col-md-12 hstack">
                      <button class="btn btn-dark">{{ __('Отправить') }}</button>
                      <a href="{{ route('photos.index') }}" class="btn btn-dark px-4 ms-auto" role="button">{{ __('Назад') }}</a>
                  </div> 

              </form>
            </div>     
          </div>
        </div> 
        {{-- end of card --}}
      </div>
    </div>  
  </div>
</x-app-layout>
