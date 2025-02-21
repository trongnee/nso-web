"use strict";
(function () {
  const amountInput = $("#amount");
  amountInput.on("input", function () {
    const input = $(this);
    const value = input.val().replace(/\D/g, "");
    const formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    input.val(formatted);
  });

  const formTransaction = document.querySelector("#form-transaction");
  document.addEventListener("DOMContentLoaded", function (e) {
    if (!formTransaction) return;
    const formValidate = FormValidation.formValidation(formTransaction, {
      fields: {
        amount: {
          validators: {
            notEmpty: { message: "Số tiền không được bỏ trống!" },
          },
        },
        description: {
          validators: {
            notEmpty: { message: "Nội dung giao dịch không được bỏ trống!" },
          },
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: "",
          rowSelector: ".mb-6",
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus(),
      },
      init: (e) => {
        e.on("plugins.message.placed", function (e) {
          if (e.element.parentElement.classList.contains("input-group")) {
            e.element.parentElement.insertAdjacentElement(
              "afterend",
              e.messageElement
            );
          }
        });
      },
    });
    formValidate.on("core.form.valid", function () {
      amountInput.val(amountInput.val().replace(/\D/g, ""));
      formTransaction.submit();
    });
  });
})();
