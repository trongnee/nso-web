@extends('backend::layout.master')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}">
@endsection
@section('content')
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-6 sticky-top" style="top: 90px">
                <div class="card-body pt-12">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center gap-4">
                            <div class="d-flex align-items-center">
                                <img class="avatar-profile"
                                    src="{{ asset('assets/img/small/Small' . $player->headPart->part[0]['id'] . '.png') }}"
                                    height="120" width="120" alt="User avatar">
                            </div>
                            <div class="user-info">
                                <h5 class="mb-0">{{ $player->name }}</h5>
                                <span class="badge bg-primary">LV: {{ $player->data['level'] ?? 1 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pb-4 border-bottom mb-4"></div>
                    <div class="info-container">
                        <ul class="list-unstyled mb-6">
                            <li class="mb-2">
                                <span class="h6">Tài khoản:</span>
                                <a href="{{ route('admin.users.edit', $player->user->id) }}">
                                    <span class="badge bg-label-info">{{ $player->user->username }}</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Giới tính:</span>
                                <span>{{ $player->gender ? 'Nam' : 'Nữ' }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Phái:</span>
                                <span>{{ $player->clazz->name }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Tấn công:</span>
                                <span>{{ short_number($player->data['damage'] ?? 0) }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Kinh nghiệm:</span>
                                <span>{{ short_number($player->data['exp'] ?? 0) }} XP</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Xu:</span>
                                <span>{{ short_number($player->xu) }} xu</span>
                            </li>

                            <li class="mb-2">
                                <span class="h6">Lượng:</span>
                                <span>{{ short_number($player->user->luong) }} lượng</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Yên:</span>
                                <span>{{ short_number($player->yen) }} yên</span>
                            </li>
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
                            data-bs-toggle="tab" data-bs-target="#navs-bag" aria-controls="navs-bag" aria-selected="false"
                            tabindex="-1">
                            <i class="menu-icon tf-icons ti ti-backpack"></i> Hành trang</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link waves-effect waves-light" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-box" aria-controls="navs-box" aria-selected="false" tabindex="-1">
                            <i class="menu-icon tf-icons ti ti-lock-bolt"></i> Rương đồ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link waves-effect waves-light" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-equid" aria-controls="navs-equid" aria-selected="false" tabindex="-1">
                            <i class="menu-icon tf-icons ti ti-swords"></i> Đang mặc</button>
                    </li>
                </ul>
                <div class="">
                    <div class="tab-pane card fade show active" id="navs-bag" role="tabpanel">
                        <h5 class="card-header">
                            <span class="d-block">Danh sách vật phẩm</span>
                            <small class="emp_post text-truncate text-muted">
                                Số vật phẩm trong hành trang
                                <span class="badge bg-label-primary">{{ count($player->bag) }} /
                                    {{ $player->numberCellBag }}</span>
                            </small>
                        </h5>
                        <div class="card-datatable table-responsive">
                            <table class="dt-fixedheader table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vật phẩm</th>
                                        <th>Mô tả</th>
                                        <th>Số lượng</th>
                                        <th>HẠN sử dụng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-box" role="tabpanel">
                        <h5 class="card-header mb-6">Rương đồ</h5>

                    </div>
                    <div class="tab-pane fade" id="navs-equid" role="tabpanel">
                        <h5 class="card-header mb-6">Đang mặc</h5>

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
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        const bagItems = `{!! htmlspecialchars_decode(json_encode($player->bag, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !!}`;
    </script>
    <script src="{{ asset('assets/js/page-player.js') }}"></script>
@endsection
