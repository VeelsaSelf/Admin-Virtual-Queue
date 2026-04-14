@extends('user.layouts.app')
@section('title','Payment – Mau Kopi')

@push('styles')
<style>
.pay-card {
    background: #2A2724;
    border: 1px solid #3A3733;
    border-radius: 22px;
    overflow: hidden;
    max-width: 490px;
    margin: 0 auto;
    width: 100%;
}
.pay-header {
    padding: 38px 36px 30px;
    text-align: center;
    border-bottom: 1px solid #3A3733;
}
.status-icon {
    width: 68px; height: 68px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 22px;
}
.pay-title {
    font-size: 24px; font-weight: 800; color: #F0EDE8;
    margin: 0 0 12px; letter-spacing: -0.2px;
}
.pay-subtitle {
    font-size: 13.5px; color: rgba(240,237,232,0.48);
    line-height: 1.65; margin: 0;
}
.countdown-text {
    font-size: 38px; font-weight: 800; color: #F0EDE8;
    letter-spacing: 0.06em; margin: 16px 0 0;
    font-variant-numeric: tabular-nums;
}
@keyframes spinClock { to { transform: rotate(360deg); } }
.icon-spin { animation: spinClock 2s linear infinite; }
@keyframes pulseGlow {
    0%,100% { box-shadow: 0 0 0 0 rgba(201,168,124,0.45); }
    50%      { box-shadow: 0 0 0 12px rgba(201,168,124,0); }
}
.icon-pulse { animation: pulseGlow 2s ease-in-out infinite; }
.item-section { border-bottom: 1px solid #3A3733; }
.item-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 28px; border-bottom: 1px solid #3A3733; gap: 12px;
}
.item-row:last-child { border-bottom: none; }
.item-left { display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0; }
.item-qty { font-size: 14px; color: rgba(240,237,232,0.5); flex-shrink: 0; width: 14px; }
.item-name { font-size: 14px; color: #F0EDE8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.item-price { font-size: 14px; color: #F0EDE8; flex-shrink: 0; font-weight: 400; }
.meta-section { border-bottom: 1px solid #3A3733; }
.meta-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 13px 28px; border-bottom: 1px solid #3A3733;
}
.meta-row:last-child { border-bottom: none; }
.meta-label { font-size: 13.5px; color: rgba(240,237,232,0.45); }
.meta-value { font-size: 13.5px; color: #F0EDE8; font-weight: 500; }
.totals-section { padding: 20px 28px 22px; border-bottom: 1px solid #3A3733; }
.total-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.total-row:last-child { margin-bottom: 0; }
.t-label  { font-size: 14px; color: rgba(240,237,232,0.65); }
.t-value  { font-size: 14px; font-weight: 600; color: #DDB892; }
.t-label-grand { font-size: 17px; font-weight: 800; color: #F0EDE8; }
.t-value-grand { font-size: 18px; font-weight: 800; color: #DDB892; }
.action-section { padding: 22px 28px 26px; text-align: center; }
.action-note { font-size: 13px; color: rgba(240,237,232,0.38); line-height: 1.65; margin: 0 0 18px; }
.action-btn {
    display: block; width: 100%; padding: 15px; border-radius: 13px;
    font-size: 15px; font-weight: 700; text-align: center; text-decoration: none;
    cursor: pointer; border: none; font-family: 'Inter', sans-serif;
    transition: opacity 0.15s; letter-spacing: 0.01em;
}
.action-btn:hover { opacity: 0.86; }
.btn-processing { background: #3A3733; color: rgba(240,237,232,0.35); cursor: not-allowed; }
.btn-accent { background: #DDB892; color: #1C1A17; }
</style>
@endpush

@section('content')

<div style="padding: 36px 20px 72px; max-width: 550px; margin: 0 auto;">
    <div class="pay-card">

        {{-- HEADER --}}
        <div class="pay-header">

            @if($order['status'] === 'processing')

                <div class="status-icon icon-pulse" style="background: #DDB892;">
                    <svg class="icon-spin" width="32" height="32" viewBox="0 0 24 24" fill="none"
                         stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>

                @if($order['payment_method'] === 'Cash')
                    <p class="pay-title">Complete Your Payment</p>
                    <p class="pay-subtitle">
                        Please complete your payment at the<br>cashier within the time below.
                    </p>
                @else
                    <p class="pay-title">Processing Your Payment</p>
                    <p class="pay-subtitle">
                        We're confirming your payment. This<br>usually takes just a moment.
                    </p>
                @endif

                {{-- ✅ Countdown muncul untuk SEMUA metode --}}
                <div class="countdown-text" id="countdown">00:00:10</div>

            @elseif($order['status'] === 'success')

                <div class="status-icon" style="background: #1E7D3A;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                         stroke="white" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <p class="pay-title">Payment Completed</p>
                <p class="pay-subtitle">
                    Thank you. Your order has been sent to the<br>kitchen and is now being prepared.
                </p>

            @elseif($order['status'] === 'failed')

                <div class="status-icon" style="background: #C0392B;">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                         stroke="white" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </div>
                <p class="pay-title">Payment Failed</p>
                <p class="pay-subtitle">
                    Your payment didn't go through.<br>No charges were made.
                </p>

            @endif
        </div>

        {{-- ITEMS --}}
        <div class="item-section">
            @foreach($order['items'] as $item)
            <div class="item-row">
                <div class="item-left">
                    <span class="item-qty">{{ $item['qty'] }}</span>
                    <span class="item-name">{{ $item['name'] }}</span>
                </div>
                <span class="item-price">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>

        {{-- META --}}
        <div class="meta-section">
            <div class="meta-row">
                <span class="meta-label">Payment Method</span>
                <span class="meta-value">{{ $order['payment_method'] }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Order Type</span>
                <span class="meta-value">{{ $order['order_type'] ?? 'Dine In' }}</span>
            </div>
        </div>

        {{-- TOTALS --}}
        <div class="totals-section">
            <div class="total-row">
                <span class="t-label">Subtotal</span>
                <span class="t-value">Rp {{ number_format($order['subtotal'], 0, ',', '.') }}</span>
            </div>
            <div class="total-row" style="margin-bottom: 16px;">
                <span class="t-label">PPN (10%)</span>
                <span class="t-value">Rp {{ number_format($order['tax'], 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span class="t-label-grand">Total</span>
                <span class="t-value-grand">Rp {{ number_format($order['total'], 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- ACTION --}}
        <div class="action-section">

            @if($order['status'] === 'processing')
                @if($order['payment_method'] === 'Cash')
                    <p class="action-note">
                        If the time runs out, your order will be<br>cancelled automatically.
                    </p>
                @else
                    <p class="action-note">
                        You'll be taken to your receipt once<br>everything is confirmed.
                    </p>
                @endif
                <button class="action-btn btn-processing">Processing...</button>

            @elseif($order['status'] === 'success')
                <p class="action-note">
                    Here's your receipt and you'll be notify<br>when your order is ready.
                </p>
                <a href="{{ route('user.payment.receipt', $order['id']) }}" class="action-btn btn-accent">
                    Receipt
                </a>

            @elseif($order['status'] === 'failed')
                <p class="action-note">
                    You can try again or choose a<br>different payment method.
                </p>
                <a href="{{ route('user.checkout.restore', $order['id']) }}" class="action-btn btn-accent">
                    Back to Checkout
                </a>
            @endif

        </div>
    </div>
</div>

@endsection

{{-- COUNTDOWN SCRIPT — untuk semua metode pembayaran --}}
@if($order['status'] === 'processing')
@push('scripts')
<script>
    const IS_CASH_METHOD = {{ $order['payment_method'] === 'Cash' ? 'true' : 'false' }};
    const CSRF           = document.querySelector('meta[name="csrf-token"]').content;
    const CONFIRM_URL    = '{{ route("user.payment.confirm", $order["id"]) }}';

    let seconds = 10;

    function pad(n) { return String(n).padStart(2, '0'); }

    function submitStatus(status) {
        const f = document.createElement('form');
        f.method = 'POST';
        f.action = CONFIRM_URL;
        f.innerHTML = `
            <input type="hidden" name="_token" value="${CSRF}">
            <input type="hidden" name="payment_status" value="${status}">
        `;
        document.body.appendChild(f);
        f.submit();
    }

    function tick() {
        const el = document.getElementById('countdown');
        if (el) el.textContent = `00:00:${pad(seconds)}`;

        if (seconds <= 0) {
            // Cash habis waktu → failed | QRIS & Transfer habis waktu → success
            submitStatus(IS_CASH_METHOD ? 'failed' : 'success');
            return;
        }

        seconds--;
        setTimeout(tick, 1000);
    }

    setTimeout(tick, 1000);
</script>
@endpush
@endif