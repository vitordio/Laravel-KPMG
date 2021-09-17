<div class="page-header">
    <div class="d-flex justify-content-between">
        <div>
            <h2 class="header-title">@lang('labels.usuarios')</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{ route('home') }}" class="breadcrumb-item"><i class="anticon anticon-dashboard m-r-5"></i>@lang('labels.dashboard')</a>
                    <span class="breadcrumb-item active">@lang('labels.usuarios')</span>
                </nav>
            </div>
        </div>
        {{-- Exibimos o botão de incluir usuário apenas na index --}}
        @if(in_array(Route::currentRouteName(), ['usuario.index', 'home']))
            <div>
                <a href="{{ route('usuario.create') }}" class="btn btn-primary m-r-5" target="_blank">@lang('labels.novo_registro')</a>
            </div>
        @endif
    </div>
</div>
