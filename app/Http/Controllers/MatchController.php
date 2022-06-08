<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\MatchServiceInterface;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    protected $matchService;

    public function __construct(MatchServiceInterface $matchService)
    {
        $this->matchService = $matchService;
    }

    public function getPropertyMatches($propertyId)
    {
        return $this->matchService->getPropertyMatches($propertyId);
    }
}
