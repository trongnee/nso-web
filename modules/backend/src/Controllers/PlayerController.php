<?php

namespace NSO\Backend\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use NSO\Backend\Facades\Theme;
use NSO\Backend\Services\PlayerService;
use NSO\Models\Item;

class PlayerController
{
    public function __construct(
        protected PlayerService $service
    ) {}

    public function players()
    {
        return view('backend::pages.players.index');
    }

    public function search(Request $request)
    {
        $pagination = $this->service->search($request->input());
        return api_datatable($pagination);
    }

    public function edit($id)
    {
        Theme::activeRouteMenu('admin.players');
        $player = $this->service->show($id);
        if (empty($player)) {
            abort(404);
        }
        // return $player->headPart;
        return view('backend::pages.players.form', compact('player'));
    }
}
