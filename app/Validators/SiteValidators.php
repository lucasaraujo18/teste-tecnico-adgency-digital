<?php 

namespace App\Validators;

use \Validator;


class SiteValidators  {

    public function createSiteValidator(array $payload)
    {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:150'],
            'url' => ['required', 'url'],
            'server_id' => [
                'required', 'exists:servers,id'
            ],
        ];

        $messages = [
            'required' => 'Este campo é de preenchimento obrigatório.',
            'name.min' => 'Este campo precisa ter no mínimo 5 e no máximo 150 caracteres.',
            'name.max' => 'Este campo precisa ter no mínimo 5 e no máximo 150 caracteres.',
            'url.url' => 'Este campo precisa ter uma url válida.',
            'server_id.exists' => 'Servidor não encontrado.'
        ];

        return Validator::make($payload, $rules, $messages);
    }
}

?>