<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #cdcdcd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .name,
        .quantity,
        .price,
        .offer_price,
        .total {
            text-align: center;
        }

        .image img {
            display: block;
            margin: 0 auto;
        }

        p {
            color: #555;
        }
    </style>
</head>

<body>
    <h1>Xin chào, {{ $address->name }}!</h1>
    <p>Cảm ơn bạn đã đặt hàng. Đây là chi tiết đơn hàng của bạn:</p>

    <h2>Chi tiết đơn hàng:</h2>
    <table>
        <thead>
            <tr>
                <th style="text-align: center; font-size:13px">Sản phẩm</th>
                <th style="text-align: center; font-size:13px">Hình ảnh</th>
                <th style="text-align: center; font-size:13px">Số lượng</th>
                <th style="text-align: center; font-size:13px">Giá</th>
                <th style="text-align: center; font-size:13px">Giá ưu đãi</th>
                <th style="text-align: center; font-size:13px">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetails as $orderDetail)
                <tr>
                    <td class="name" style="font-weight: 700; font-size:14px;">
                        {{ $orderDetail->variantColors->variant->product->name }} -
                        {{ $orderDetail->variantColors->variant->storage->GB }}
                        <p>Màu sắc: {{ $orderDetail->variantColors->color->name }}</p>
                    </td>
                    <td class="image">
                        <img src="{{ $message->embed(public_path($orderDetail->variantColors->variant->product->image)) }}"
                            alt="{{ $orderDetail->variantColors->variant->product->name }}" width="100">
                    </td>

                    <td class="quantity">{{ $orderDetail->quantity }}</td>
                    <td class="price">
                        {{ number_format($orderDetail->variantColors->price, 0, '.', ',') }} đ
                    </td>
                    <td class="offer_price">
                        {{ number_format($orderDetail->variantColors->offer_price, 0, '.', ',') }} đ
                    </td>
                    <td class="total">
                        {{ number_format(($orderDetail->variantColors->price - $orderDetail->variantColors->offer_price) * $orderDetail->quantity, '0', '.') }}
                        đ
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="font-weight:600">Tổng cộng: {{ number_format($orders->total_amount, 0, '.', ',') }} đ</p>
    <p style="font-weight:600">Phương thức thanh toán: {{ $orders->payment_method }}</p>
    <p style="font-weight:600">Trạng thái: {{ $orders->status }}</p>
    <p style="font-weight:600">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi! ❤️❤️❤️❤️</p>
</body>

</html>
