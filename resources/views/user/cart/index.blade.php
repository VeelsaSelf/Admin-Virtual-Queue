@extends('user.layouts.app')
@section('title','Pesanan – Mau Kopi')

@push('styles')
<style>
.cart-card {
    background:#252220;
    border:1px solid #3A3733;
    border-radius:20px;
    overflow:hidden;
    max-width:860px;
    margin:0 auto;
}
.cart-header {
    padding:22px 28px;
    border-bottom:1px solid #3A3733;
    display:flex;align-items:center;gap:12px;
}
.cart-item {
    display:flex;align-items:center;gap:16px;
    padding:20px 28px;
    border-bottom:1px solid #3A3733;
}
.cart-item:last-child { border-bottom:none; }
.item-img {
    width:64px;height:64px;
    border-radius:12px;overflow:hidden;flex-shrink:0;
}
.item-img img { width:100%;height:100%;object-fit:cover; }
.qty-ctrl {
    width:30px;height:30px;border-radius:50%;
    border:1.5px solid rgba(240,237,232,0.2);
    background:transparent;color:rgba(240,237,232,0.6);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:16px;line-height:1;
    transition:all 0.15s;
}
.qty-ctrl:hover { border-color:#DDB892;color:#DDB892; }
.ubah-btn {
    padding:5px 14px;border-radius:50px;
    border:1.5px solid #3A3733;
    background:transparent;color:rgba(240,237,232,0.45);
    font-size:12px;font-family:'Inter',sans-serif;
    cursor:pointer;transition:all 0.15s;
}
.ubah-btn:hover { border-color:#DDB892;color:#DDB892; }
.bottom-bar {
    position:fixed;bottom:0;left:0;right:0;z-index:20;
    background:#1C1917;border-top:1px solid #3A3733;
    display:flex;align-items:center;justify-content:space-between;
    padding:18px 56px;
}
</style>
@endpush

@section('content')

<div style="padding:36px 48px 120px;max-width:960px;margin:0 auto;">

    @if(empty($cart))
        <div style="text-align:center;padding:80px 0;">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="rgba(240,237,232,0.18)" stroke-width="1.5" style="margin:0 auto 16px;display:block;">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
            </svg>
            <p style="color:rgba(240,237,232,0.3);font-size:16px;margin-bottom:6px;">Empty Cart</p>
            <p style="color:rgba(240,237,232,0.2);font-size:13px;margin-bottom:24px;">Let's add the menu first</p>
            <a href="{{ route('user.menu.index') }}" class="btn-accent" style="display:inline-block;padding:12px 28px;border-radius:14px;text-decoration:none;font-size:14px;">
                see the menu
            </a>
        </div>
    @else

        <div class="cart-card">
            <div class="cart-header">
                <span style="font-size:20px;font-weight:700;color:#F0EDE8;">Pesanan</span>
                <span style="width:6px;height:6px;border-radius:50%;background:rgba(240,237,232,0.3);display:inline-block;"></span>
                <span style="font-size:14px;color:rgba(240,237,232,0.4);">{{ count($cart) }} Item</span>
            </div>

            @foreach($cart as $id => $item)
            <div class="cart-item">
                <div class="item-img">
                    <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}">
                </div>

                <div style="flex:1;min-width:0;">
                    <div style="font-weight:600;font-size:14px;color:#DDB892;margin-bottom:3px;">{{ $item['name'] }}</div>
                    @if($item['options'])
                        <div style="font-size:11.5px;color:rgba(240,237,232,0.38);margin-bottom:2px;">{{ $item['options'] }}</div>
                    @endif
                    @if($item['notes'])
                        <div style="font-size:11.5px;color:#DDB892;">Catatan: {{ $item['notes'] }}</div>
                    @endif
                </div>

                {{-- Qty controls --}}
                <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
                    <form action="{{ route('user.cart.update') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="action" value="decrease">
                        <button type="submit" class="qty-ctrl">−</button>
                    </form>

                    <span style="font-size:14px;font-weight:600;color:#F0EDE8;min-width:16px;text-align:center;">{{ $item['qty'] }}</span>

                    <form action="{{ route('user.cart.update') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="action" value="increase">
                        <button type="submit" class="qty-ctrl">+</button>
                    </form>

                    <span style="font-size:14px;font-weight:700;color:#DDB892;min-width:90px;text-align:right;">
                        Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}
                    </span>

                    <button class="ubah-btn">Ubah</button>
                </div>
            </div>
            @endforeach
        </div>

    @endif
</div>

@if(!empty($cart))
<div class="bottom-bar">
    <span style="font-size:34px;font-weight:800;color:#DDB892;">Rp {{ number_format($total,0,',','.') }}</span>
    <a href="{{ route('user.checkout.index') }}" class="btn-accent" style="display:inline-block;padding:16px 44px;font-size:15px;text-decoration:none;border-radius:16px;">
        Lanjutkan
    </a>
</div>
@endif

@endsection
