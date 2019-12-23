! function (e) {
    var t = {};

    function i(n) {
        if (t[n]) return t[n].exports;
        var o = t[n] = {
            i: n,
            l: !1,
            exports: {}
        };
        return e[n].call(o.exports, o, o.exports, i), o.l = !0, o.exports
    }
    i.m = e, i.c = t, i.d = function (e, t, n) {
        i.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: n
        })
    }, i.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, i.t = function (e, t) {
        if (1 & t && (e = i(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (i.r(n), Object.defineProperty(n, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var o in e) i.d(n, o, function (t) {
                return e[t]
            }.bind(null, o));
        return n
    }, i.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return i.d(t, "a", t), t
    }, i.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, i.p = "/", i(i.s = 103)
}({
    103: function (e, t, i) {
        e.exports = i(104)
    },
    104: function (e, t) {
        function i(e, t) {
            for (var i = 0; i < t.length; i++) {
                var n = t[i];
                n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
        }
        var n = function () {
            function e() {
                ! function (e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e)
            }
            var t, n, o;
            return t = e, (n = [{
                key: "initCkEditor",
                value: function (e, t) {
                    var i = {
                            filebrowserImageBrowseUrl: RV_MEDIA_URL.base + "?media-action=select-files&method=ckeditor&type=image",
                            filebrowserImageUploadUrl: RV_MEDIA_URL.media_upload_from_editor + "?method=ckeditor&type=image&_token=" + $('meta[name="csrf-token"]').attr("content"),
                            filebrowserWindowWidth: "1200",
                            filebrowserWindowHeight: "750",
                            height: 90 * $("#" + e).prop("rows"),
                            allowedContent: !0
                        },
                        n = {};
                    $.extend(n, i, t), CKEDITOR.replace(e, n)
                }
            }, {
                key: "initTinyMce",
                value: function (e) {
                    tinymce.init({
                        menubar: !0,
                        selector: "#" + e,
                        skin: "voyager",
                        min_height: 75 * $("#" + e).prop("rows"),
                        resize: "vertical",
                        plugins: "code autolink advlist visualchars link image media table charmap hr pagebreak nonbreaking anchor insertdatetime lists textcolor wordcount imagetools  contextmenu  visualblocks",
                        extended_valid_elements: "input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]",
                        file_browser_callback: function (e, t, i) {
                            "image" === i && $("#upload_file").trigger("click")
                        },
                        toolbar: "formatselect | bold italic strikethrough forecolor backcolor | link image table | alignleft aligncenter alignright alignjustify  | numlist bullist indent  |  visualblocks code",
                        convert_urls: !1,
                        image_caption: !0,
                        image_advtab: !0,
                        image_title: !0,
                        entity_encoding: "raw",
                        content_style: ".mce-content-body {padding: 10px}",
                        contextmenu: "link image inserttable | cell row column deletetable",
                        bootstrapConfig: {
                            imagesPath: "/uploads"
                        }
                    })
                }
            }, {
                key: "initEditor",
                value: function (e, t, i) {
                    var n = this;
                    if (e.length) switch (i) {
                        case "ckeditor":
                            $.each(e, function (e, i) {
                                n.initCkEditor($(i).prop("id"), t)
                            });
                            break;
                        case "tinymce":
                            $.each(e, function (e, t) {
                                n.initTinyMce($(t).prop("id"))
                            })
                    }
                }
            }, {
                key: "init",
                value: function () {
                    var e = $(".editor-ckeditor"),
                        t = $(".editor-tinymce");
                    e.length > 0 && this.initEditor(e, {}, "ckeditor"), t.length > 0 && this.initEditor(t, {}, "tinymce");
                    var i = this;
                    $(document).on("click", ".show-hide-editor-btn", function (e) {
                        e.preventDefault();
                        var t = $(e.currentTarget),
                            n = $("#" + t.data("result"));
                        n.hasClass("editor-ckeditor") ? CKEDITOR.instances[t.data("result")] && void 0 !== CKEDITOR.instances[t.data("result")] ? (CKEDITOR.instances[t.data("result")].updateElement(), CKEDITOR.instances[t.data("result")].destroy(), $(".editor-action-item").not(".action-show-hide-editor").hide()) : (i.initCkEditor(t.data("result"), {}, "ckeditor"), $(".editor-action-item").not(".action-show-hide-editor").show()) : n.hasClass("editor-tinymce") && tinymce.execCommand("mceToggleEditor", !1, t.data("result"))
                    })
                }
            }]) && i(t.prototype, n), o && i(t, o), e
        }();
        $(document).ready(function () {
            (new n).init()
        })
    }
});
