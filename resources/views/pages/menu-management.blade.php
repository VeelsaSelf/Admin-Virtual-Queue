@extends('layouts.app')
@section('title','Menu Management')
@section('page-title','Menu Management')
@section('page-subtitle','Add, edit, and organize menu items for your café')

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
@keyframes modalIn {
    from { opacity:0; transform:scale(.97) translateY(10px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}

.menu-table { width:100%; border-collapse:collapse; }
.menu-table th {
    background:#fff; font-size:13px; font-weight:600; color:#374151;
    padding:12px 16px; text-align:left; border-bottom:1.5px solid #F0EBE3;
    white-space:nowrap; user-select:none;
}
.menu-table td {
    padding:12px 16px; font-size:13px; color:#374151;
    border-bottom:1px solid #F5F0EB; vertical-align:middle;
}
.menu-table tbody tr { transition:background .15s; }
.menu-table tbody tr:hover { background:#FDFAF7; }

.sort-icon { display:inline-flex; flex-direction:column; gap:1px; margin-left:6px; vertical-align:middle; }
.sort-icon span { display:block; width:0; height:0; }
.sort-icon .up   { border-left:4px solid transparent; border-right:4px solid transparent; border-bottom:4px solid #9ca3af; }
.sort-icon .down { border-left:4px solid transparent; border-right:4px solid transparent; border-top:4px solid #9ca3af; }

.action-btn {
    width:32px; height:32px; border-radius:8px; border:1.5px solid #E5DDD5;
    background:#fff; display:inline-flex; align-items:center; justify-content:center;
    cursor:pointer; transition:background .15s, border-color .15s;
}
.action-btn:hover { background:#FDF6EE; border-color:#C49060; }
.action-btn.delete:hover { background:#FFF5F5; border-color:#FCA5A5; }

.custom-checkbox {
    width:17px; height:17px; border-radius:4px; border:1.5px solid #D1C4B8;
    appearance:none; -webkit-appearance:none; cursor:pointer;
    transition:background .15s, border-color .15s; flex-shrink:0;
}
.custom-checkbox:checked {
    background:#8B5E1A; border-color:#8B5E1A;
    background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 10 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 4l3 3 5-6' stroke='white' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:center; background-size:65%;
}
.page-btn {
    width:36px; height:36px; border-radius:8px; border:1.5px solid #E5DDD5;
    background:#fff; font-size:13px; font-weight:500; color:#6b7280;
    display:inline-flex; align-items:center; justify-content:center; cursor:pointer;
    transition:background .15s, border-color .15s;
}
.page-btn:hover { background:#FDF6EE; border-color:#C49060; color:#8B5E1A; }
.page-btn.active { background:#8B5E1A; border-color:#8B5E1A; color:#fff; font-weight:700; }
.page-btn:disabled { opacity:.4; cursor:default; }

/* ── Modal shared ── */
.modal-overlay {
    display:none; position:fixed; inset:0; z-index:9000;
    background:rgba(0,0,0,.35); backdrop-filter:blur(2px);
    align-items:center; justify-content:center;
}
.modal-overlay.open { display:flex; }
.modal-box {
    background:#fff; border-radius:1.25rem; padding:2rem;
    width:100%; max-width:600px;
    box-shadow:0 24px 64px rgba(0,0,0,.18);
    animation: modalIn .25s cubic-bezier(.16,1,.3,1) both;
    position:relative;
}
.modal-close-btn {
    position:absolute; top:1.25rem; right:1.25rem;
    width:30px; height:30px; border-radius:8px; border:1.5px solid #E5DDD5;
    background:#fff; display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:background .15s;
}
.modal-close-btn:hover { background:#f3f4f6; }

/* ── Add Add-On modal inputs ── */
.modal-input {
    width:100%; padding:0.65rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; font-size:13px; color:#374151;
    background:#fff; outline:none; transition:border-color .2s, box-shadow .2s;
    box-sizing:border-box;
}
.modal-input:focus { border-color:#8B5E1A; box-shadow:0 0 0 3px rgba(139,94,26,.08); }
.modal-select {
    width:100%; padding:0.65rem 2.25rem 0.65rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; font-size:13px; color:#374151;
    background:#fff; outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;
    background-image:url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 12px center;
    transition:border-color .2s, box-shadow .2s; box-sizing:border-box;
}
.modal-select:focus { border-color:#8B5E1A; box-shadow:0 0 0 3px rgba(139,94,26,.08); }

/* ── View modal info box ── */
.view-info-box {
    padding:0.65rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; background:#FAFAF9;
    font-size:13px; color:#374151;
}
.view-addon-row {
    display:flex; justify-content:space-between; align-items:center;
    padding:10px 0; border-bottom:1px solid #F0EBE3; font-size:13px;
}
.view-addon-row:last-child { border-bottom:none; }

/* ── Toast ── */
.toast {
    position:fixed; bottom:2rem; right:2rem; z-index:99999;
    display:flex; align-items:center; gap:0.875rem;
    padding:1rem 1.25rem; border-radius:1rem;
    box-shadow:0 8px 32px rgba(0,0,0,.12);
    min-width:280px; max-width:380px;
    animation: slideUp .35s cubic-bezier(.16,1,.3,1) both;
}
.toast.success { background:#fff; border:1.5px solid #86EFAC; }
.toast.error   { background:#fff; border:1.5px solid #FECACA; }
.toast-icon { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.toast.success .toast-icon { background:#F0FDF4; }
.toast.error   .toast-icon { background:#FFF5F5; }
.toast-title { font-size:13px; font-weight:700; color:#1f2937; margin:0 0 2px; }
.toast-msg   { font-size:12px; color:#6b7280; margin:0; }
.toast-close { margin-left:auto; background:none; border:none; cursor:pointer; color:#9ca3af; padding:4px; flex-shrink:0; display:flex; align-items:center; border-radius:6px; transition:background .15s; }
.toast-close:hover { background:#f3f4f6; color:#374151; }
</style>

{{-- ══ TOAST ══ --}}
@if(session('success'))
<div class="toast success" id="toast">
    <div class="toast-icon">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
            <circle cx="9" cy="9" r="8" fill="#16a34a" opacity=".15"/>
            <path d="M5 9.5l3 3 5-6" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div style="flex:1;"><p class="toast-title">Berhasil!</p><p class="toast-msg">{{ session('success') }}</p></div>
    <button class="toast-close" onclick="closeToast('toast')">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
    </button>
</div>
@endif
@if(session('error'))
<div class="toast error" id="toast-error">
    <div class="toast-icon">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
            <circle cx="9" cy="9" r="8" fill="#ef4444" opacity=".15"/>
            <path d="M6 6l6 6M12 6l-6 6" stroke="#ef4444" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
    </div>
    <div style="flex:1;"><p class="toast-title">Gagal!</p><p class="toast-msg">{{ session('error') }}</p></div>
    <button class="toast-close" onclick="closeToast('toast-error')">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
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
    ['toast','toast-error'].forEach(id => {
        const el = document.getElementById(id);
        if (el) setTimeout(() => closeToast(id), 3500);
    });
});
</script>

{{-- ══ ADD ADD-ON MODAL ══ --}}
<div class="modal-overlay" id="addonModal" onclick="if(event.target===this) closeAddonModal()">
    <div class="modal-box">
        <button class="modal-close-btn" onclick="closeAddonModal()">
            <svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="#6b7280" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>
        <div style="margin-bottom:1.5rem;">
            <h2 style="font-size:16px; font-weight:700; color:#1f2937; margin:0 0 4px;">Add New Add-On</h2>
            <p style="font-size:13px; color:#9ca3af; margin:0;">Create additional options that can be added to menu items</p>
        </div>
        <form method="POST" action="{{ route('addon.store') }}">
            @csrf
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:0.5rem;">Add-On Name</label>
                    <input type="text" name="name" class="modal-input" placeholder="e.g. Americano" value="{{ old('name') }}" required>
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:0.5rem;">Price</label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:13px; color:#9ca3af; font-weight:500; pointer-events:none;">Rp</span>
                        <input type="number" name="price" class="modal-input" placeholder="0" style="padding-left:2rem;" value="{{ old('price') }}" min="0" required>
                    </div>
                </div>
            </div>
            <div style="margin-bottom:2rem;">
                <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:0.5rem;">Status</label>
                <select name="status" class="modal-select" required>
                    <option value="">— Select status —</option>
                    <option value="available" {{ old('status')=='available'?'selected':'' }}>Available</option>
                    <option value="unavailable" {{ old('status')=='unavailable'?'selected':'' }}>Not Available</option>
                </select>
            </div>
            <div style="display:flex; align-items:center; justify-content:flex-end; gap:0.75rem;">
                <button type="button" onclick="closeAddonModal()"
                        style="display:inline-flex; align-items:center; padding:0.65rem 1.5rem; border-radius:0.875rem;
                               background:#fff; border:1.5px solid #E5DDD5; color:#6b7280;
                               font-size:13px; font-weight:600; cursor:pointer; transition:background .2s, border-color .2s;"
                        onmouseover="this.style.background='#F9F5F1';this.style.borderColor='#C49060'"
                        onmouseout="this.style.background='#fff';this.style.borderColor='#E5DDD5'">
                    Cancel
                </button>
                <button type="submit"
                        style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.65rem 1.5rem;
                               border-radius:0.875rem; background:#8B5E1A; border:1.5px solid #8B5E1A;
                               color:#fff; font-size:13px; font-weight:600; cursor:pointer; transition:background .2s;"
                        onmouseover="this.style.background='#7a4f14'" onmouseout="this.style.background='#8B5E1A'">
                    <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                        <path d="M2 7.5l3.5 3.5L12 3" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Save Add-On
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══ VIEW MENU MODAL ══ --}}
<div class="modal-overlay" id="viewModal" onclick="if(event.target===this) closeViewModal()">
    <div class="modal-box" style="max-width:640px;">
        <button class="modal-close-btn" onclick="closeViewModal()">
            <svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="#6b7280" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>

        {{-- Header: image + name + desc --}}
        <div style="display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.5rem; padding-right:2rem;">
            <img id="viewImg" src="" alt=""
                 style="width:72px; height:72px; border-radius:12px; object-fit:cover; flex-shrink:0;">
            <div>
                <h2 id="viewName" style="font-size:17px; font-weight:700; color:#1f2937; margin:0 0 6px;"></h2>
                <p id="viewDesc" style="font-size:13px; color:#9ca3af; margin:0; line-height:1.5;"></p>
            </div>
        </div>

        {{-- Price & Category --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
            <div>
                <p style="font-size:12px; font-weight:600; color:#374151; margin:0 0 6px;">Price</p>
                <div class="view-info-box" id="viewPrice"></div>
            </div>
            <div>
                <p style="font-size:12px; font-weight:600; color:#374151; margin:0 0 6px;">Category</p>
                <div class="view-info-box" id="viewCategory"></div>
            </div>
        </div>

        {{-- Stock & Status --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
            <div>
                <p style="font-size:12px; font-weight:600; color:#374151; margin:0 0 6px;">Stock</p>
                <div class="view-info-box" id="viewStock"></div>
            </div>
            <div>
                <p style="font-size:12px; font-weight:600; color:#374151; margin:0 0 6px;">Status</p>
                <div class="view-info-box" id="viewStatus"></div>
            </div>
        </div>

        {{-- Add-On & Menu Variant --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div>
                <p style="font-size:12px; font-weight:600; color:#374151; margin:0 0 6px;">Add-On</p>
                <div style="border-radius:0.75rem; border:1.5px solid #E5DDD5; background:#FAFAF9; padding:0 1rem;" id="viewAddons">
                    <div class="view-addon-row" style="color:#9ca3af; justify-content:center;">No add-ons</div>
                </div>
            </div>
            <div>
                <p style="font-size:12px; font-weight:600; color:#374151; margin:0 0 6px;">Menu Variant</p>
                <div style="border-radius:0.75rem; border:1.5px solid #E5DDD5; background:#FAFAF9; padding:0 1rem;" id="viewVariants">
                    <div class="view-addon-row" style="color:#9ca3af; justify-content:center;">No variants</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ DELETE MENU MODAL ══ --}}
<div class="modal-overlay" id="deleteModal" onclick="if(event.target===this) closeDeleteModal()">
    <div class="modal-box" style="max-width:420px; text-align:center; padding:2.5rem 2rem;">
        <button class="modal-close-btn" onclick="closeDeleteModal()">
            <svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="#6b7280" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>

        {{-- Icon --}}
        <div style="width:56px; height:56px; border-radius:50%; background:#FFF5F5; border:1.5px solid #FECACA;
                    display:flex; align-items:center; justify-content:center; margin:0 auto 1.25rem;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" stroke="#ef4444" stroke-width="1.5"/>
                <path d="M12 7v5M12 16h.01" stroke="#ef4444" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
        </div>

        <h2 style="font-size:16px; font-weight:700; color:#1f2937; margin:0 0 8px;">Delete Menu</h2>
        <p style="font-size:13px; color:#9ca3af; margin:0 0 2rem; line-height:1.6;">
            Are you sure you want to delete this menu?<br>This action cannot be undone.
        </p>

        <div style="display:flex; gap:0.75rem; justify-content:center;">
            <button type="button" onclick="closeDeleteModal()"
                    style="flex:1; padding:0.65rem 1.5rem; border-radius:0.875rem;
                           background:#fff; border:1.5px solid #E5DDD5; color:#6b7280;
                           font-size:13px; font-weight:600; cursor:pointer; transition:background .2s;"
                    onmouseover="this.style.background='#F9F5F1';this.style.borderColor='#C49060'"
                    onmouseout="this.style.background='#fff';this.style.borderColor='#E5DDD5'">
                Cancel
            </button>
            <form id="deleteMenuForm" method="POST" action="" style="flex:1; margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit"
                        style="width:100%; padding:0.65rem 1.5rem; border-radius:0.875rem;
                               background:#ef4444; border:1.5px solid #ef4444;
                               color:#fff; font-size:13px; font-weight:600; cursor:pointer; transition:background .2s;"
                        onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openAddonModal()  { document.getElementById('addonModal').classList.add('open'); document.body.style.overflow='hidden'; }
function closeAddonModal() { document.getElementById('addonModal').classList.remove('open'); document.body.style.overflow=''; }

function openViewModal(data) {
    document.getElementById('viewImg').src      = data.img;
    document.getElementById('viewName').textContent = data.name;
    document.getElementById('viewDesc').textContent = data.desc;
    document.getElementById('viewPrice').textContent    = data.price;
    document.getElementById('viewCategory').textContent = data.category;
    document.getElementById('viewStock').textContent    = data.stock;
    document.getElementById('viewStatus').textContent   = data.status;

    // Addons
    const addonsEl = document.getElementById('viewAddons');
    if (data.addons && data.addons.length) {
        addonsEl.innerHTML = data.addons.map(a =>
            `<div class="view-addon-row"><span>${a.name}</span><span style="color:#6b7280;">${a.price}</span></div>`
        ).join('');
    } else {
        addonsEl.innerHTML = '<div class="view-addon-row" style="color:#9ca3af;justify-content:center;">No add-ons</div>';
    }

    // Variants
    const variantsEl = document.getElementById('viewVariants');
    if (data.variants && data.variants.length) {
        variantsEl.innerHTML = data.variants.map(v =>
            `<div class="view-addon-row"><span>${v.name}</span><span style="color:#6b7280;">${v.options}</span></div>`
        ).join('');
    } else {
        variantsEl.innerHTML = '<div class="view-addon-row" style="color:#9ca3af;justify-content:center;">No variants</div>';
    }

    document.getElementById('viewModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeViewModal() {
    document.getElementById('viewModal').classList.remove('open');
    document.body.style.overflow = '';
}

function openDeleteModal(deleteUrl) {
    document.getElementById('deleteMenuForm').action = deleteUrl;
    document.getElementById('deleteModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeAddonModal();
        closeViewModal();
        closeDeleteModal();
    }
});
</script>

@php
$menuItems = array_fill(0, 10, [
    'id'       => 1,
    'name'     => 'Chicken Teriyaki Rice Bowl',
    'category' => 'Food',
    'price'    => 'Rp 42.000',
    'stock'    => 'Out of Stock',
    'status'   => 'Not Available',
    'img'      => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=80&h=80&fit=crop',
    'desc'     => 'Steamed rice topped with grilled chicken glazed in savory teriyaki sauce, served with fresh vegetables and sesame seeds.',
    'addons'   => [
        ['name' => 'Extra Chicken', 'price' => 'Rp 8.000'],
        ['name' => 'Egg',           'price' => 'Rp 3.000'],
        ['name' => 'Seaweed',       'price' => 'Rp 4.000'],
    ],
    'variants' => [
        ['name' => 'Sauce Level', 'options' => 'Light, Normal, Extra'],
    ],
]);
@endphp

<div style="animation: fadeIn .3s ease both;">

    {{-- ══ Top bar ══ --}}
    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.25rem;">
        <div style="position:relative; width:22rem;">
            <svg style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; pointer-events:none;"
                 width="15" height="15" viewBox="0 0 16 16" fill="none">
                <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M10.5 10.5l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <input type="text" placeholder="Search by name, category, or price..."
                style="width:100%; padding:0.6rem 1rem 0.6rem 2.5rem; border-radius:0.875rem;
                       background:#fff; border:1.5px solid #E5DDD5; font-size:0.8125rem;
                       color:#4b5563; outline:none; transition:border-color .2s;"
                onfocus="this.style.borderColor='#8B5E1A'" onblur="this.style.borderColor='#E5DDD5'">
        </div>
        <div style="display:flex; gap:0.75rem; margin-left:auto;">
            <button onclick="openAddonModal()"
                    style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.6rem 1.25rem;
                           border-radius:0.875rem; background:#fff; border:1.5px solid #C49060;
                           color:#8B5E1A; font-size:13px; font-weight:600; cursor:pointer; transition:background .2s;"
                    onmouseover="this.style.background='#FDF6EE'" onmouseout="this.style.background='#fff'">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Add Add-On
            </button>
            <a href="{{ route('menu-add') }}"
               style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.6rem 1.25rem;
                      border-radius:0.875rem; background:#8B5E1A; border:none; text-decoration:none;
                      color:#fff; font-size:13px; font-weight:600; cursor:pointer; transition:background .2s;"
               onmouseover="this.style.background='#7a4f14'" onmouseout="this.style.background='#8B5E1A'">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1v12M1 7h12" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Add Menu
            </a>
        </div>
    </div>

    {{-- ══ Table ══ --}}
    <div style="background:#fff; border-radius:1rem; border:1.5px solid #EDE8E0; overflow:hidden;">
        <table class="menu-table">
            <thead>
                <tr>
                    <th style="width:48px; padding-left:20px;">
                        <input type="checkbox" class="custom-checkbox" id="checkAll"
                               onchange="document.querySelectorAll('.row-check').forEach(c=>c.checked=this.checked)">
                    </th>
                    <th style="width:80px;">Image</th>
                    <th>Menu Name <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Category <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Price <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Stock <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Status <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuItems as $idx => $item)
                @php
                $viewData = json_encode([
                    'name'     => $item['name'],
                    'img'      => $item['img'],
                    'desc'     => $item['desc'],
                    'price'    => $item['price'],
                    'category' => $item['category'],
                    'stock'    => $item['stock'],
                    'status'   => $item['status'],
                    'addons'   => $item['addons'],
                    'variants' => $item['variants'],
                ]);
                @endphp
                <tr>
                    <td style="padding-left:20px;">
                        <input type="checkbox" class="row-check custom-checkbox" {{ $idx===1?'checked':'' }}>
                    </td>
                    <td>
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                             style="width:48px; height:48px; border-radius:10px; object-fit:cover; display:block;">
                    </td>
                    <td style="font-weight:500;">{{ $item['name'] }}</td>
                    <td style="color:#6b7280;">{{ $item['category'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td style="color:#6b7280;">{{ $item['stock'] }}</td>
                    <td>
                        <span style="display:inline-block; padding:4px 12px; border-radius:999px;
                                     background:#FFF5F5; border:1.5px solid #FECACA;
                                     color:#ef4444; font-size:12px; font-weight:500; white-space:nowrap;">
                            {{ $item['status'] }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; align-items:center;">
                            {{-- View --}}
                            <button class="action-btn" title="View" onclick='openViewModal({{ $viewData }})'>
                                <svg width="15" height="15" viewBox="0 0 20 14" fill="none">
                                    <path d="M1 7C1 7 4 1 10 1s9 6 9 6-3 6-9 6S1 7 1 7z" stroke="#6b7280" stroke-width="1.5" stroke-linejoin="round"/>
                                    <circle cx="10" cy="7" r="2.5" stroke="#6b7280" stroke-width="1.5"/>
                                </svg>
                            </button>
                            {{-- Edit --}}
                            <a href="/menu-edit" class="action-btn" title="Edit">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                    <path d="M11 2l3 3-9 9H2v-3l9-9z"
                                          stroke="#6b7280"
                                          stroke-width="1.5"
                                          stroke-linejoin="round"
                                          stroke-linecap="round"/>
                                </svg>
                            </a>
                            {{-- Delete --}}
                            <button class="action-btn delete" title="Delete"
                                    onclick="openDeleteModal('{{ route('menu.destroy', $item['id']) }}')">
                                <svg width="13" height="14" viewBox="0 0 14 16" fill="none">
                                    <path d="M1 4h12M5 4V2h4v2M6 7v5M8 7v5M2 4l1 10h8l1-10" stroke="#ef4444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ══ Pagination ══ --}}
        <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 20px; border-top:1.5px solid #F0EBE3;">
            <div style="display:flex; align-items:center; gap:0.5rem; font-size:13px; color:#6b7280;">
                <span>Showing</span>
                <select style="padding:4px 28px 4px 10px; border-radius:8px; border:1.5px solid #E5DDD5;
                               background:#fff; font-size:13px; color:#374151; appearance:none; -webkit-appearance:none; cursor:pointer;
                               background-image:url(\"data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E\");
                               background-repeat:no-repeat; background-position:right 8px center; outline:none;">
                    <option>10</option><option>25</option><option>50</option>
                </select>
                <span>of 38 entries</span>
            </div>
            <div style="display:flex; align-items:center; gap:6px;">
                <button class="page-btn" disabled>
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none"><path d="M6 1L1 6l5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none"><path d="M1 1l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                </button>
            </div>
        </div>
    </div>

</div>

@endsection