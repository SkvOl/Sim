<?php

namespace App\Http\Contract\Controllers;

use App\Http\Contract\Requests\PostRequest;
use App\Http\Contract\Requests\GetRequest;
use OpenApi\Attributes as OAT;
use Illuminate\Http\Request;
use App\Http\Controller;
use App\Models\Contract;

class ContractController extends Controller{
    
    #[OAT\Get(
        path: '/contract',
        summary: 'Получение списка контрактов',
        description: 'Получение списка контрактов',
        tags: ['contract'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(
                        properties: [
                            new OAT\Property(property: 'id', type: 'int', format: 'int', example: '1'),
                            new OAT\Property(property: 'created_at', type: 'string', format: 'TIMESTAMP', example: '2025-06-21T12:56:45.000000Z'),
                            new OAT\Property(property: 'updated_at', type: 'string', format: 'TIMESTAMP', example: '2025-06-21T12:56:45.000000Z'),
                        ]
                    )),
                    new OAT\Property(property: 'meta', ref: '#/components/schemas/Paginator')
                ])
            ),
        ]
    )]
    public function get(GetRequest $request) {
        return self::response(
            Contract::select()->paginate(perPage: env('PER_PAGE'), page: $request->page)
        );
    }

    #[OAT\Post(
        path: '/contract',
        summary: 'Создание контракта',
        description: 'Создание контракта',
        tags: ['contract'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'data', type: 'object', properties: [
                            new OAT\Property(property: 'id', type: 'int', format: 'int', example: '1'),
                            new OAT\Property(property: 'description', type: 'string', format: 'string', example: 'Описание контракта'),
                            new OAT\Property(property: 'created_at', type: 'string', format: 'TIMESTAMP', example: '2025-06-21T12:56:45.000000Z'),
                            new OAT\Property(property: 'updated_at', type: 'string', format: 'TIMESTAMP', example: '2025-06-21T12:56:45.000000Z'),
                        ]
                    )
                ])
            ),
            new OAT\Response(
                response: 401,
                description: 'Ошибка'
            )
        ],
        parameters: [new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(properties: [
                new OAT\Property(property: 'user_id', type: 'int', format: 'int', example: 'Идентификатор пользователя'),
                new OAT\Property(property: 'description', type: 'string', format: 'string', example: 'Описание контракта'),
            ])
        )]
    )]
    public function create(PostRequest $request){
        $contract = new Contract;

        $contract->fill($request->only(['description']));
        $contract->save();

        $contract->users()->attach($request->user_id);

        return self::response($contract->toArray());
    }
}