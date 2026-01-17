<?php

namespace App\Http;

use OpenApi\Attributes as OAT;
use App\Http\Response;

#[OAT\Info(
    version:"1",
    title: "Sim",
    description: "Сервис для сим-карт",
)]
abstract class Controller
{
    use Response;
}
