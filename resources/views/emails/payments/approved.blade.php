@component('mail::message')
# Olá {{ $order->user->truename }}

Pagamento da sua doação ID **#{{ $order->id }}**, via __{{ $order->gateway->name }}__ foi **{{ $order->present()->status()['label'] }}** e acaba
de ser entregue!

**INFORMAÇÕES DO PEDIDO**
+ **ID do Pedido:** #{{ $order->id }}
+ **Login do jogo** {{ $order->user->name }}
+ **Valor Pago**: {{ money($order->package->price * 100) }}

Tenha um ótimo jogo!

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
