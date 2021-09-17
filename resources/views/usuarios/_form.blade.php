@php
    use App\Components\Biblioteca;
@endphp

{{-- Exibe a informação que ocorreram erros na validação (nos campos as mensagens do erro também são exibidas) --}}
@if ($errors && !$errors->isEmpty())
<div class="alert alert-danger">
    <div class="d-flex align-items-center justify-content-start">
        <span class="alert-icon">
            <i class="anticon anticon-close-o"></i>
        </span>
        <span>@lang('messages.errorValidation')</span>
    </div>
</div>
@endif

<form method="POST" action="{{ $options['route'] }}" enctype="multipart/form-data">
    {{ $model->exists ? method_field('PUT') : method_field('POST') }}
    {{ csrf_field() }}

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="des_nome">@lang('labels.des_nome')</label>
            <input type="text"
                required
                class="form-control {{ $errors->has('des_nome') ? ' is-invalid' : '' }}"
                id="des_nome"
                name="des_nome"
                value="{{ old('des_nome', $model->des_nome) }}"
                {{ $options['method'] === Biblioteca::METHOD_SHOW ? 'disabled' : '' }}
                placeholder="@lang('labels.des_nome')">

            @if($errors->has('des_nome'))
                <div class="invalid-feedback">
                    {{ $errors->first('des_nome') }}
                </div>
            @endif
        </div>

        <div class="form-group col-md-3">
            <label for="des_cpf">@lang('labels.des_cpf')</label>
            <input type="text"
                required
                class="form-control cpf {{ $errors->has('des_cpf') ? ' is-invalid' : '' }}"
                id="des_cpf"
                name="des_cpf"
                value="{{ old('des_cpf', $model->des_cpf) }}"
                placeholder="@lang('labels.mask_cpf')">

            @if($errors->has('des_cpf'))
                <div class="invalid-feedback">
                    {{ $errors->first('des_cpf') }}
                </div>
            @endif
        </div>

        <div class="form-group col-md-3">
            <label for="des_email">@lang('labels.des_email')</label>
            <input type="email"
                required
                class="form-control {{ $errors->has('des_email') ? ' is-invalid' : '' }}"
                id="des_email"
                name="des_email"
                value="{{ old('des_email', $model->des_email) }}"
                {{ $options['method'] === Biblioteca::METHOD_SHOW ? 'disabled' : '' }}
                placeholder="@lang('labels.des_email')">

            @if($errors->has('des_email'))
                <div class="invalid-feedback">
                    {{ $errors->first('des_email') }}
                </div>
            @endif
        </div>

        <div class="form-group col-md-3">
            <label for="des_telefone">@lang('labels.des_telefone')</label>
            <input type="tel"
                class="form-control celular {{ $errors->has('des_telefone') ? ' is-invalid' : '' }}"
                id="des_telefone"
                name="des_telefone"
                value="{{ old('des_telefone', $model->des_telefone) }}"
                {{ $options['method'] === Biblioteca::METHOD_SHOW ? 'disabled' : '' }}
                placeholder="@lang('labels.des_telefone')">

            @if($errors->has('des_telefone'))
                <div class="invalid-feedback">
                    {{ $errors->first('des_telefone') }}
                </div>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password">@lang('labels.password')</label>
            <input type="password"
                class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                id="password"
                name="password"
                value="{{ old('password') }}"
                {{ $options['method'] === Biblioteca::METHOD_SHOW ? 'disabled' : '' }}
                placeholder="@lang('labels.password')">

            @if($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="password_confirmation">@lang('labels.password_confirmation')</label>
            <input type="password"
                class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                id="password_confirmation"
                name="password_confirmation"
                value="{{ old('password_confirmation') }}"
                {{ $options['method'] === Biblioteca::METHOD_SHOW ? 'disabled' : '' }}
                placeholder="@lang('labels.password_confirmation')">

            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input {{ $errors->has('image') ? ' is-invalid' : '' }}" id="image">
                <label class="custom-file-label" for="image">@lang('labels.arquivo')</label>

                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
            </div>
        </div>

        @if($model->exists && isset($model->des_path_image))
            <div class="form-group col-md-6">
                <div class="avatar avatar-image" style="width: 150px; height:150px">
                    <img src="{{ asset("/image/usuarios/$model->des_path_image") }}" alt="">
                </div>
            </div>
        @endif
    </div>

    <div class="form-group">
        <div class="checkbox">
            <input type="hidden" name="flg_ativo" value="{{ Biblioteca::FLG_DESATIVO }}" />
            <input
            type="checkbox"
            name="flg_ativo"
            value="{{ old('flg_ativo', Biblioteca::FLG_ATIVO) }}"
            {{ $options['method'] === Biblioteca::METHOD_SHOW ? 'disabled' : '' }}
            {{ old('flg_ativo', $model->getRawOriginal('flg_ativo')) == Biblioteca::FLG_ATIVO || !$model->exists ? 'checked' : '' }}
            id="flg_ativo">

            <label for="flg_ativo">@lang('labels.flg_ativo') </label>
        </div>
    </div>

    {{-- Input oculto com o ID do usuário --}}
    @if($model->exists)
        <input type="hidden" name="id" value="{{ $model->id }}">
    @endif

    @if($options['method'] != Biblioteca::METHOD_SHOW)
        <button type="submit" class="btn btn-primary">@lang('labels.salvar')</button>
        <a class="ml-3 font-size-13 text-muted" href="{{ url()->previous() }}">
            <i class="anticon anticon-arrow-left"></i>
            @lang('labels.back')
        </a>
    @endif
</form>
