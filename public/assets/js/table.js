"use strict";
class Table {
  title;
  table;
  withFixedHeader;
  tableElement;
  modal;
  url;
  method;
  form;
  checkbox;
  orderIndex;
  checkbox_key = "id";
  columns;
  columnDefs = [];
  constructor({
    el,
    title,
    withFixedHeader,
    withExport,
    url,
    method,
    form,
    columns,
    checkbox,
    orderIndex = 1,
  }) {
    this.tableElement = el;
    this.title = title;
    this.withFixedHeader = withFixedHeader;
    this.withExport = withExport;
    this.url = url;
    this.method = method;
    this.form = form;
    this.columns = columns;
    this.checkbox = checkbox;
    this.orderIndex = orderIndex;
  }
  setTableTitle() {
    $("div.head-label").html(`<h5 class="card-title mb-0">${this.title}</h5>`);
  }
  setFixedHeader() {
    const navFixed = window.Helpers.isNavbarFixed();
    if (navFixed) {
      const navMarginTop = 16;
      const navbarHeight = $("#layout-navbar").outerHeight() + navMarginTop;
      new $.fn.dataTable.FixedHeader(this.tableElement).headerOffset(
        navbarHeight
      );
    } else {
      new $.fn.dataTable.FixedHeader(this.tableElement);
    }
  }
  buttons() {
    const buttons = [];
    if (this.withExport) {
      buttons.push({
        extend: "collection",
        className:
          "btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light border-none",
        text: '<i class="ti ti-file-export ti-xs me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
        buttons: [
          {
            extend: "print",
            text: '<i class="ti ti-printer me-1" ></i>Print',
            className: "dropdown-item",
          },
          {
            extend: "csv",
            text: '<i class="ti ti-file-text me-1" ></i>Csv',
            className: "dropdown-item",
          },
          {
            extend: "excel",
            text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
            className: "dropdown-item",
          },
          {
            extend: "pdf",
            text: '<i class="ti ti-file-description me-1"></i>Pdf',
            className: "dropdown-item",
          },
          {
            extend: "copy",
            text: '<i class="ti ti-copy me-1" ></i>Copy',
            className: "dropdown-item",
          },
        ],
      });
    }
    if (this.form) {
      buttons.push({
        text: '<i class="ti ti-filter me-sm-1"></i><span class="d-none d-sm-inline-block">Bộ lọc</span>',
        className: "create-new btn btn-primary waves-effect waves-light",
        action: () => this.modal.modal("show"),
      });
    }
    return buttons;
  }
  handleAjaxData(data) {
    let filterData;
    if (this.form) {
      filterData = this.form.formData();
    }
    return {
      ...data,
      _token: window.config.csrfToken,
      page: Math.floor(data.start / data.length) + 1,
      perPage: data.length,
      ...filterData,
    };
  }
  language() {
    return {
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
    };
  }
  loadCheckbox() {
    this.tableElement.find("thead tr").prepend("<th></th>");
    this.columns = [
      {
        data: this.checkbox_key,
      },
      ...this.columns,
    ];
    this.columnDefs.push({
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
    });
  }
  renderTable() {
    this.table = this.tableElement.DataTable({
      serverSide: true,
      processing: true,
      searchable: false,
      ajax: {
        url: this.url,
        type: this.method ?? "POST",
        data: (data) => this.handleAjaxData(data),
      },
      columns: this.columns,
      columnDefs: this.columnDefs,
      order: [[this.orderIndex, "asc"]],
      displayLength: 10,
      lengthMenu: [10, 25, 50, 100],
      language: this.language(),
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-6 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0">>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      buttons: this.buttons(),
      initComplete: function (t, e) {
        $(".card-header").after('<hr class="my-0">');
      },
    });
  }
  handleEventSearch() {
    this.form.on("submit", (e) => {
      e.preventDefault();
      this.table.ajax.reload();
      this.modal.modal("hide");
    });
    this.form.on("reset", () => {
      setTimeout(() => {
        this.table.ajax.reload();
        this.modal.modal("hide");
      }, 100);
    });
  }
  render() {
    if (!this.tableElement) return;
    this.checkbox && this.loadCheckbox();
    if (this.form) {
      this.modal = $(this.form).closest(".modal");
    }
    this.renderTable();
    this.withFixedHeader && this.setFixedHeader();
    this.form && this.handleEventSearch();
    this.setTableTitle();
  }
}
