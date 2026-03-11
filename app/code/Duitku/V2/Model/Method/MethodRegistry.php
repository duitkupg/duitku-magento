<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku
 * @copyright Duitku(http://duitku.com)
 * @license   Duitku
 *
 */
namespace Duitku\V2\Model\Method;

class MethodRegistry
{
    // Payment method codes
    public const METHOD_NUSAPAYQRIS   = 'duitku_nusapayqris';
    public const METHOD_SHOPEEPAYQRIS = 'duitku_shopeepayqris';
    public const METHOD_ATOME         = 'duitku_atome';
    public const METHOD_BNC           = 'duitku_bnc';
    public const METHOD_BCAKLIKPAY    = 'duitku_bcaklikpay';
    public const METHOD_BRIVA         = 'duitku_briva';
    public const METHOD_CREDITCARD    = 'duitku_creditcard';
    public const METHOD_DANA          = 'duitku_dana';
    public const METHOD_INDODANA      = 'duitku_indodana';
    public const METHOD_INDOMARET     = 'duitku_indomaret';
    public const METHOD_JENIUSPAY     = 'duitku_jeniuspay';
    public const METHOD_LINKAJAAPPS   = 'duitku_linkajaapps';
    public const METHOD_LINKAJAAPPSFIXED = 'duitku_linkajaappsfixed';
    public const METHOD_LINKAJAQRIS = 'duitku_linkajaqris';
    public const METHOD_NOBUQRIS = 'duitku_nobuqris';
    public const METHOD_OVO = 'duitku_ovo';
    public const METHOD_RITEL = 'duitku_ritel';
    public const METHOD_POSPAY = 'duitku_pospay';
    public const METHOD_SHOPEEPAYAPPS = 'duitku_shopeepayapps';
    public const METHOD_VAATMBERSAMA = 'duitku_vaatmbersama';
    public const METHOD_VABCA = 'duitku_vabca';
    public const METHOD_VABNI = 'duitku_vabni';
    public const METHOD_VABSI = 'duitku_vabsi';
    public const METHOD_VACIMBNIAGA = 'duitku_vacimbniaga';
    public const METHOD_VADANAMON = 'duitku_vadanamon';
    public const METHOD_VAMANDIRI = 'duitku_vamandiri';
    public const METHOD_VAMAYBANK = 'duitku_vamaybank';
    public const METHOD_VAPERMATA = 'duitku_vapermata';
    public const METHOD_VASAMPOERNA = 'duitku_vasampoerna';
    public const METHOD_MG = 'duitku_mg';
    public const METHOD_GUDANGVOUCHERQRIS = 'duitku_gudangvoucherqris';
    public const METHOD_DANAQRIS = 'duitku_danaqris';

    // Payment reference keys
    public const REFERENCE_NUSAPAYQRIS   = 'duitkuNusapayqrisReference';
    public const REFERENCE_SHOPEEPAYQRIS = 'duitkuShopeePayqrisReference';
    public const REFERENCE_ATOME         = 'duitkuAtomeReference';
    public const REFERENCE_BNC           = 'duitkuBncReference';
    public const REFERENCE_BCAKLIKPAY    = 'duitkuBcaKlikpayReference';
    public const REFERENCE_BRIVA         = 'duitkuBrivaReference';
    public const REFERENCE_CREDITCARD    = 'duitkuCreditcardReference';
    public const REFERENCE_DANA          = 'duitkuDanaReference';
    public const REFERENCE_INDODANA      = 'duitkuIndodanaReference';
    public const REFERENCE_INDOMARET     = 'duitkuIndomaretReference';
    public const REFERENCE_JENIUSPAY     = 'duitkuJeniuspayReference';
    public const REFERENCE_LINKAJAAPPS   = 'duitkuLinkajaappsReference';
    public const REFERENCE_LINKAJAAPPSFIXED = 'duitkuLinkajaappsfixedReference';
    public const REFERENCE_LINKAJAQRIS = 'duitkuLinkajaqrisReference';
    public const REFERENCE_NOBUQRIS = 'duitkuNobuqrisReference';
    public const REFERENCE_OVO = 'duitkuOvoReference';
    public const REFERENCE_RITEL = 'duitkuRitelReference';
    public const REFERENCE_POSPAY = 'duitkuPospayReference';
    public const REFERENCE_SHOPEEPAYAPPS = 'duitkuShopeepayappsReference';
    public const REFERENCE_VAATMBERSAMA = 'duitkuVaatmbersamaReference';
    public const REFERENCE_VABCA = 'duitkuVabcaReference';
    public const REFERENCE_VABNI = 'duitkuVabniReference';
    public const REFERENCE_VABSI = 'duitkuVabsiReference';
    public const REFERENCE_VACIMBNIAGA = 'duitkuVacimbniagaReference';
    public const REFERENCE_VADANAMON = 'duitkuVadanamonReference';
    public const REFERENCE_VAMANDIRI = 'duitkuVamandiriReference';
    public const REFERENCE_VAMAYBANK = 'duitkuVamaybankReference';
    public const REFERENCE_VAPERMATA = 'duitkuVapermataReference';
    public const REFERENCE_VASAMPOERNA = 'duitkuVasampoernaReference';
    public const REFERENCE_MG = 'duitkuMgReference';
    public const REFERENCE_GUDANGVOUCHERQRIS = 'duitkuGudangvoucherqrisReference';
    public const REFERENCE_DANAQRIS = 'duitkuDanaqrisReference';

    /**
     * Returns all method codes
     */
    public static function getAllCodes(): array
    {
        return [
            self::METHOD_NUSAPAYQRIS,
            self::METHOD_SHOPEEPAYQRIS,
            self::METHOD_ATOME,
            self::METHOD_BNC,
            self::METHOD_BCAKLIKPAY,
            self::METHOD_BRIVA,
            self::METHOD_CREDITCARD,
            self::METHOD_DANA,
            self::METHOD_INDODANA,
            self::METHOD_INDOMARET,
            self::METHOD_JENIUSPAY,
            self::METHOD_LINKAJAAPPS,
            self::METHOD_LINKAJAAPPSFIXED,
            self::METHOD_LINKAJAQRIS,
            self::METHOD_NOBUQRIS,
            self::METHOD_OVO,
            self::METHOD_RITEL,
            self::METHOD_POSPAY,
            self::METHOD_SHOPEEPAYAPPS,
            self::METHOD_VAATMBERSAMA,
            self::METHOD_VABCA,
            self::METHOD_VABNI,
            self::METHOD_VABSI,
            self::METHOD_VACIMBNIAGA,
            self::METHOD_VADANAMON,
            self::METHOD_VAMANDIRI,
            self::METHOD_VAMAYBANK,
            self::METHOD_VAPERMATA,
            self::METHOD_VASAMPOERNA,
            self::METHOD_MG,
            self::METHOD_GUDANGVOUCHERQRIS,
            self::METHOD_DANAQRIS,
        ];
    }

    /**
     * Maps payment method codes to their reference keys
     */
    public static function getReferenceByMethod(string $method): ?string
    {
        $map = [
            self::METHOD_NUSAPAYQRIS   => self::REFERENCE_NUSAPAYQRIS,
            self::METHOD_SHOPEEPAYQRIS => self::REFERENCE_SHOPEEPAYQRIS,
            self::METHOD_ATOME         => self::REFERENCE_ATOME,
            self::METHOD_BNC           => self::REFERENCE_BNC,
            self::METHOD_BCAKLIKPAY    => self::REFERENCE_BCAKLIKPAY,
            self::METHOD_BRIVA         => self::REFERENCE_BRIVA,
            self::METHOD_CREDITCARD    => self::REFERENCE_CREDITCARD,
            self::METHOD_DANA          => self::REFERENCE_DANA,
            self::METHOD_INDODANA      => self::REFERENCE_INDODANA,
            self::METHOD_INDOMARET     => self::REFERENCE_INDOMARET,
            self::METHOD_JENIUSPAY     => self::REFERENCE_JENIUSPAY,
            self::METHOD_LINKAJAAPPS   => self::REFERENCE_LINKAJAAPPS,
            self::METHOD_LINKAJAAPPSFIXED => self::REFERENCE_LINKAJAAPPSFIXED,
            self::METHOD_LINKAJAQRIS => self::REFERENCE_LINKAJAQRIS,
            self::METHOD_NOBUQRIS => self::REFERENCE_NOBUQRIS,
            self::METHOD_OVO => self::REFERENCE_OVO,
            self::METHOD_RITEL => self::REFERENCE_RITEL,
            self::METHOD_POSPAY => self::REFERENCE_POSPAY,
            self::METHOD_SHOPEEPAYAPPS => self::REFERENCE_SHOPEEPAYAPPS,
            self::METHOD_VAATMBERSAMA => self::REFERENCE_VAATMBERSAMA,
            self::METHOD_VABCA => self::REFERENCE_VABCA,
            self::METHOD_VABNI => self::REFERENCE_VABNI,
            self::METHOD_VABSI => self::REFERENCE_VABSI,
            self::METHOD_VACIMBNIAGA => self::REFERENCE_VACIMBNIAGA,
            self::METHOD_VADANAMON => self::REFERENCE_VADANAMON,
            self::METHOD_VAMANDIRI => self::REFERENCE_VAMANDIRI,
            self::METHOD_VAMAYBANK => self::REFERENCE_VAMAYBANK,
            self::METHOD_VAPERMATA => self::REFERENCE_VAPERMATA,
            self::METHOD_VASAMPOERNA => self::REFERENCE_VASAMPOERNA,
            self::METHOD_MG => self::REFERENCE_MG,
            self::METHOD_GUDANGVOUCHERQRIS => self::REFERENCE_GUDANGVOUCHERQRIS,
            self::METHOD_DANAQRIS => self::REFERENCE_DANAQRIS,
        ];

        return $map[$method] ?? null;
    }
}
