<?php

namespace NSO\Backend\Controllers;

use Illuminate\Http\Request;
use NSO\Backend\Facades\Theme;
use NSO\Backend\Services\UserService;

class UserController
{
    public function __construct(
        protected UserService $service
    ) {}

    public function users()
    {
        return view('backend::pages.users.index');
    }

    public function search(Request $request)
    {
        $pagination = $this->service->search($request->input());
        return api_datatable($pagination);
    }

    public function edit($id)
    {
        Theme::activeRouteMenu('admin.users');

        $user = $this->service->show($id);
        return view('backend::pages.users.form', compact('user'));
    }
}
