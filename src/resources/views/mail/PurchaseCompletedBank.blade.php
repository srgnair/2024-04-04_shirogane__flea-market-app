<!DOCTYPE html>
<html>

<head>
    <title>[coachtechフリマ]商品が購入されました。</title>
</head>

<body>
    <h1>{{ $subject }}</h1>

    <p>{{ $recipientName }}さん</p>
    <p>以下の商品が購入されました。</p>
    <p>購入者からの銀行振込をお待ちください。</p>

    <p>商品名：{{ $itemName }}</p>
</body>

</html>