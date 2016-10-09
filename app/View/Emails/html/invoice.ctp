<table class="body-wrap" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
    <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="container" width="600" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; width: 100% !important; margin: 0 auto; padding: 0;" valign="top">
            <div class="content" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 0;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                    <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <td class="content-wrap aligncenter" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 10px;" align="center" valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block aligncenter" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
                                        <table class="invoice" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100% !important; margin: 40px auto;">
                                            <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-block" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                                    <h2 style="font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; box-sizing: border-box; font-size: 18px !important; color: #000; line-height: 1.2em; font-weight: 800 !important; margin: 20px 0 5px;">Thông tin đơn hàng</h2>
                                                </td>
                                            </tr>
                                            <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;">
                                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Mã đơn hàng:</td>
                                                            <td class="" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top"><?php echo $code ?></td>
                                                        </tr>
                                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Thời điểm đặt:</td>
                                                            <td class="" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top"><?php echo date('d/m/Y H:i:s', strtotime($created)) ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td class="content-block" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                                    <h2 style="font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; box-sizing: border-box; font-size: 18px !important; color: #000; line-height: 1.2em; font-weight: 800 !important; margin: 20px 0 5px;">Thông tin khách hàng</h2>
                                                </td>
                                            </tr>
                                            <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;">
                                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Tên khách hàng:</td>
                                                            <td class="" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top"><?php echo $customer_name ?></td>
                                                        </tr>
                                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Số điện thoại 1:</td>
                                                            <td class="" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top"><?php echo $customer_mobile ?></td>
                                                        </tr>
                                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Số điện thoại 2:</td>
                                                            <td class="" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top"><?php echo $customer_mobile2 ?></td>
                                                        </tr>
                                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">Địa chỉ:</td>
                                                            <td class="" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">
                                                                <?php if (!empty($customer_address)): ?>
                                                                    <?php echo $customer_address ?><br/>
                                                                <?php endif; ?>
                                                                <?php echo $region_name ?> - <?php echo $region_parent_name ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;" valign="top">
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;">
                                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td class="content-block" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">
                                                                <h2 style="font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; box-sizing: border-box; font-size: 18px !important; color: #000; line-height: 1.2em; font-weight: 800 !important; margin: 20px 0 5px;">Đơn hàng chi tiết</h2>
                                                            </td>
                                                        </tr>
                                                        <?php foreach ($items as $item): ?>
                                                            <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" valign="top">
                                                                    <?php echo $item['product_name'] ?><br style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />
                                                                    <img alt="<?php echo $item['product_name'] ?>" style="width: 64px; height: auto; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; max-width: 100%; margin: 0;" src="<?php echo Configure::read('App.fullBaseUrl') . $item['product_logo_uri'] ?>" /><br style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" /> Số lượng: <?php echo number_format($item['qty']) ?><br style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" /> Đơn giá: <?php echo number_format($item['total_price'] / $item['product_price']) ?>
                                                                </td>
                                                                <td class="alignright" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;" align="right" valign="top"><?php echo number_format($item['total_price']) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr class="total" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                            <td class="alignright" width="75%" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top">Thành tiền</td>
                                                            <td class="alignright" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;" align="right" valign="top"><?php echo number_format($total_price) ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                    <table width="100%" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="aligncenter content-block" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Cần hỗ trợ? Email <a href="mailto:" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;"><?php echo $from ?></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
    </tr>
</table>