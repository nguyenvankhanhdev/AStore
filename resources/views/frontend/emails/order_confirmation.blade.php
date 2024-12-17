<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            line-height: 1.6;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: center;
            padding: 12px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f1f1f1;
            color: #333;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .image img {
            max-width: 80px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .total {
            font-weight: bold;
            color: #28a745;
        }

        .summary {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }

        .summary span {
            color: #007bff;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .footer strong {
            color: #000;
        }

        .thank-you {
            text-align: center;
            font-size: 18px;
            color: #28a745;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Xin chào, {{ $address->name }}!</h1>
        <p>Cảm ơn bạn đã đặt hàng. Đây là chi tiết đơn hàng của bạn:</p>

        <h2>Chi tiết đơn hàng:</h2>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Giá ưu đãi</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $orderDetail)
                    <tr>
                        <td class="name" style="font-weight: 700;">
                            {{ $orderDetail->variantColors->variant->product->name }} -
                            {{ $orderDetail->variantColors->variant->storage->GB }}
                            <p style="margin: 0; color: #666; font-size: 12px;">Màu sắc: {{ $orderDetail->variantColors->color->name }}</p>
                        </td>
                        <td class="image">
                            <img src="{{ $message->embed(public_path($orderDetail->variantColors->variant->product->image)) }}"
                                alt="{{ $orderDetail->variantColors->variant->product->name }}">
                        </td>
                        <td class="quantity">{{ $orderDetail->quantity }}</td>
                        <td class="price">
                            {{ number_format($orderDetail->variantColors->price, 0, '.', ',') }} đ
                        </td>
                        <td class="offer_price">
                            {{ number_format($orderDetail->variantColors->offer_price, 0, '.', ',') }} đ
                        </td>
                        <td class="total">
                            {{ number_format(($orderDetail->variantColors->price - $orderDetail->variantColors->offer_price) * $orderDetail->quantity, '0', '.') }} đ
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p>Tổng cộng: <span>{{ number_format($orders->total_amount, 0, '.', ',') }} đ</span></p>
            <p>Phương thức thanh toán: <span>{{ $orders->payment_method }}</span></p>
            <p>Trạng thái: <span>
            @if ($orders->status == "pending")
                Đang chờ
            @endif </span></p>
        </div>

        <p class="thank-you">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi! ❤️❤️❤️❤️</p>

        <div class="footer">
            <p><strong>ASTORE chúng tôi</strong> | Luôn sẵn sàng phục vụ bạn</p>
        </div>
    </div>
</body>

</html>
