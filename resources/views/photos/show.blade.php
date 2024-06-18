<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Изображение - {{ $photo->title }}
        </h2>
    </x-slot> 
    
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div> 
                    <h1 class="mt-4 mb-2 text-center text-2xl font-bold">{{ $photo->title }}</h1>
                    <p class="mb-4 text-center text-sm text-slate-500 italic">Автор: {{ $photo->user->name }} | {{ \Carbon\Carbon::parse($photo->created_at)->format('M d, Y') }}</p>
                    <div class="d-flex justify-content-between mb-2">
                        <a href="{{ route('photos.index')}}" class="btn btn-secondary py-1" role="button">{{ __('В галерею') }}</a>
                        <a href="{{ route('photos.edit', ['photo' => $photo->id]) }}" class="btn btn-secondary py-1" role="button">{{ __('Редактировать название') }}</a>
                        <form method="post" action="{{ route('photos.destroy', ['photo' => $photo->id]) }}" class="inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <x-danger-button>
                                {{ __('Удалить') }}
                            </x-danger-button>                                                  
                        </form>
                    </div>
                    <img class="rounded-t-md object-cover h-60 w-full" src="{{ asset("storage/$photo->path")}}" alt="{{ $photo->description }}"/>                  
                </div>
            </div>
        </div>  
    </div>

</x-app-layout>