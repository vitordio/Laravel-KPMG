<div class="card">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-md-flex align-items-center">
                    @isset($model->des_path_image)
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                <img src="{{ asset("/image/usuarios/$model->des_path_image") }}" alt="">
                            </div>
                        </div>
                    @endisset
                    <div class="text-center text-sm-left m-v-15 p-l-30">
                        <h2 class="mb-0">{{ $model->des_nome }}</h2>
                        <p class="text-opacity font-size-13">
                            <b>@lang('labels.created_at'):</b>  {{ $model->created_at }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('usuario.edit', ['usuario' => Crypt::encryptString($model->id)]) }}" class="m-r-5 button-edit p-v-10 p-h-20" title="@lang('labels.edit')" data-toggle="tooltip" data-placement="top">
                                <i class="anticon anticon-edit"></i>
                                <span class="m-l-3">@lang('labels.edit')</span>
                            </a>
                            <a class="ml-3 font-size-13 text-muted" href="{{ url()->previous() }}">
                                <i class="anticon anticon-arrow-left"></i>
                                @lang('labels.back')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="d-md-block d-none border-left col-1"></div>
                    <div class="col">
                        <ul class="list-unstyled m-t-10">
                            <li class="row">
                                <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                    <span>@lang('labels.des_cpf'): </span>
                                </p>
                                <p class="col font-weight-semibold"> {{ $model->des_cpf }}</p>
                            </li>
                            <li class="row">
                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                    <span>@lang('labels.des_email') </span>
                                </p>
                                <p class="col font-weight-semibold"> {{ $model->des_email }}</p>
                            </li>
                            @isset($model->des_telefone)
                                <li class="row">
                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                        <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                        <span>@lang('labels.des_telefone') </span>
                                    </p>
                                    <p class="col font-weight-semibold"> {{ $model->des_telefone }}</p>
                                </li>
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
