"use strict";
const formAuthentication = document.querySelector("#formAuthentication");
document.addEventListener("DOMContentLoaded", function (e) {
    var t;
    formAuthentication &&
        FormValidation.formValidation(formAuthentication, {
            fields: {
                username: {
                    validators: {
                        notEmpty: { message: "Vui lòng nhập tên tài khoản" },
                        stringLength: {
                            min: 4,
                            message: "Tên tài khoản tối thiểu 4 ký tự",
                        },
                        regexp: {
                            regexp: /^[a-z0-9]+$/,
                            message: "Tên tài khoản chỉ cho phép a-z và 0-9",
                        },
                    },
                },
                password: {
                    validators: {
                        notEmpty: { message: "Vui lòng nhập mật khẩu" },
                        stringLength: {
                            min: 6,
                            message: "Mật khẩu tối thiểu 6 ký tự",
                        },
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
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus(),
            },
            init: (e) => {
                e.on("plugins.message.placed", function (e) {
                    e.element.parentElement.classList.contains("input-group") &&
                        e.element.parentElement.insertAdjacentElement(
                            "afterend",
                            e.messageElement
                        );
                });
            },
        });
});
