<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Http\Resources\AbilitiesResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AbilityController extends Controller
{
    public function index(): ResourceCollection
    {
        return AbilitiesResource::collection(
            Ability::get()
        );
    }
}
