@extends('backend::layout.master')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="table" class="table table-sm" data-url="{{ route('admin.users.search') }}">
                <thead>
                    <tr>
                        <th class="w-px-200">Tên tài khoản</th>
                        <th>Số dư</th>
                        <th>Kích hoạt</th>
                        <th>Trạng thái</th>
                        <th>Online</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-filter-form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="address-title mb-2">Tìm kiếm nâng cao</h4>
                        <p class="address-subtitle">Nhập các điều kiện để lấy ra bản ghi</p>
                    </div>
                    <form id="formFilter" class="row g-6" onsubmit="return false">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="username">Tên tài khoản</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="huysieunhan" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="player">Tên trong game</label>
                            <input type="text" id="player" name="player" class="form-control"
                                placeholder="huysieunhan" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                placeholder="0343456789" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="activated">Kích hoạt</label>
                            <select name="activated" id="activated" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="1">Đã kích hoạt</option>
                                <option value="0">Chưa kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="1">Bình thường</option>
                                <option value="0">Đã khoá</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="online">Online</label>
                            <select name="online" id="online" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="1">Trực tuyến</option>
                                <option value="0">Ngoại tuyến</option>
                            </select>
                        </div>
                        <div class="col-12 text-center">
                            <button type="reset" class="btn btn-label-secondary">
                                Bỏ lọc
                            </button>
                            <button type="submit" class="btn btn-primary me-3">
                                Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('vendor-js')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/numeral/numeral.js') }}"></script>
@endsection
@section('page-js')
    <script src="{{ asset('assets/js/table.js') }}"></script>
    <script src="{{ asset('assets/js/page-users.js') }}"></script>
@endsection
