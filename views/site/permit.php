<?php
/**
 * Шаблон путевки
 * @var \app\models\Customer $customer Клиент
 * @var \app\models\Housing $housing Корпус
 */
?>
<style>
    .container{
        width: 1000px;
        margin: 0 auto;
    }
    .voucher{
        border: 1px solid #000;
        width: 1000px;
    }
    .title{
        text-align: center;
        font-size: 60px;
    }
    .subtitle{
        text-align: center;
        font-size: 40px;
    }
    .name, .data, .house-room{
        font-weight: 700;
        padding-left: 30px;
        font-size: 40px;
        line-height: 2;
    }
    .signature{
        width: 300px;
        height: 50px;
        margin: 0 30px 30px auto;
        border-bottom: 2px solid #000;
    }
</style>
<div class="container">
    <div class="voucher">
        <div class="title">Путёвка</div>
        <div class="subtitle">Санаторий Саулык</div>
        <div class="name"><?=\yii\helpers\Html::encode($customer->full_name)?></div>
        <div class="data">С <?= $customer->order->arrival_date; ?> По <?= $customer->order->departure_date; ?></div>
        <div class="house-room">Корпус <?= $housing->name ?>  Комната <?= $customer->order->room ?></div>
        <div class="signature"></div>
    </div>
</div>