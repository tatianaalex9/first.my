<x-app-layout>

    {{-- @section('title')
        <title>Моя галерея</title>
    @endsection  --}}

    {{-- <x-slot:title_slot>Моя галерея</x-slot>  --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Моя галерея') }}
        </h2>
    </x-slot>

    <div class="container text-center">
        <div class="row">
            <div class="col">

                <div class="row text-center">
                    <div class="my-5">
                        <a href="{{ route('photos.create') }}" class="btn btn-dark btn-lg" role="button">{{ __('Добавить изображение') }}</a>
                    </div>
                </div>

                <!-- photos -->               
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($photos as $photo)
                        <div class="col">
                            <div class="card h-100">                                      
                                <a href="{{ route('photos.index', ['photo' => $photo->id]) }}">
                                    <img class="card-img-top" src="{{ asset("storage/$photo->path")}}" alt="{{ $photo->description }}"/> 
                                </a>
                                <div>
                                    <div class="text-sm text-gray-500 pt-2">
                                        Автор: {{ $photo->user->name }} | 
                                        {{ \Carbon\Carbon::parse($photo->created_at)->format('M d, Y') }}
                                    </div>
                                    <h2 class="fs-4 text font-bold">{{ $photo->title }}</h2>
                                    <div class="vstack gap-2 mb-2 mx-3">
                                        {{-- <div class="hstack  mb-2 mx-3"> --}}
                                        <a href="{{ route('photos.show', ['photo' => $photo->id]) }}" class="btn btn-secondary py-1" role="button">{{ __('Посмотреть') }}</a>
                                        <form method="post" action="{{ route('photos.destroy', ['photo' => $photo->id]) }}" class="inline">
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
                    @endforeach
                </div>   
                
            </div>
        </div>  
    </div>

</x-app-layout>