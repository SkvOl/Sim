<?php
namespace App\Http\Sim\Controllers;

use App\Http\Sim\Resources\SimResource;
use App\Http\Sim\Requests\GetRequest;
use OpenApi\Attributes as OAT;
use App\Http\Controller;
use App\Models\Sim;

class SimController extends Controller{
    
    #[OAT\Get(
        path: '/sim',
        summary: 'Получение списка сим-карт',
        description: 'Получение списка сим-карт',
        tags: ['sim'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Успешно',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(
                        properties: [
                            new OAT\Property(property: 'id', type: 'int', format: 'int', example: '1'),
                            new OAT\Property(property: 'contract_id', type: 'int', format: 'int', example: '34'),
                            new OAT\Property(property: 'phone', type: 'int', format: 'int', example: '9273610640'),
                            new OAT\Property(property: 'name', type: 'string', format: 'string', example: 'Любое название сим карты'),
                            new OAT\Property(property: 'created_at', type: 'string', format: 'TIMESTAMP', example: '2025-06-21T12:56:45.000000Z'),
                            new OAT\Property(property: 'updated_at', type: 'string', format: 'TIMESTAMP', example: '2025-06-21T12:56:45.000000Z'),
                        ]
                    )),
                    new OAT\Property(property: 'meta', ref: '#/components/schemas/Paginator')
                ])
            ),
        ],
        parameters: [
            new OAT\Parameter(name: 'groups_id', parameter: 'groups_id', description: 'json с идентификаторами групп', in: 'query', required: false, deprecated: false, allowEmptyValue: true),
            new OAT\Parameter(name: 'contracts_id', parameter: 'contracts_id', description: 'json с идентификаторами контрактов', in: 'query', required: false, deprecated: false, allowEmptyValue: true),
            new OAT\Parameter(name: 'phones', parameter: 'phones', description: 'json с номерами телефонов', in: 'query', required: false, deprecated: false, allowEmptyValue: true),
        ],
    )]
    public function get(GetRequest $request){
       
        $user = $request->user();
       
        $sim = Sim::with(['Contract', 'GroupSim']);
        
        if($user->is_admin !== 1){
            $sim = $sim->current($user->id);

            if($request->groups_id){
                $request->groups_id = json_decode($request->groups_id, true);
            
                if(is_array($request->groups_id)) {
                    $sim = $sim->inGroups($request->groups_id);
                }
            }
        }
        else{
            if($request->contracts_id){
                $request->contracts_id = json_decode($request->contracts_id, true);
            
                if(is_array($request->contracts_id)) {
                    $sim = $sim->whereIn('contract_id', $request->contracts_id);
                }
            }
        }

        if($request->phones){
            $request->phones = json_decode($request->phones, true);
            
            if(is_array($request->phones)) {
                $sim = $sim->whereIn('phone', $request->phones);
            }
        }
        
        return SimResource::collection(
            $sim->paginate(perPage: env('PER_PAGE'), page: $request->page)
        );
    }
}