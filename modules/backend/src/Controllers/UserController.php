<?php

namespace NSO\Backend\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use NSO\Backend\Events\Transaction;
use NSO\Backend\Facades\Theme;
use NSO\Backend\Requests\UpdateBalanceRequest;
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
        if (empty($user)) {
            abort(404);
        }
        return view('backend::pages.users.form', compact('user'));
    }

    public function updateBalance(UpdateBalanceRequest $request)
    {
        $this->service->updateBalance($request->validated());
        return redirect()->back()->with('message', 'Giao dịch thành công!');
    }

    public function updateUser(Request $request)
    {
        $this->service->updateUser($request->input());
        return redirect()->back()->with('message', 'Đã cập nhật thông tin!');
    }
}
