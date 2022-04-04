(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/users"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/properties/index.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/properties/index.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _core_page_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../core/page-index */ "./resources/js/components/core/page-index.vue");

/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    PageIndex: _core_page_index__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/properties/index.vue?vue&type=template&id=6b3a7c41&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/properties/index.vue?vue&type=template&id=6b3a7c41& ***!
  \*******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "page-index",
    {
      attrs: { url: "/properties", prefix: "properties", name: "Properties" },
      scopedSlots: _vm._u([
        {
          key: "filters",
          fn: function(data) {
            return [
              _c("div", {}, [
                _c("div", { staticClass: "form-group mr-2" }, [
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: data.filters.confirmed,
                          expression: "data.filters.confirmed"
                        }
                      ],
                      staticClass: "custom-select",
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.$set(
                            data.filters,
                            "confirmed",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    [
                      _c("option", { domProps: { value: undefined } }, [
                        _vm._v("Choose Confirmed")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "confirmed" } }, [
                        _vm._v("Confirmed")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "null" } }, [
                        _vm._v("Pending")
                      ])
                    ]
                  )
                ])
              ])
            ]
          }
        },
        {
          key: "table-row",
          fn: function(data) {
            return [
              _c("td", [
                _c("span", { staticClass: "text-primary" }, [
                  _vm._v("#" + _vm._s(data.row.id))
                ])
              ]),
              _vm._v(" "),
              _c("td", [
                data.row.image
                  ? _c("div", {}, [
                      _c("img", {
                        staticClass: "img-fluid img-thumbnail",
                        attrs: {
                          src: data.row.image.small,
                          alt: "image",
                          width: "200"
                        }
                      })
                    ])
                  : _c("div", {}, [
                      _c("img", {
                        staticClass: "img-fluid img-thumbnail",
                        attrs: {
                          src: "img/no-image-available-icon.jpg",
                          alt: "image",
                          width: "200"
                        }
                      })
                    ])
              ]),
              _vm._v(" "),
              _c("td", [
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Name : ")
                  ]),
                  _vm._v(_vm._s(data.row.name))
                ]),
                _vm._v(" "),
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Stand Number : ")
                  ]),
                  _vm._v(_vm._s(data.row.stand_number))
                ]),
                _vm._v(" "),
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Type : ")
                  ]),
                  _vm._v(_vm._s(data.row.type))
                ])
              ]),
              _vm._v(" "),
              _c("td", [
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Gender : ")
                  ]),
                  _vm._v(_vm._s(data.row.gender))
                ]),
                _vm._v(" "),
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Owner Name : ")
                  ]),
                  _vm._v(_vm._s(data.row.owner.user.name))
                ]),
                _vm._v(" "),
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Owner Email : ")
                  ]),
                  _vm._v(_vm._s(data.row.owner.user.email))
                ])
              ]),
              _vm._v(" "),
              _c("td", [
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Created  : ")
                  ]),
                  _vm._v(_vm._s(data.row.created_at))
                ]),
                _vm._v(" "),
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Termination : ")
                  ]),
                  _vm._v(_vm._s(data.row.termination_date))
                ]),
                _vm._v(" "),
                _c("div", {}, [
                  _c("span", { staticClass: "text-muted" }, [
                    _vm._v("Confirmed : ")
                  ]),
                  _vm._v(
                    _vm._s(
                      data.row.confirmed ? data.row.confirmed : "Not Confirmed"
                    )
                  )
                ])
              ]),
              _vm._v(" "),
              _c(
                "td",
                [
                  _c(
                    "router-link",
                    {
                      staticClass: "action-icon text-primary",
                      attrs: { to: "/properties/" + data.row.id + "/view" }
                    },
                    [_c("i", { staticClass: "mdi mdi-eye mdi-24px" })]
                  )
                ],
                1
              )
            ]
          }
        }
      ])
    },
    [
      _c(
        "template",
        { slot: "actions" },
        [
          _c(
            "router-link",
            {
              staticClass: "btn btn-primary ml-2",
              attrs: { to: "/properties/create" }
            },
            [_vm._v("New Property")]
          )
        ],
        1
      ),
      _vm._v(" "),
      _vm._v(" "),
      _c("template", { slot: "sort-fields" }, [
        _c("option", { attrs: { value: "created_at" } }, [_vm._v("Created")]),
        _vm._v(" "),
        _c("option", { attrs: { value: "updated_at" } }, [_vm._v("Updated")])
      ]),
      _vm._v(" "),
      _c("template", { slot: "table-header" }, [
        _c("th"),
        _vm._v(" "),
        _c("th"),
        _vm._v(" "),
        _c("th", [_vm._v("Info")]),
        _vm._v(" "),
        _c("th", [_vm._v("Info")]),
        _vm._v(" "),
        _c("th", [_vm._v("Date")]),
        _vm._v(" "),
        _c("th", { staticClass: "text-center" })
      ])
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/properties/index.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/properties/index.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_6b3a7c41___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=6b3a7c41& */ "./resources/js/components/properties/index.vue?vue&type=template&id=6b3a7c41&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/js/components/properties/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_6b3a7c41___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_6b3a7c41___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/properties/index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/properties/index.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/properties/index.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/properties/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/properties/index.vue?vue&type=template&id=6b3a7c41&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/properties/index.vue?vue&type=template&id=6b3a7c41& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_6b3a7c41___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=template&id=6b3a7c41& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/properties/index.vue?vue&type=template&id=6b3a7c41&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_6b3a7c41___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_6b3a7c41___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);