//**
// * Copyright © Magento, Inc. All rights reserved.
// *
define(
    [
    'Magento_Ui/js/form/element/abstract',
    'mageUtils',
    'jquery',
    'jquery/colorpicker/js/colorpicker'
    ],
    function (Element, utils, $) {
    'use strict';
    return Element.extend(
        {
        defaults: {
            visible: true,
            label: '',
            error: '',
            uid: utils.uniqueid(),
            disabled: false,
            links: {
                value: '${ $.provider }:${ $.dataScope }'
            }
        },

        initialize: function (element) {
            this._super();
        },

        initColorPickerCallback: function (element) {
            var self = this;
            $(element).css('background-color','#'+$(element)[0].value);
            $(element).ColorPicker(
                {
                onSubmit: function (hsb, hex, rgb, el) {
                    self.value('#'+hex);
                    $(el).css('background-color','#'+hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                     $(this).ColorPickerSetColor(this.value);
                }
                ,
                onLoad: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
                }
            ).bind(
                'keyup',
                function () {
                    $(this).ColorPickerSetColor(this.value);
                    }
            );
        }
        }
    );
    }
);