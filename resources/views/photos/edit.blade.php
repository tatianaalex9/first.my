<x-app-layout>

    @section('title')
        <title>My images</title>
    @endsection 

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Редактировать изображение') }}
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
                  <h2>Редактировать название изображения</h2>
                </div>
                
                <div class="card-body">
                  <form action="{{ route('photos.update', ['photo' => $photo->id]) }}" method="post" enctype="multipart/form-data" id="upload-image">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}          
                      <div class="mb-3">
                          <label for="title" class="form-label">{{ __('Название') }}</label>
                          <input id="title" name="title" type="text" class="form-control mt-1 block w-full" required autofocus autocomplete="title" />
                      </div>

                      <div class="col-md-12 hstack">
                        <button class="btn btn-dark">{{ __('Сохранить') }}</button>
                        <a href="{{ route('photos.show', ['photo' => $photo->id]) }}" class="btn btn-dark px-4 ms-auto" role="button">{{ __('Назад') }}</a>
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
