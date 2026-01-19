/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (Component, rendererList) {
        'use strict';
        rendererList.push(
            {
                type: 'duitku_atome',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_bcaklikpay',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_bnc',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_briva',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_creditcard',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_dana',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_indodana',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_indomaret',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_jeniuspay',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_linkajaapps',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_linkajaappsfixed',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_linkajaqris',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_mg',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_nobuqris',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_nusapayqris',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_tokopediacardpayment',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_tokopediaewallet',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_tokopediaothers',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_ovo',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_pospay',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_ritel',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_shopeepayapps',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_danaqris',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_gudangvoucherqris',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_shopeepayqris',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vaatmbersama',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vabca',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vabni',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vabsi',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vacimbniaga',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vadanamon',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vamandiri',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vamaybank',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vapermata',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            },
            {
                type: 'duitku_vasampoerna',
                component: 'Duitku_V2/js/view/payment/method-renderer/duitku-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);