<?php

namespace App\Shared\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// HTTP_OK = (200) Requisição foi bem sucedida com retorno no corpo da mensagem.
// HTTP_CREATED = (201) Requisição foi bem sucedida e um novo recurso foi criado e retornado no corpo da mensagem.
// HTTP_NO_CONTENT = (204) Requisição foi bem sucedida e não tem corpo de mensagem.
// HTTP_BAD_REQUEST = (400) Servidor não pode processar a requisição devido a alguma falha por parte do servidor. Ex: erro de sintaxe.
// HTTP_NOT_FOUND = (404) Servidor não encontrou o recurso solicitado.

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;    
}