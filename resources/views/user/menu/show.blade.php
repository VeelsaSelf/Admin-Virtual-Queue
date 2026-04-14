@extends('user.layouts.app')
@section('title', $item['name'].' – Mau Kopi')

@push('styles')
<style>
.opt-label { color: rgba(240,237,232,0.65); font-size:14px; cursor:pointer; transition:color 0.12s; }
.opt-label.active { color: #DDB892; }
.opt-row { display:flex;align-items:center;justify-content:space-between;padding:7px 0; }
.opt-left { display:flex;align-items:center;gap:12px; }
.opt-price { font-size:13px;color:rgba(240,237,232,0.4); }
.section-divider { border:none;border-top:1px solid #3A3733;margin:4px 0 16px; }
.opt-section-title { font-size:15px;font-weight:600;color:#F0EDE8;margin-bottom:12px; }
.sticky-bottom {
    position:fixed;bottom:0;left:0;right:0;z-index:20;
    background:#1C1917;
    border-top:1px solid #3A3733;
    display:flex;align-items:center;justify-content:space-between;
    padding:16px 48px;
}
.qty-btn {
    width:34px;height:34px;border-radius:50%;
    border:1.5px solid rgba(240,237,232,0.25);
    background:transparent;color:rgba(240,237,232,0.7);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;transition:all 0.15s;font-size:18px;line-height:1;
}
.qty-btn:hover { border-color:#DDB892;color:#DDB892; }
.add-btn {
    background:#DDB892;color:#1C1917;
    font-weight:700;font-size:14px;
    padding:14px 32px;border-radius:14px;
    border:none;cursor:pointer;transition:opacity 0.15s;
}
.add-btn:hover { opacity:0.85; }
.notes-input {
    width:100%;background:transparent;
    border:1.5px solid #3A3733;
    border-radius:12px;padding:12px 16px;
    color:#F0EDE8;font-size:13px;font-family:'Inter',sans-serif;
    outline:none;transition:border-color 0.15s;
}
.notes-input:focus { border-color:#DDB892; }
.notes-input::placeholder { color:rgba(240,237,232,0.25); }
</style>
@endpush

@section('content')

<div style="max-width:1100px;margin:0 auto;padding:36px 48px 120px;">
    <div style="display:flex;gap:56px;align-items:flex-start;">

        {{-- Image --}}
        <div style="flex-shrink:0;width:46%;">
            <div style="border-radius:20px;overflow:hidden;aspect-ratio:1/1;">
                <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
        </div>

        {{-- Detail --}}
        <div style="flex:1;">
            {{-- Breadcrumb --}}
            <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:rgba(240,237,232,0.38);margin-bottom:16px;">
                <a href="{{ route('user.menu.index') }}" style="color:rgba(240,237,232,0.38);text-decoration:none;hover:color:white;">Menu</a>
                <span>/</span>
                <span>{{ $item['cat'] }}</span>
            </div>

            <h1 style="font-size:38px;font-weight:800;color:#F0EDE8;margin-bottom:10px;">{{ $item['name'] }}</h1>
            <p style="font-size:13.5px;color:rgba(240,237,232,0.45);margin-bottom:28px;line-height:1.6;">{{ $item['desc'] }}</p>

            <form action="{{ route('user.cart.add') }}" method="POST" id="cartForm">
                @csrf
                <input type="hidden" name="name"  value="{{ $item['name'] }}">
                <input type="hidden" name="img"   value="{{ $item['img'] }}">
                <input type="hidden" name="price" id="fPrice" value="{{ $item['price'] }}">
                <input type="hidden" name="qty"   id="fQty"   value="1">

                {{-- SIZE --}}
                @if(!empty($item['sizes']))
                <div>
                    <hr class="section-divider">
                    <div class="opt-section-title">Size</div>
                    @foreach($item['sizes'] as $sz)
                    <div class="opt-row">
                        <label class="opt-left" style="cursor:pointer;">
                            <input type="radio" name="size" value="{{ $sz['label'] }}"
                                   data-extra="{{ $sz['price'] }}"
                                   class="size-r" {{ $loop->first?'checked':'' }}>
                            <span class="opt-label {{ $loop->first?'active':'' }}">{{ $sz['label'] }}</span>
                        </label>
                        @if($sz['price']>0)<span class="opt-price">+{{ number_format($sz['price'],0,',','.') }}</span>@endif
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- SUGAR --}}
                @if(!empty($item['sugar']))
                <div>
                    <hr class="section-divider">
                    <div class="opt-section-title">Sugar Level</div>
                    @foreach($item['sugar'] as $sg)
                    <div class="opt-row">
                        <label class="opt-left" style="cursor:pointer;">
                            <input type="radio" name="sugar" value="{{ $sg }}" {{ $loop->first?'checked':'' }}>
                            <span class="opt-label {{ $loop->first?'active':'' }}">{{ $sg }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- ICE --}}
                @if(!empty($item['ice']))
                <div>
                    <hr class="section-divider">
                    <div class="opt-section-title">Ice Level</div>
                    @foreach($item['ice'] as $ic)
                    <div class="opt-row">
                        <label class="opt-left" style="cursor:pointer;">
                            <input type="radio" name="ice" value="{{ $ic }}" {{ $loop->first?'checked':'' }}>
                            <span class="opt-label {{ $loop->first?'active':'' }}">{{ $ic }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- RICE --}}
                @if(!empty($item['rice']))
                <div>
                    <hr class="section-divider">
                    <div class="opt-section-title">Rice Type</div>
                    @foreach($item['rice'] as $rc)
                    <div class="opt-row">
                        <label class="opt-left" style="cursor:pointer;">
                            <input type="radio" name="rice" value="{{ $rc }}" {{ $loop->first?'checked':'' }}>
                            <span class="opt-label {{ $loop->first?'active':'' }}">{{ $rc }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- SPICY --}}
                @if(!empty($item['spicy']))
                <div>
                    <hr class="section-divider">
                    <div class="opt-section-title">Spicy Level</div>
                    @foreach($item['spicy'] as $sp)
                    <div class="opt-row">
                        <label class="opt-left" style="cursor:pointer;">
                            <input type="radio" name="spicy" value="{{ $sp }}" {{ $loop->first?'checked':'' }}>
                            <span class="opt-label {{ $loop->first?'active':'' }}">{{ $sp }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- SERVE --}}
                @if(!empty($item['serve']))
                <div>
                    <hr class="section-divider">
                    <div class="opt-section-title">Serve Option</div>
                    @foreach($item['serve'] as $sv)
                    <div class="opt-row">
                        <label class="opt-left" style="cursor:pointer;">
                            <input type="radio" name="serve" value="{{ $sv }}" {{ $loop->first?'checked':'' }}>
                            <span class="opt-label {{ $loop->first?'active':'' }}">{{ $sv }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- ADD-ONS --}}
                @if(!empty($item['addons']))
                <div>
                    <hr class="section-divider">
                    <div class="opt-section-title">Add-ons</div>
                    @foreach($item['addons'] as $ad)
                    <div class="opt-row">
                        <label class="opt-left" style="cursor:pointer;">
                            <input type="checkbox" name="addons[]" value="{{ $ad['label'] }}"
                                   data-extra="{{ $ad['price'] }}" class="addon-c">
                            <span class="opt-label">{{ $ad['label'] }}</span>
                        </label>
                        <span class="opt-price">+{{ number_format($ad['price'],0,',','.') }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- NOTES --}}
                <div>
                    <hr class="section-divider">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <span class="opt-section-title" style="margin-bottom:0;">Catatan</span>
                        <span style="font-size:11px;color:rgba(240,237,232,0.35);">Opsional</span>
                    </div>
                    <input type="text" name="notes" class="notes-input" placeholder="Tulis catatan">
                </div>

            </form>
        </div>
    </div>
