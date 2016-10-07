<style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }

    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }

    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }

    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }

    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }

    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }

    .invoice-box table tr.details td{
        padding-bottom:20px;
    }

    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }

    .invoice-box table tr.item.last td{
        border-bottom:none;
    }

    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }

        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
</style>

<div class="invoice-box" style="max-width: 800px;margin: auto;padding: 30px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, .15);font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;">
    <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
        <tr class="top">
            <td colspan="2" style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;line-height: inherit;text-align: left;">
                    <tr>
                        <td class="title" style="padding: 5px;vertical-align: top;padding-bottom: 20px;font-size: 45px;line-height: 45px;color: #333;">
                            <img src="<?php echo Router::url('/', true) . $logo_uri ?>" style="width:100%; max-width:300px;">
                        </td>

                        <td style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 20px;">
                            Đơn hàng #: <?php echo $code ?><br>
                            Thời điểm tạo: <?php echo $created ?><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2" style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;line-height: inherit;text-align: left;">
                    <tr>
                        <td style="padding: 5px;vertical-align: top;padding-bottom: 40px;">
                            <?php echo nl2br($customer_address); ?><br/>
                            <?php echo $region_name ?> - <?php echo $region_parent_name ?>
                        </td>

                        <td style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 40px;">
                            <?php echo $customer_name ?><br>
                            <?php echo $customer_mobile ?><br>
                            <?php echo $customer_mobile2 ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                Nhà phân phối
            </td>

            <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                Trạng thái đơn hàng
            </td>
        </tr>

        <tr class="details">
            <td style="padding: 5px;vertical-align: top;padding-bottom: 20px;">
                <?php echo $distributor_name ?> ( <?php echo $distributor_code ?> )
            </td>

            <td style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 20px;">
                <?php echo $status ?>
            </td>
        </tr>

        <tr class="heading">
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                Sản phẩm (số lượng)
            </td>

            <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">
                Giá tiền
            </td>
        </tr>
        <?php
        $count = 0;
        $max = count($items);
        ?>
        <?php foreach ($items as $item): ?>
            <?php
            $count++;
            ?>
            <?php if ($count != $max): ?>
                <tr class="item">
                    <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">
                        <img src="<?php echo Router::url('/', true) . $item['logo_uri'] ?>" alt="<?php echo $item['name'] ?>" style="width: 100px; height: auto" /><br/>
                        <?php echo $item['name'] ?> (<?php echo number_format($item['qty']) ?>/<?php echo $item['unit'] ?>)
                    </td>

                    <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
                        <?php echo number_format($item['total_price']) ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr class="item last">
                    <td style="padding: 5px;vertical-align: top;border-bottom: none;">
                        <img src="<?php echo Router::url('/', true) . $item['logo_uri'] ?>" alt="<?php echo $item['name'] ?>" style="width: 100px; height: auto" /><br/>
                        <?php echo $item['name'] ?> (<?php echo number_format($item['qty']) ?>/<?php echo $item['unit'] ?>)
                    </td>

                    <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: none;">
                        <?php echo number_format($item['total_price']) ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <tr class="total">
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold;">
                Thành tiền: <?php echo number_format($total_price) ?>
            </td>
        </tr>
    </table>
</div>