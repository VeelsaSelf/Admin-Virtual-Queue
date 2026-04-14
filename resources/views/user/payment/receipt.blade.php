@extends('user.layouts.app')
@section('title','Receipt – Mau Kopi')

@push('styles')
<style>
.receipt-card {
    background:#252220;border:1px solid #3A3733;
    border-radius:20px;overflow:hidden;
    max-width:480px;margin:0 auto;
}
.receipt-row {
    display:flex;align-items:center;justify-content:space-between;
    padding:13px 28px;border-bottom:1px solid #3A3733;
    font-size:14px;color:#F0EDE8;
}
</style>
@endpush

@section('content')

<div style="padding:36px 24px 80px;max-width:540px;margin:0 auto;">
    <div class="receipt-card">

        {{-- Logo header --}}
        <div style="text-align:center;padding:36px 28px 24px;border-bottom:1px solid #3A3733;">
            <svg width="52" height="52" viewBox="0 0 36 36" fill="none" style="display:block;margin:0 auto 12px;">
                <path d="M18 3C11.4 3 6.5 7.8 6.5 14.2C6.5 17 7.6 19.3 9.4 21.1L8.5 31H27.5L26.6 21.1C28.4 19.3 29.5 17 29.5 14.2C29.5 7.8 24.6 3 18 3Z" fill="white"/>
                <path d="M13.5 7C13.5 7 11.8 10.5 13.5 13C15.2 15.5 13.5 19 13.5 19" stroke="#252220" stroke-width="1.4" stroke-linecap="round"/>
                <path d="M18 5.5C18 5.5 16.3 9 18 11.5C19.7 14 18 17.5 18 17.5" stroke="#252220" stroke-width="1.4" stroke-linecap="round"/>
                <path d="M22.5 7C22.5 7 20.8 10.5 22.5 13C24.2 15.5 22.5 19 22.5 19" stroke="#252220" stroke-width="1.4" stroke-linecap="round"/>
                <path d="M8.5 31H27.5L27 32.8C27 33.8 26.1 34.5 25.1 34.5H10.9C9.9 34.5 9 33.8 9 32.8L8.5 31Z" fill="white"/>
            </svg>
            <div style="font-size:18px;font-weight:800;color:#F0EDE8;letter-spacing:0.14em;">MAU KOPI</div>
        </div>

        {{-- Date + address --}}
        <div style="display:flex;justify-content:space-between;padding:16px 28px;border-bottom:1px solid #3A3733;">
            <div>
                <div style="font-size:13px;color:rgba(240,237,232,0.6);">{{ $order['date'] }}</div>
                <div style="font-size:13px;color:rgba(240,237,232,0.6);">{{ $order['time'] }}</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:13px;color:rgba(240,237,232,0.6);">Jl. Tanimbar 22, Malang,</div>
                <div style="font-size:13px;color:rgba(240,237,232,0.6);">Jawa Timur, Indonesia</div>
            </div>
        </div>

        {{-- Items --}}
        @foreach($order['items'] as $item)
        <div class="receipt-row">
            <div style="display:flex;gap:10px;align-items:center;">
                <span style="color:rgba(240,237,232,0.45);">{{ $item['qty'] }}</span>
                <span>{{ $item['name'] }}</span>
            </div>
            <span>Rp {{ number_format($item['price']*$item['qty'],0,',','.') }}</span>
        </div>
        @endforeach

        {{-- Payment method --}}
        <div class="receipt-row">
            <span style="color:rgba(240,237,232,0.5);">Metode Pembayaran</span>
            <span style="font-weight:500;">{{ $order['payment_method'] }}</span>
        </div>

        {{-- Totals --}}
        <div style="padding:20px 28px;border-bottom:1px solid #3A3733;">
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="font-size:14px;color:rgba(240,237,232,0.6);">Subtotal</span>
                <span style="font-size:14px;font-weight:600;color:#DDB892;">Rp {{ number_format($order['subtotal'],0,',','.') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:16px;">
                <span style="font-size:14px;color:rgba(240,237,232,0.6);">PPN (10%)</span>
                <span style="font-size:14px;font-weight:600;color:#DDB892;">Rp {{ number_format($order['tax'],0,',','.') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;">
                <span style="font-size:17px;font-weight:700;color:#F0EDE8;">Total</span>
                <span style="font-size:19px;font-weight:800;color:#DDB892;">Rp {{ number_format($order['total'],0,',','.') }}</span>
            </div>
        </div>

        {{-- Thank you + order number --}}
        <div style="padding:32px 28px;text-align:center;">
            <p style="font-size:13px;color:rgba(240,237,232,0.45);margin-bottom:6px;">Thank you for your order!</p>
            <p style="font-size:13px;color:rgba(240,237,232,0.45);margin-bottom:18px;">Your Order Number:</p>
            <div style="font-size:72px;font-weight:900;color:#F0EDE8;line-height:1;">{{ $order['order_number'] }}</div>
        </div>

    </div>

    {{-- Back to menu --}}
    <div style="text-align:center;margin-top:24px;">
        <a href="{{ route('user.menu.index') }}"
           style="display:inline-block;padding:12px 28px;border-radius:50px;border:1.5px solid #3A3733;color:rgba(240,237,232,0.45);font-size:13px;text-decoration:none;transition:all 0.15s;"
           onmouseover="this.style.borderColor='#DDB892';this.style.color='#DDB892';"
           onmouseout="this.style.borderColor='#3A3733';this.style.color='rgba(240,237,232,0.45)';">
            ← Kembali ke Menu
        </a>
    </div>
</div>

@endsection
