"use strict";
(function () {
  const tableElement = $("#table");
  const filterForm = $("#formFilter");

  const columns = [
    {
      data: "user",
      orderable: false,
      searchable: false,
      render: (value) => {
        const username = value.newplay ? "Nick chơi mới" : value.username;
        return `<a href="/admin/tai-khoan/${value.id}"><span>${username}</span></a>`;
      },
    },
    {
      data: "name",
      title: "Tên nhân vật",
      orderable: false,
      searchable: false,
    },
    {
      data: "clazz",
      title: "Phái",
      orderable: false,
      searchable: false,
      render: (value) => value.name,
    },
    {
      data: "data",
      title: "Level",
      orderable: false,
      searchable: false,
      render: (value) => value.level ?? 1,
    },
    {
      data: "xu",
      title: "Xu",
      render: (value) => {
        return `<span class="text-heading">${numeral(value).format(
          "0.[000]a"
        )}</span>`;
      },
    },
    {
      data: "data",
      title: "Lượng",
      orderable: false,
      searchable: false,
      render: (value) => {
        return `<span class="text-heading">${numeral(value.luong).format(
          "0.[000]a"
        )}</span>`;
      },
    },
    {
      data: "yen",
      title: "Yên",
      render: (value) => {
        return `<span class="text-heading">${numeral(value).format(
          "0.[000]a"
        )}</span>`;
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
      orderable: false,
      searchable: false,
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
                        href="/admin/nhan-vat/${id}"
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
    title: "Danh sách nhân vật",
    columns,
    form: filterForm,
    url: tableElement.data("url"),
    withFixedHeader: true,
    withExport: true,
    checkbox: true,
    orderIndex: 0,
  });

  table.render();
})();
