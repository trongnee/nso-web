"use strict";
(function () {
  const tableElement = $("#table");
  const filterForm = $("#formFilter");

  const columns = [
    {
      data: "username",
    },
    {
      data: "balance",
      render: (value) =>
        `<span class="text-heading">
                        ${numeral(value).format("0.[000]a")}
                    </span>`,
    },
    {
      data: "activated",
      title: "Kích hoạt",
      orderable: false,
      searchable: false,
      render: (value) => {
        return value
          ? `<span class="badge bg-label-success">Đã kích hoạt</span>`
          : `<span class="badge bg-label-danger">Chưa kích hoạt</span>`;
      },
    },
    {
      data: "status",
      title: "Trạng thái",
      orderable: false,
      searchable: false,
      render: (value) => {
        return value
          ? `<span class="badge bg-primary">Bình thường</span>`
          : `<span class="badge bg-warning">Đã khoá</span>`;
      },
    },
    {
      data: "online",
      title: "Online",
      orderable: false,
      searchable: false,
      render: (value) => {
        return value
          ? `<span class="badge bg-label-success">Trực tuyến</span>`
          : `<span class="badge bg-label-danger">Ngoại tuyến</span>`;
      },
    },
    {
      data: "id",
      title: "Thao tác",
      render: function (id) {
        return `<div class="d-flex align-items-center">
                    <a
                        href="javascript:;"
                        class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill delete-record"
                        data-bs-toggle="tooltip"
                        aria-label="Xoá tài khoản"
                        data-bs-original-title="Xoá tài khoản"
                    >
                        <i class="ti ti-trash ti-md"></i>
                    </a>
                    <a
                        href="/admin/tai-khoan/${id}"
                        class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill"
                        data-bs-toggle="tooltip"
                        aria-label="Sửa tài khoản"
                        data-bs-original-title="Sửa tài khoản"
                    >
                        <i class="ti ti-pencil ti-md"></i>
                    </a>
                </div>`;
      },
    },
  ];

  const table = new Table({
    el: tableElement,
    title: "Danh sách tài khoản",
    columns,
    form: filterForm,
    url: tableElement.data("url"),
    withFixedHeader: true,
    withExport: true,
    checkbox: true,
  });

  table.render();
})();
