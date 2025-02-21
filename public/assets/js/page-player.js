"use strict";
(async function () {
  const items = await $.ajax({
    url: "/admin/vat-pham",
  });

  let table = $(".dt-fixedheader");
  if (!table.length) return;
  table = table.DataTable({
    data: JSON.parse(bagItems),
    columns: [
      { data: "id" },
      {
        data: "id",
        width: 150,
        render: (data) => {
          const item = items[data];
          const image = `<div class="nso-item">
                          <img src="/assets/img/2/Small${item.icon}.png" alt="Avatar" class="mw-100 m-auto">
                        </div>`;
          return `<div class="d-flex align-items-center">
                  ${image} <h6 class="mb-0">${item.name}</h6>
          </div>`;
        },
      },
      {
        width: 150,
        data: "id",
        orderable: false,
        searchable: false,
        render: (data) => items[data].description,
      },
      {
        data: "id",
        render: (_, __, row) => {
          return row.quantity ?? 1;
        },
      },
      {
        data: "expire",
        orderable: false,
        searchable: false,
        render: (data) => {
          if (data === -1) {
            return "Vĩnh viễn";
          }
          const date = new Date(data);
          const day = String(date.getDate()).padStart(2, "0");
          const month = String(date.getMonth() + 1).padStart(2, "0"); // Tháng bắt đầu từ 0
          const year = date.getFullYear();
          const hours = String(date.getHours()).padStart(2, "0");
          const minutes = String(date.getMinutes()).padStart(2, "0");

          return `${day}/${month}/${year} ${hours}h${minutes}'`;
        },
      },
      { data: "" },
    ],
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        searchable: false,
        responsivePriority: 3,
        checkboxes: true,
        checkboxes: {
          selectAllRender: '<input type="checkbox" class="form-check-input">',
        },
        render: function (id) {
          return `<input type="checkbox" class="dt-checkboxes form-check-input" value="${id}">`;
        },
      },
      {
        targets: -1,
        title: "Thao tác",
        width: 100,
        orderable: false,
        render: function (e, t, a, s) {
          return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="ti ti-pencil ti-md"></i></a>';
        },
      },
    ],
    order: [[2, "desc"]],
    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength: 25,
    lengthMenu: [25, 50, 100],
    language: {
      search: "",
      searchPlaceholder: "Tìm kiếm...",
      lengthMenu: "Hiển thị_MENU_bản ghi mỗi trang",
      info: "Hiển thị từ _START_ - _END_ trên tổng _TOTAL_ mục",
      infoEmpty: "Hiển thị từ _START_ - _END_ trên tổng _TOTAL_ mục",
      processing: "Đang tải dữ liệu, vui lòng chờ...",
      emptyTable: "Không có bản ghi nào!",
      infoEmpty: "Không có bản ghi nào!",
      paginate: {
        first: "Đầu",
        last: "Cuối",
        next: '<i class="ti ti-chevron-right ti-sm"></i>',
        previous: '<i class="ti ti-chevron-left ti-sm"></i>',
      },
    },
  });
  let e;
  window.Helpers.isNavbarFixed()
    ? ((e = $("#layout-navbar").outerHeight() + 18),
      new $.fn.dataTable.FixedHeader(table).headerOffset(e))
    : new $.fn.dataTable.FixedHeader(table);
})();
