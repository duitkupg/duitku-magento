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
                 type: 'duitku_bncepay',
                 component: 'Duitku_BNC/js/view/payment/method-renderer/duitku-epay-method'
             }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);