</div>

{{-- STICKY BOTTOM --}}
<div class="sticky-bottom">
    <div>
        <span id="dispPrice" style="font-size:32px;font-weight:800;color:#DDB892;">
            Rp {{ number_format($item['price'],0,',','.') }}
        </span>
    </div>
    <div style="display:flex;align-items:center;gap:20px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="qty-btn" onclick="chQty(-1)">−</button>
            <span id="qtyDisp" style="font-size:17px;font-weight:600;color:#F0EDE8;min-width:20px;text-align:center;">1</span>
            <button type="button" class="qty-btn" onclick="chQty(1)">+</button>
        </div>
        <button type="submit" form="cartForm" class="add-btn">Masukkan Keranjang</button>
    </div>
</div>

@endsection

@push('scripts')
<script>
const base = {{ $item['price'] }};
let qty = 1;

function getExtra(){
    let e = 0;
    document.querySelectorAll('.size-r:checked').forEach(r => e += parseInt(r.dataset.extra||0));
    document.querySelectorAll('.addon-c:checked').forEach(r => e += parseInt(r.dataset.extra||0));
    return e;
}
function refresh(){
    const total = (base + getExtra()) * qty;
    document.getElementById('dispPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('fPrice').value = base + getExtra();
    document.getElementById('fQty').value = qty;
}
function chQty(d){
    qty = Math.max(1, qty + d);
    document.getElementById('qtyDisp').textContent = qty;
    refresh();
}

// Radio highlight
document.querySelectorAll('input[type="radio"]').forEach(r => {
    r.addEventListener('change', function(){
        const grp = this.name;
        document.querySelectorAll(`input[name="${grp}"]`).forEach(x => {
            const lbl = x.closest('label')?.querySelector('.opt-label');
            if(lbl){ lbl.classList.remove('active'); }
        });
        const myLbl = this.closest('label')?.querySelector('.opt-label');
        if(myLbl) myLbl.classList.add('active');
        refresh();
    });
});
document.querySelectorAll('.addon-c').forEach(c => c.addEventListener('change', refresh));
</script>
@endpush
