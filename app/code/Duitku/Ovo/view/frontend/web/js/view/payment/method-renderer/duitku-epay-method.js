/*browser:true*/
/*global define*/
define(
	[
		'ko',
		'jquery',
		'Magento_Checkout/js/view/payment/default',
		'Magento_Ui/js/model/messageList',
		'mage/translate',
		'Magento_Checkout/js/model/full-screen-loader'
	],
	function(ko, $, Component, globalMessageList, $t, fullScreenLoader) {
		'use strict';

		return Component.extend({
				initialize: function() {
					this._super().initChildren();
					this.loadEPayPaymentWindowJs();
				},
				defaults: {
					template: 'Duitku_Ovo/payment/epay-form'
				},
				redirectAfterPlaceOrder: false,
				getDuitkuEpayTitle: function () {
					return window.checkoutConfig.payment.duitku_ovoepay.paymentTitle;
				},
				getDuitkuEpayLogo: function () {
					return window.checkoutConfig.payment.duitku_ovoepay.paymentLogoSrc;
				},
				getDuitkuEpayPaymentLogoSrc: function () {
					return window.checkoutConfig.payment.duitku_ovoepay.paymentTypeLogoSrc;
				},
				afterPlaceOrder: function () {
					fullScreenLoader.startLoader();
					this.getPaymentWindow();
				},
				getPaymentWindow: function () {
					var self = this;
					var url = window.checkoutConfig.payment.duitku_ovoepay.checkoutUrl;
				           
					$.get(url).done(function (response) {
						
							response = JSON.parse(response);
							var Url = response.url;
							$.mage.redirect(Url);
							if(!response) {
								self.showError($t("Error opening payment window"));
								$.mage.redirect(window.checkoutConfig.payment.duitku_ovoepay.cancelUrl);
							}
							self.openPaymentWindow(response);                             
						}).fail(function(error) {
							self.showError($t("Error opening payment window") + ': ' + error.statusText);
							$.mage.redirect(window.checkoutConfig.payment.duitku_ovoepay.cancelUrl);
						});
				},
				openPaymentWindow: function(requestString) {
					var onclose = function() {
						var cancelUrl = window.checkoutConfig.payment.duitku_ovoepay.cancelUrl;
						$.mage.redirect(cancelUrl);
					}
					var paymentwindow = new PaymentWindow(requestString);
					if(window.checkoutConfig.payment.duitku_ovoepay.windowState === "1") {
						paymentwindow.on("close", onclose);
					}
					paymentwindow.open();
				},
				loadEPayPaymentWindowJs: function() {
					$.getScript(window.checkoutConfig.payment.duitku_ovoepay.paymentWindowJsUrl);
				},
				
				showError: function (errorMessage) {
					globalMessageList.addErrorMessage({
							message: errorMessage
						});
				}
			});
	}
);