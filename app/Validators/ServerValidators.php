<?php 

namespace App\Validators;

use \Validator;


class ServerValidators  {

    public function createServerValidator(array $payload)
    {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:150'],
            'ip' => ['required', 'ip'],
            'user_id' => [
                'required', 'exists:users,id'
            ],
        ];

        $messages = [
            'required' => 'Este campo é de preenchimento obrigatório.',
            'name.min' => 'Este campo precisa ter no mínimo 5 e no máximo 150 caracteres.',
            'name.max' => 'Este campo precisa ter no mínimo 5 e no máximo 150 caracteres.',
            'ip.ip' => 'Este campo precisa ter um ip válido.',
            'user_id.exists' => 'Usuário não encontrado.'
        ];

        return Validator::make($payload, $rules, $messages);
    }
}

?>