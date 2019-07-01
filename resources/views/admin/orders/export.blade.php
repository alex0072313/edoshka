<table>
    <thead>
        <tr>
            <td colspan="11">
                {{ $title }}
            </td>
        </tr>
        <tr>
            <th>ID заказа</th>
            <th>Дата создания</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Адрес</th>
            <th>Кол-во персон</th>
            <th>Пожелания</th>
            <th>Кол-во блюд</th>
            <th>Сумма заказа</th>
            <th>Комиссия с заказа</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->persons }}</td>
                <td>{{ $order->dop }}</td>
                <td>{{ $order->total_quantity }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->commission }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="11">
                Всего заказов: {{ $total }}, на сумму: {{ $total_price }}, комиссия сервиса: {{ $total_commission }}
            </td>
        </tr>

    </tbody>
</table>
