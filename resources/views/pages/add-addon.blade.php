@extends('layouts.app')
@section('title','Add Add-On')
@section('page-title','Add Add-On')
@section('page-subtitle','Create additional options that can be added to menu items')

@section('content')

<style>
@keyframes fadeIn {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes slideUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes slideDown {
    from { opacity:1; transform:translateY(0); }
    to   { opacity:0; transform:translateY(20px); }
}

.addon-card {
    background:#fff;
    border-radius:1rem;
    border:1.5px solid #EDE8E0;
    padding:2rem;
}

.form-label {
    display:block;
    font-size:13px;
    font-weight:600;
    color:#374151;
    margin-bottom:0.5rem;
}

.form-input {
    width:100%;
    padding:0.65rem 1rem;
    border-radius:0.75rem;
    border:1.5px solid #E5DDD5;
    font-size:13px;
    color:#374151;
    background:#fff;
    outline:none;
    transition:border-color .2s, box-shadow .2s;
    box-sizing:border-box;
}
.form-input:focus {
    border-color:#8B5E1A;
    box-shadow:0 0 0 3px rgba(139,94,26,.08);
}

.form-select {
    width:100%;
    padding:0.65rem 2.25rem 0.65rem 1rem;
    border-radius:0.75rem;
    border:1.5px solid #E5DDD5;
    font-size:13px;
    color:#374151;
    background:#fff;
    outline:none;
    appearance:none;
    -webkit-appearance:none;
    cursor:pointer;
    background-image:url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 12px center;
    transition:border-color .2s, box-shadow .2s;
    box-sizing:border-box;
}
.form-select:focus {
    border-color:#8B5E1A;
    box-shadow:0 0 0 3px rgba(139,94,26,.08);
}

.btn-cancel {
    display:inline-flex; align-items:center; gap:0.5rem;
    padding:0.65rem 1.5rem;
    border-radius:0.875rem;
    background:#fff;
    border:1.5px solid #E5DDD5;
    color:#6b7280;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    text-decoration:none;
    transition:background .2s, border-color .2s;
}
.btn-cancel:hover {
    background:#F9F5F1;
    border-color:#C49060;
    color:#8B5E1A;
}

.btn-save {
    display:inline-flex; align-items:center; gap:0.5rem;
    padding:0.65rem 1.5rem;
    border-radius:0.875rem;
    background:#8B5E1A;
    border:1.5px solid #8B5E1A;
    color:#fff;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:background .2s;
}
.btn-save:hover { background:#7a4f14; border-color:#7a4f14; }

.section-divider {
    border:none;
    border-top:1.5px solid #F0EBE3;
    margin:1.75rem 0;
}

.addon-table { width:100%; border-collapse:collapse; }
.addon-table th {
    background:#FDFAF7;
    font-size:12px;
    font-weight:600;
    color:#9ca3af;
    text-transform:uppercase;
    letter-spacing:.04em;
    padding:10px 14px;
    text-align:left;
    border-bottom:1.5px solid #F0EBE3;
}
.addon-table td {
    padding:11px 14px;
    font-size:13px;
    color:#374151;
    border-bottom:1px solid #F5F0EB;
    vertical-align:middle;
}
.addon-table tbody tr:hover { background:#FDFAF7; }
.addon-table tbody tr:last-child td { border-bottom:none; }

.badge-available {
    display:inline-block; padding:3px 10px; border-radius:999px;
    background:#F0FDF4; border:1.5px solid #86EFAC;
    color:#16a34a; font-size:11px; font-weight:600;
}
.badge-unavailable {
    display:inline-block; padding:3px 10px; border-radius:999px;
    background:#FFF5F5; border:1.5px solid #FECACA;
    color:#ef4444; font-size:11px; font-weight:600;
}

.tbl-action {
    width:30px; height:30px; border-radius:7px; border:1.5px solid #E5DDD5;
    background:#fff; display:inline-flex; align-items:center; justify-content:center;
    cursor:pointer; transition:background .15s, border-color .15s;
}
.tbl-action:hover { background:#FDF6EE; border-color:#C49060; }
.tbl-action.del:hover { background:#FFF5F5; border-color:#FECACA; }

/* ══ TOAST ══ */
.toast {
    position:fixed;
    bottom:2rem;
    right:2rem;
    z-index:99999;
    display:flex;
    align-items:center;
    gap:0.875rem;
    padding:1rem 1.25rem;
    border-radius:1rem;
    box-shadow:0 8px 32px rgba(0,0,0,.12);
    min-width:280px;
    max-width:380px;
    animation: slideUp .35s cubic-bezier(.16,1,.3,1) both;
}
.toast.success { background:#fff; border:1.5px solid #86EFAC; }
.toast.error   { background:#fff; border:1.5px solid #FECACA; }
.toast-icon {
    width:38px; height:38px; border-radius:50%;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.toast.success .toast-icon { background:#F0FDF4; }
.toast.error   .toast-icon { background:#FFF5F5; }
.toast-title { font-size:13px; font-weight:700; color:#1f2937; margin:0 0 2px; }
.toast-msg   { font-size:12px; color:#6b7280; margin:0; }
.toast-close {
    margin-left:auto; background:none; border:none;
    cursor:pointer; color:#9ca3af; padding:4px; flex-shrink:0;
    display:flex; align-items:center; border-radius:6px; transition:background .15s;
}
.toast-close:hover { background:#f3f4f6; color:#374151; }
</style>

{{-- ══ TOAST SUCCESS ══ --}}
@if(session('success'))
<div class="toast success" id="toast">
    <div class="toast-icon">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
            <circle cx="9" cy="9" r="8" fill="#16a34a" opacity=".15"/>
            <path d="M5 9.5l3 3 5-6" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div style="flex:1;">
        <p class="toast-title">Berhasil!</p>
        <p class="toast-msg">{{ session('success') }}</p>
    </div>
    <button class="toast-close" onclick="closeToast('toast')">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
        </svg>
    </button>
</div>
@endif

{{-- ══ TOAST ERROR ══ --}}
@if(session('error'))
<div class="toast error" id="toast-error">
    <div class="toast-icon">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
            <circle cx="9" cy="9" r="8" fill="#ef4444" opacity=".15"/>
            <path d="M6 6l6 6M12 6l-6 6" stroke="#ef4444" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
    </div>
    <div style="flex:1;">
        <p class="toast-title">Gagal!</p>
        <p class="toast-msg">{{ session('error') }}</p>
    </div>
    <button class="toast-close" onclick="closeToast('toast-error')">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
        </svg>
    </button>
</div>
@endif

<script>
function closeToast(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.animation = 'slideDown .3s ease forwards';
    setTimeout(() => el.remove(), 300);
}
document.addEventListener('DOMContentLoaded', function () {
    ['toast', 'toast-error'].forEach(id => {
        const el = document.getElementById(id);
        if (el) setTimeout(() => closeToast(id), 3500);
    });
});
</script>

<div style="animation: fadeIn .3s ease both; max-width:860px;">

    {{-- ══ Back breadcrumb ══ --}}
    <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:1.25rem;">
        <a href="{{ route('menu-management') }}"
           style="display:inline-flex; align-items:center; gap:0.375rem;
                  color:#8B5E1A; font-size:13px; font-weight:500; text-decoration:none;
                  padding:5px 12px; border-radius:8px; border:1.5px solid #E5DDD5;
                  background:#fff; transition:background .15s, border-color .15s;"
           onmouseover="this.style.background='#FDF6EE'; this.style.borderColor='#C49060'"
           onmouseout="this.style.background='#fff'; this.style.borderColor='#E5DDD5'">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none">
                <path d="M6 1L1 6l5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
            </svg>
            Back to Menu Management
        </a>
    </div>

    {{-- ══ Form Card ══ --}}
    <div class="addon-card" style="margin-bottom:1.5rem;">
        <div style="margin-bottom:1.5rem;">
            <h2 style="font-size:15px; font-weight:700; color:#1f2937; margin:0 0 4px;">Add New Add-On</h2>
            <p style="font-size:13px; color:#9ca3af; margin:0;">Create additional options that can be added to menu items</p>
        </div>

        <hr class="section-divider" style="margin-top:0;">

        <form method="POST" action="{{ route('addon.store') }}">
            @csrf

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
                <div>
                    <label class="form-label" for="addon_name">Add-On Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" id="addon_name" name="name" class="form-input"
                           placeholder="e.g. Extra Shot, Oat Milk..."
                           value="{{ old('name') }}" required>
                    @error('name')
                        <p style="color:#ef4444; font-size:12px; margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label" for="addon_price">Price <span style="color:#ef4444;">*</span></label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%);
                                     font-size:13px; color:#9ca3af; font-weight:500; pointer-events:none;">Rp</span>
                        <input type="number" id="addon_price" name="price" class="form-input"
                               placeholder="0" style="padding-left:2rem;"
                               value="{{ old('price') }}" min="0" required>
                    </div>
                    @error('price')
                        <p style="color:#ef4444; font-size:12px; margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom:1.75rem; max-width:calc(50% - 0.625rem);">
                <label class="form-label" for="addon_status">Status <span style="color:#ef4444;">*</span></label>
                <select id="addon_status" name="status" class="form-select" required>
                    <option value="">— Select status —</option>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Not Available</option>
                </select>
                @error('status')
                    <p style="color:#ef4444; font-size:12px; margin:4px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display:flex; align-items:center; justify-content:flex-end; gap:0.75rem;">
                <a href="{{ route('menu-management') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">
                    <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                        <path d="M2 7.5l3.5 3.5L12 3" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Save Add-On
                </button>
            </div>
        </form>
    </div>

    {{-- ══ Existing Add-Ons List ══ --}}
    <div class="addon-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;">
            <div>
                <h2 style="font-size:15px; font-weight:700; color:#1f2937; margin:0 0 3px;">Existing Add-Ons</h2>
                <p style="font-size:12px; color:#9ca3af; margin:0;">{{ count($addons ?? []) }} add-ons registered</p>
            </div>
            <div style="position:relative;">
                <svg style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#9ca3af; pointer-events:none;"
                     width="13" height="13" viewBox="0 0 16 16" fill="none">
                    <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M10.5 10.5l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <input type="text" placeholder="Search add-ons..."
                       style="padding:0.5rem 1rem 0.5rem 2rem; border-radius:0.75rem;
                              border:1.5px solid #E5DDD5; font-size:12px; color:#374151;
                              background:#fff; outline:none; width:200px; transition:border-color .2s;"
                       onfocus="this.style.borderColor='#8B5E1A'"
                       onblur="this.style.borderColor='#E5DDD5'">
            </div>
        </div>

        <div style="border-radius:0.75rem; border:1.5px solid #EDE8E0; overflow:hidden;">
            <table class="addon-table">
                <thead>
                    <tr>
                        <th style="width:40%;">Add-On Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th style="width:100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($addons ?? [] as $addon)
                    <tr>
                        <td style="font-weight:500;">{{ $addon->name }}</td>
                        <td>Rp {{ number_format($addon->price, 0, ',', '.') }}</td>
                        <td>
                            @if($addon->status === 'available')
                                <span class="badge-available">Available</span>
                            @else
                                <span class="badge-unavailable">Not Available</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:5px; align-items:center;">
                                <button class="tbl-action" title="Edit">
                                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                                        <path d="M11 2l3 3-9 9H2v-3l9-9z" stroke="#6b7280"
                                              stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"/>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('addon.destroy', $addon->id) }}"
                                      onsubmit="return confirm('Hapus add-on ini?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="tbl-action del" title="Delete">
                                        <svg width="12" height="13" viewBox="0 0 14 16" fill="none">
                                            <path d="M1 4h12M5 4V2h4v2M6 7v5M8 7v5M2 4l1 10h8l1-10"
                                                  stroke="#ef4444" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:2.5rem 1rem; color:#9ca3af;">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" style="display:block; margin:0 auto 0.75rem; opacity:.4;">
                                <path d="M12 5v14M5 12h14" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            No add-ons yet. Create your first one above.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection