<?php 

namespace App\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Validation\Rules\Password;


class UserValidator  {

    public function createUserValidator(array $payload)
    {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:150', 'alpha_spaces'],
            'email' => ['required', 'string', 'mail', 'min:6', 'max:255', 'unique:users', 'verifyEmail'],
            'password' => [
                'bail', 'required',
                Password::min(8)->mixedCase(),
                Password::min(8)->symbols(),
                Password::min(8)->numbers()
            ],
            'password_confirmation' => [
                'required',
                'bail',
                'same:password'
            ],
            'privacy_terms' => [
                'required'
            ],
        ];

        $messages = [
            'required' => 'Este campo é de preenchimento obrigatório.',
            'name.min' => 'Este campo precisa ter no mínimo 5 e no máximo 150 caracteres.',
            'name.max' => 'Este campo precisa ter no mínimo 5 e no máximo 150 caracteres.',
            'email.mail' => 'E-mail inválido. Preencha novamente.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'email.max' => 'Este campo precisa ter no mínimo 6 e no máximo 70 caracteres.',
            'email.min' => 'Este campo precisa ter no mínimo 6 e no máximo 70 caracteres.',
            'password.min' => 'Senha inválida, preencha novamente.',
            'password.mixedCase' => 'Senha inválida, preencha novamente.',
            'password.symbols' => 'Senha inválida, preencha novamente.',
            'password.numbers' => 'Senha inválida, preencha novamente.',
            'password_confirmation.same' => 'As senhas não estão iguais. Preencha novamente.'
        ];

        return Validator::make($payload, $rules, $messages);
    }
}

?>