<?php

namespace App\Http\Requests;

use App\Components\Biblioteca;
use App\Rules\CPFValidation;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->_method) {
            case 'POST':
                $validation = [
                    'des_nome'  => ['required', 'max:50'],
                    'des_email' => ['required', 'email', 'unique:tb_cad_usuarios'],
                    'des_email' => ['required', 'email', "unique:tb_cad_usuarios,des_email,{$this->id},id,deleted_at,NULL"],
                    'des_cpf' => ['required', 'max:11', "unique:tb_cad_usuarios,des_cpf,{$this->id},id,deleted_at,NULL", new CPFValidation],
                    'des_telefone' => ['max:11'],
                    'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                    'password' => ['min:6', 'required_with:password_confirmation', 'same:password_confirmation', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
				    'password_confirmation' => ['required'],
                ];
                break;
            case 'PUT':
            case 'PATCH':
                $validation = [
                    'des_nome'  => ['required', 'max:50'],
                    'des_email' => ['required', 'email', "unique:tb_cad_usuarios,des_email,{$this->id},id,deleted_at,NULL"],
                    'des_cpf' => ['required', 'max:11', "unique:tb_cad_usuarios,des_cpf,{$this->id},id,deleted_at,NULL", new CPFValidation],
                ];

                if($this->password)
                {
                    $validation += [
                        'password' => ['min:6', 'required_with:password_confirmation', 'same:password_confirmation', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
				        'password_confirmation' => ['required'],
                    ];
                }
                break;
            default:
                break;
        }

        return $validation;
    }

    /**
     * Prepara o dado antes da validação
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'des_cpf' => Biblioteca::removeMasks($this->des_cpf),
            'des_telefone' => Biblioteca::removeMasks($this->des_telefone),
        ]);
    }
}
