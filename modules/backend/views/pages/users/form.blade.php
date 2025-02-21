@extends('backend::layout.master')
@section('vendor-css')
@endsection
@section('content')
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-6">
                <div class="card-body pt-12">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-4" src="{{ asset('assets/img/avatars/nso.png') }}" height="120"
                                width="120" alt="User avatar">
                            <div class="user-info text-center">
                                <h5>{{ $user->username }}</h5>
                                <span class="badge bg-primary">LV: {{ $user->player->data['level'] ?? 1 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                        <div class="d-flex align-items-center me-5 gap-4">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="ti ti-checkbox ti-coins"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ number_format($user->balance) }} ₫</h5>
                                <span>Số dư</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="ti ti-briefcase ti-credit-card-refund"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ number_format($user->tongnap) }} ₫</h5>
                                <span>Tổng nạp</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-4 border-bottom mb-4">Chi tiết</h5>
                    <div class="info-container">
                        <ul class="list-unstyled mb-6">
                            @if ($user->player)
                                <li class="mb-2">
                                    <span class="h6">Tên nhân vật:</span>
                                    <a href="{{ route('admin.players.edit', $user->player->id) }}">
                                        <span class="badge bg-label-info">{{ $user->player->name }}</span>
                                    </a>
                                </li>

                                <li class="mb-2">
                                    <span class="h6">Giới tính:</span>
                                    <span>{{ $user->player->gender ? 'Nam' : 'Nữ' }}</span>
                                </li>

                                <li class="mb-2">
                                    <span class="h6">Phái:</span>
                                    <span>{{ $user->player->clazz->name }}</span>
                                </li>

                                <li class="mb-2">
                                    <span class="h6">Xu:</span>
                                    <span>{{ number_format($user->player->xu) }} xu</span>
                                </li>

                                <li class="mb-2">
                                    <span class="h6">Lượng:</span>
                                    <span>{{ number_format($user->luong) }} lượng</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Yên:</span>
                                    <span>{{ number_format($user->player->yen) }} yên</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Trạng thái:</span>
                                    @if ($user->status)
                                        <span class="badge bg-label-success">Hoạt động</span>
                                    @else
                                        <span class="badge bg-label-danger">Đã khoá</span>
                                    @endif
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Kích hoạt:</span>
                                    @if ($user->activated)
                                        <span class="badge bg-label-success">Đã kích hoạt</span>
                                    @else
                                        <span class="badge bg-label-danger">Chưa kích hoạt</span>
                                    @endif
                                </li>
                            @else
                                <li class="mb-2">
                                    <span class="h6">Chưa tạo nhân vật</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/ User Sidebar -->


        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <div class="nav-align-top mb-6">
                <ul class="nav nav-pills mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active waves-effect waves-light" role="tab"
                            data-bs-toggle="tab" data-bs-target="#navs-info" aria-controls="navs-info" aria-selected="true">
                            <i class="ti ti-user-check ti-sm me-1_5"></i> Thông tin
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link waves-effect waves-light" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-permisson" aria-controls="navs-permisson" aria-selected="false"
                            tabindex="-1">
                            <i class="menu-icon tf-icons ti ti-settings"></i> Quyền</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link waves-effect waves-light" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-balance" aria-controls="navs-balance" aria-selected="false"
                            tabindex="-1">
                            <i class="menu-icon tf-icons ti ti-coins"></i> Số dư</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-info" role="tabpanel">
                        <h5 class="card-header mb-6">Thay đổi thông tin tài khoản</h5>
                        <form action="{{ route('admin.users.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="mb-6">
                                <label class="form-label">Tên đăng nhập:</label>
                                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập..."
                                    value="{{ $user->username }}">
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label">Đặt mật khẩu mới:</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Mật khẩu mới..." autocomplete="off" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="form-label">Số điện thoại:</label>
                                <input name="phone" type="text" class="form-control" placeholder="Số điện thoại..."
                                    value="{{ $user->phone }}">
                            </div>
                            <div class="mb-6">
                                <label class="form-label">Trạng thái:</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input name="status" class="form-check-input" type="radio" value="1"
                                            id="status-active" {{ $user->status === 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status-active">Hoạt động</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="status" class="form-check-input" type="radio" value="0"
                                            id="status-blocked" {{ $user->status === 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status-blocked">Đã khoá</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="form-label">Kích hoạt:</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input name="activated" class="form-check-input" type="radio" value="1"
                                            id="user-active" {{ $user->activated === 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="user-active">Đã kích hoạt</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="activated" class="form-check-input" type="radio" value="0"
                                            id="user-unactive" {{ $user->activated === 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="user-unactive">Chưa kích hoạt</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Lưu
                            </button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="navs-permisson" role="tabpanel">
                        <p>
                            Chưa làm tới.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="navs-balance" role="tabpanel">
                        <h5 class="card-header mb-6">Thay đổi số dư</h5>
                        <form action="{{ route('admin.users.update-balance') }}" method="post" id="form-transaction">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <label class="form-label">Loại giao dịch:</label>
                            <div class="col mt-2 mb-6">
                                <div class="form-check form-check-inline">
                                    <input name="type" class="form-check-input" type="radio" value="credit"
                                        id="transtion-credit" checked>
                                    <label class="form-check-label" for="transtion-credit">Cộng tiền</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="type" class="form-check-input" type="radio" value="debit"
                                        id="transtion-debit">
                                    <label class="form-check-label" for="transtion-debit">Trừ tiền</label>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="amount">Số tiền:</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="ti ti-credit-card-refund"></i></span>
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="100,000">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="form-label">Nội dung:</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="ti ti-message-dots"></i>
                                    </span>
                                    <textarea name="description" class="form-control" placeholder="Nội dung giao dịch..."></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Thực hiện
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ User Content -->
    </div>
@endsection
@section('vendor-js')
    <script src="/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="/assets/vendor/libs/@form-validation/auto-focus.js"></script>
@endsection
@section('page-js')
    <script src="{{ asset('assets/js/pages-user.js') }}"></script>
@endsection
