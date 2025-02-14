"use strict";
window.config = {
    colors: {
        primary: "#7367f0",
        secondary: "#808390",
        success: "#28c76f",
        info: "#00bad1",
        warning: "#ff9f43",
        danger: "#FF4C51",
        dark: "#4b4b4b",
        black: "#000",
        white: "#fff",
        cardColor: "#fff",
        bodyBg: "#f8f7fa",
        bodyColor: "#6d6b77",
        headingColor: "#444050",
        textMuted: "#acaab1",
        borderColor: "#e6e6e8",
    },
    colors_label: {
        primary: "#7367f029",
        secondary: "#a8aaae29",
        success: "#28c76f29",
        info: "#00cfe829",
        warning: "#ff9f4329",
        danger: "#ea545529",
        dark: "#4b4b4b29",
    },
    colors_dark: {
        cardColor: "#2f3349",
        bodyBg: "#25293c",
        bodyColor: "#b2b1cb",
        headingColor: "#cfcce4",
        textMuted: "#8285a0",
        borderColor: "#565b79",
    },
    enableMenuLocalStorage: !0,
    toastr: {
        autoDismiss: 0,
        positionClass: "toast-top-center",
        timeOut: 2000,
        closeOnHover: false,
    },
    csrfToken: document.querySelector('meta[name="csrf-token"]').content,
};
window.assetsPath = document.documentElement.getAttribute("data-assets-path");
window.templateName = document.documentElement.getAttribute("data-template");
window.rtlSupport = !0;

TemplateCustomizer.LANGUAGES.vi = {
    panel_header: "Tuỳ chỉnh giao diện",
    panel_sub_header: "Chỉnh sửa giao diện và xem ngay",
    theming_header: "Chế độ",
    color_label: "Màu chủ đạo",
    theme_label: "Giao diện",
    skin_label: "Skins",
    semiDark_label: "Nửa tối",
    layout_header: "Bố cục",
    layout_label: "Menu (điều hướng)",
    layout_header_label: "Các loại header",
    content_label: "Nội dung",
    layout_navbar_label: "Kiểu thanh điều hướng",
    direction_label: "Hướng",
};
TemplateCustomizer.STYLES = [
    {
        name: "light",
        title: "Sáng",
    },
    {
        name: "dark",
        title: "Tối",
    },
    {
        name: "system",
        title: "Hệ thống",
    },
];
TemplateCustomizer.THEMES = [
    {
        name: "theme-default",
        title: "Mặc định",
    },
    {
        name: "theme-bordered",
        title: "Có viền",
    },
    {
        name: "theme-semi-dark",
        title: "Nửa tối",
    },
];
TemplateCustomizer.NAVBAR_OPTIONS = [
    {
        name: "sticky",
        title: "Bám theo",
    },
    {
        name: "static",
        title: "Tĩnh",
    },
    {
        name: "hidden",
        title: "Ẩn",
    },
];
TemplateCustomizer.LAYOUTS = [
    {
        name: "expanded",
        title: "Mở rộng",
    },
    {
        name: "collapsed",
        title: "Thu gọn",
    },
];
TemplateCustomizer.DIRECTIONS = [
    {
        "name": "ltr",
        "title": "Trái sang Phải (Vi)"
    },
    {
        "name": "rtl",
        "title": "Phải sang Trái (Ar)"
    }
];
TemplateCustomizer.CONTENT = [
    {
        "name": "compact",
        "title": "Hẹp"
    },
    {
        "name": "wide",
        "title": "Rộng"
    }
];
"undefined" != typeof TemplateCustomizer &&
    (window.templateCustomizer = new TemplateCustomizer({
        cssPath: assetsPath + "vendor/css" + (rtlSupport ? "/rtl" : "") + "/",
        themesPath:
            assetsPath + "vendor/css" + (rtlSupport ? "/rtl" : "") + "/",
        displayCustomizer: !0,
        lang:
            localStorage.getItem(
                "templateCustomizer-" + templateName + "--Lang"
            ) || "vi",
        controls: [
            "rtl",
            "style",
            "headerType",
            "contentLayout",
            "layoutCollapsed",
            "layoutNavbarOptions",
            "themes",
        ],
    }));
