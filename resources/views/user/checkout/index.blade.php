@extends('user.layouts.app')
@section('title','Checkout – Mau Kopi')

@push('styles')
<style>
.checkout-card {
    background: #252220;
    border: 1px solid #3A3733;
    border-radius: 20px;
    overflow: hidden;
    max-width: 700px;
    margin: 0 auto;
}

/* Item rows */
.item-row {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 18px 28px;
    border-bottom: 1px solid #3A3733;
}
.item-thumb {
    width: 56px;
    height: 56px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}
.item-thumb img { width:100%;height:100%;object-fit:cover; }

/* Dropdown rows */
.dropdown-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 28px;
    border-bottom: 1px solid #3A3733;
}
.dropdown-row-label {
    font-size: 15px;
    font-weight: 600;
    color: #F0EDE8;
}
.custom-select-wrap {
    position: relative;
}
.custom-select {
    appearance: none;
    -webkit-appearance: none;
    background: transparent;
    border: 1.5px solid #DDB892;
    color: #DDB892;
    border-radius: 50px;
    padding: 8px 36px 8px 18px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    outline: none;
    min-width: 120px;
    transition: all 0.15s;
}
.custom-select option {
    background: #2A2724;
    color: #F0EDE8;
    font-weight: 500;
}
.custom-select:focus { border-color: #DFC4A0; }
.select-arrow {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #DDB892;
}

/* Name section */
.name-section {
    padding: 18px 28px;
    border-bottom: 1px solid #3A3733;
}
.name-label-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.name-label { font-size:15px;font-weight:600;color:#F0EDE8; }
.name-required { font-size:12px;color:rgba(240,237,232,0.35); }
.name-input {
    width: 100%;
    background: transparent;
    border: 1.5px solid #3A3733;
    border-radius: 12px;
    padding: 13px 18px;
    color: #F0EDE8;
    font-size: 14px;
    font-family: 'Inter', sans-serif;
    outline: none;
    transition: border-color 0.15s;
}
.name-input::placeholder { color: rgba(240,237,232,0.25); }
.name-input:focus { border-color: #DDB892; }

/* Totals */
.totals-section { padding: 22px 28px; }
.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.total-row:last-child { margin-bottom: 0; }
.total-label { font-size:14px;color:rgba(240,237,232,0.6); }
.total-value { font-size:14px;font-weight:600;color:#DDB892; }
.grand-label { font-size:20px;font-weight:800;color:#F0EDE8; }
.grand-value { font-size:22px;font-weight:800;color:#DDB892; }

/* Sticky bottom */
.sticky-bottom {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    z-index: 30;
    background: #1C1A17;
    border-top: 1px solid #3A3733;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 64px;
}
.checkout-btn {
    background: #DDB892;
    color: #1C1A17;
    font-weight: 700;
    font-size: 15px;
    border: none;
    border-radius: 14px;
    padding: 16px 52px;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    transition: opacity 0.15s;
}
.checkout-btn:hover { opacity: 0.87; }
</style>
@endpush

@section('content')

<div style="padding: 32px 48px 120px; max-width: 800px; margin: 0 auto;">
    <form action="{{ route('user.checkout.store') }}" method="POST" id="checkoutForm">
        @csrf

        <div class="checkout-card">

            {{-- Header --}}
            <div style="padding: 20px 28px; border-bottom: 1px solid #3A3733; display:flex; align-items:center; gap:12px;">
                <span style="font-size:19px;font-weight:700;color:#F0EDE8;">Order Summary</span>
                <span style="width:6px;height:6px;border-radius:50%;background:rgba(240,237,232,0.3);display:inline-block;flex-shrink:0;"></span>
                <span style="font-size:14px;color:rgba(240,237,232,0.4);">{{ count($cart) }} Item</span>
            </div>

            {{-- Cart items --}}
            @foreach($cart as $item)
            <div class="item-row">
                <div class="item-thumb">
                    <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}">
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:14px;font-weight:600;color:#DDB892;margin-bottom:3px;">{{ $item['name'] }}</div>
                    @if($item['options'])
                        <div style="font-size:12px;color:rgba(240,237,232,0.4);line-height:1.5;">{{ $item['options'] }}</div>
                    @endif
                    @if($item['notes'])
                        <div style="font-size:12px;color:rgba(240,237,232,0.55);margin-top:2px;">Note: {{ $item['notes'] }}</div>
                    @endif
                </div>
                <span style="font-size:14px;font-weight:700;color:#DDB892;flex-shrink:0;">
                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                </span>
            </div>
            @endforeach

            {{-- Payment Method --}}
            <div class="dropdown-row">
                <span class="dropdown-row-label">Payment Method</span>
                <div class="custom-select-wrap">
                    <select name="payment_method" class="custom-select">
                        <option value="">Choose</option>
                        <option value="Cash">Cash</option>
                        <option value="QRIS">QRIS</option>
                        <option value="Transfer">Transfer</option>
                    </select>
                    <svg class="select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
            </div>

            {{-- Order Type --}}
            <div class="dropdown-row">
                <span class="dropdown-row-label">Order Type</span>
                <div class="custom-select-wrap">
                    <select name="order_type" class="custom-select">
                        <option value="Dine In">Dine In</option>
                        <option value="Takeaway">Takeaway</option>
                    </select>
                    <svg class="select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
            </div>

            {{-- Name --}}
            <div class="name-section">
                <div class="name-label-row">
                    <span class="name-label">Name</span>
                    <span class="name-required">Required</span>
                </div>
                <input type="text"
                       name="customer_name"
                       class="name-input"
                       placeholder="Write Your Name"
                       autocomplete="off">
            </div>

            {{-- Totals --}}
            <div class="totals-section">
                <div class="total-row">
                    <span class="total-label">Subtotal</span>
                    <span class="total-value">Rp {{ number_format($subtotal,0,',','.') }}</span>
                </div>
                <div class="total-row" style="margin-bottom:18px;">
                    <span class="total-label">PPN (10%)</span>
                    <span class="total-value">Rp {{ number_format($tax,0,',','.') }}</span>
                </div>
                <div class="total-row">
                    <span class="grand-label">Total</span>
                    <span class="grand-value">Rp {{ number_format($total,0,',','.') }}</span>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- Sticky bottom bar --}}
<div class="sticky-bottom">
    <span style="font-size:34px;font-weight:800;color:#DDB892;">
        Rp {{ number_format($total,0,',','.') }}
    </span>
    <button type="submit" form="checkoutForm" class="checkout-btn">
        Checkout
    </button>
</div>

@endsection
