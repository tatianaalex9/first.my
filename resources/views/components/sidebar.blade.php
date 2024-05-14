{{-- Письма --}}
<div class="flex-shrink-0 ps-5 pt-4 border-end my-3 bg-white" style="width: 250px; position: fixed; left: 0; top: 141px; bottom: 0;">
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex border-0 fs-4 ps-0" data-bs-toggle="collapse" data-bs-target="#home-collapse">{{ __('Письма') }}
            </button>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal">
                    <li>
                        <a href="{{ route('messages.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded align-items-center ps-4">
                        {{ __('Входящие') }}                                    
                            <span class="ml-1 translate-middle p-1 bg-danger border border-light rounded-circle ms-2">
                                <span class="visually-hidden">Новые уведомления</span>
                            </span>
                        </a>
                    </li>
                    <li><a href="{{ route('outbox') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded ps-4">{{ __('Исходящие') }}</a></li>
                </ul>
            </div>
        </li>

        <li class="border-top my-3"></li>
    {{-- Галерея --}}        
        <li class="mb-1">
            <a href="{{ route('photos.index') }}">
                <button class="btn btn-toggle d-inline-flex border-0 fs-4 ps-0" data-bs-toggle="collapse">
                    {{ __('Галерея') }}
                </button>
            </a>
        </li>                    
    </ul>
</div>
          

