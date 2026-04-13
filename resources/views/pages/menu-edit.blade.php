@extends('layouts.app')
@section('title','Edit Menu')
@section('page-title','Edit Menu')
@section('page-subtitle','Update menu details, price, and available options')

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

.edit-input {
    width:100%; padding:0.65rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; font-size:13px; color:#374151;
    background:#fff; outline:none; transition:border-color .2s, box-shadow .2s;
    box-sizing:border-box;
}
.edit-input:focus {
    border-color:#8B5E1A;
    box-shadow:0 0 0 3px rgba(139,94,26,.08);
}
.edit-textarea {
    width:100%; padding:0.65rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; font-size:13px; color:#374151;
    background:#fff; outline:none; transition:border-color .2s, box-shadow .2s;
    box-sizing:border-box; resize:vertical; min-height:108px;
    font-family:inherit; line-height:1.6;
}
.edit-textarea:focus {
    border-color:#8B5E1A;
    box-shadow:0 0 0 3px rgba(139,94,26,.08);
}
.edit-select {
    width:100%; padding:0.65rem 2.25rem 0.65rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; font-size:13px; color:#374151;
    background:#fff; outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;
    background-image:url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 12px center;
    transition:border-color .2s, box-shadow .2s; box-sizing:border-box;
}
.edit-select:focus {
    border-color:#8B5E1A;
    box-shadow:0 0 0 3px rgba(139,94,26,.08);
}

.section-label {
    font-size:13px; font-weight:600; color:#374151; margin:0 0 0.5rem;
    display:block;
}
.section-divider-label {
    font-size:11px; font-weight:700; color:#9ca3af;
    letter-spacing:.06em; text-transform:uppercase;
    margin:0 0 1.25rem; display:block;
}

/* Image upload */
.img-upload-wrap {
    position:relative; width:170px; height:170px; border-radius:1rem;
    overflow:hidden; cursor:pointer; margin:0 auto 2rem;
    border:2px dashed #E5DDD5; transition:border-color .2s;
    background:#FAFAF9;
}
.img-upload-wrap:hover { border-color:#C49060; }
.img-upload-wrap img {
    width:100%; height:100%; object-fit:cover; display:block;
}
.img-upload-overlay {
    position:absolute; inset:0; background:rgba(0,0,0,.38);
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    gap:7px; opacity:0; transition:opacity .2s;
}
.img-upload-wrap:hover .img-upload-overlay { opacity:1; }
.img-upload-overlay span {
    font-size:11px; font-weight:700; color:#fff; letter-spacing:.04em;
    text-transform:uppercase;
}

/* Addon dropdown */
.addon-dropdown-wrap { position:relative; }
.addon-trigger-btn {
    width:100%; padding:0.65rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; font-size:13px; color:#9ca3af;
    background:#fff; text-align:left; cursor:pointer;
    display:flex; align-items:center; justify-content:space-between;
    transition:border-color .2s, box-shadow .2s; box-sizing:border-box;
}
.addon-trigger-btn.has-items { color:#374151; }
.addon-trigger-btn:focus, .addon-trigger-btn.open {
    border-color:#8B5E1A;
    box-shadow:0 0 0 3px rgba(139,94,26,.08);
    outline:none;
}
.addon-dropdown-panel {
    display:none; position:absolute; top:calc(100% + 6px); left:0; right:0;
    background:#fff; border:1.5px solid #E5DDD5; border-radius:.875rem;
    z-index:200; overflow:hidden;
    box-shadow:0 8px 24px rgba(0,0,0,.1);
}
.addon-dropdown-panel.open { display:block; }
.addon-option {
    display:flex; align-items:center; justify-content:space-between;
    padding:10px 14px; font-size:13px; color:#374151; cursor:pointer;
    transition:background .12s; gap:10px;
}
.addon-option:hover { background:#FDFAF7; }
.addon-option-left { display:flex; align-items:center; gap:10px; }

/* Checked list below dropdown */
.addon-checked-list { margin-top:8px; display:flex; flex-direction:column; gap:6px; }
.addon-checked-item {
    display:flex; align-items:center; justify-content:space-between;
    padding:9px 14px; border-radius:.875rem; background:#FDFAF7;
    border:1.5px solid #F0EBE3; font-size:13px;
}
.addon-item-left { display:flex; align-items:center; gap:10px; }

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

/* Toast */
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

@php
// Collect selected addon IDs for easy lookup
$selectedAddonIds = collect($menu['addons'])->pluck('id')->toArray();
@endphp

<div style="animation: fadeIn .3s ease both;">
    <form method="POST" action="{{ route('menu.update', $menu['id']) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="background:#fff; border-radius:1.25rem; border:1.5px solid #EDE8E0; padding:2rem 2.5rem;">

            {{-- ══ Image Upload ══ --}}
            <div class="img-upload-wrap" onclick="document.getElementById('imgInput').click()">
                <img id="imgPreview" src="{{ $menu['image'] }}" alt="{{ $menu['name'] }}">
                <div class="img-upload-overlay">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <polyline points="17 8 12 3 7 8" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="12" y1="3" x2="12" y2="15" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                    <span>Change Photo</span>
                </div>
                <input type="file" id="imgInput" name="image" accept="image/*"
                       style="display:none" onchange="previewImage(event)">
            </div>

            {{-- ══ Menu Information ══ --}}
            <span class="section-divider-label">Menu Information</span>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
                <div>
                    <label class="section-label">Menu Name</label>
                    <input type="text" name="name" class="edit-input"
                           placeholder="e.g. Chicken Teriyaki Rice Bowl"
                           value="{{ old('name', $menu['name']) }}" required>
                </div>
                <div>
                    <label class="section-label">Category</label>
                    <select name="category" class="edit-select" required>
                        <option value="">— Select category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat['name'] }}"
                                {{ old('category', $menu['category']) == $cat['name'] ? 'selected' : '' }}>
                                {{ $cat['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
                <div>
                    <label class="section-label">Price</label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%);
                                     font-size:13px; color:#9ca3af; font-weight:500; pointer-events:none;">Rp</span>
                        <input type="number" name="price" class="edit-input"
                               style="padding-left:2.25rem;"
                               placeholder="0"
                               value="{{ old('price', $menu['price']) }}" min="0" required>
                    </div>
                </div>
                <div>
                    <label class="section-label">Stock</label>
                    <input type="number" name="stock" class="edit-input"
                           placeholder="0"
                           value="{{ old('stock', $menu['stock']) }}" min="0" required>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:2rem;">
                <div>
                    <label class="section-label">Description</label>
                    <textarea name="description" class="edit-textarea"
                              placeholder="Describe this menu item...">{{ old('description', $menu['description']) }}</textarea>
                </div>
                <div>
                    <label class="section-label">Status</label>
                    <select name="status" class="edit-select" required>
                        <option value="">— Select status —</option>
                        <option value="available"
                            {{ old('status', $menu['status']) == 'available' ? 'selected' : '' }}>
                            Available
                        </option>
                        <option value="unavailable"
                            {{ old('status', $menu['status']) == 'unavailable' ? 'selected' : '' }}>
                            Not Available
                        </option>
                    </select>
                </div>
            </div>

            {{-- ══ Menu Options ══ --}}
            <div style="padding-top:1.5rem; border-top:1.5px solid #F5F0EB; margin-bottom:1.5rem;">
                <span class="section-divider-label">Menu Options</span>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:2rem;">

                {{-- ── Add-On ── --}}
                <div>
                    <label class="section-label">Add-On</label>
                    <div class="addon-dropdown-wrap" id="addonWrap">

                        {{-- Trigger --}}
                        <button type="button" class="addon-trigger-btn {{ count($menu['addons']) ? 'has-items' : '' }}"
                                id="addonTrigger" onclick="toggleAddonDropdown()">
                            <span id="addonTriggerText">Choose Add-ons</span>
                            <svg id="addonChevron" width="10" height="6" viewBox="0 0 10 6" fill="none"
                                 style="transition:transform .2s; flex-shrink:0;">
                                <path d="M1 1l4 4 4-4" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </button>

                        {{-- Dropdown panel --}}
                        <div class="addon-dropdown-panel" id="addonPanel">
                            @foreach($allAddons as $addon)
                            <div class="addon-option"
                                 onclick="toggleAddon({{ $addon['id'] }}, '{{ addslashes($addon['name']) }}', 'Rp {{ number_format($addon['price'], 0, ',', '.') }}')">
                                <div class="addon-option-left">
                                    <input type="checkbox"
                                           class="custom-checkbox addon-panel-cb"
                                           id="panelCb_{{ $addon['id'] }}"
                                           data-id="{{ $addon['id'] }}"
                                           data-name="{{ $addon['name'] }}"
                                           data-price="Rp {{ number_format($addon['price'], 0, ',', '.') }}"
                                           {{ in_array($addon['id'], $selectedAddonIds) ? 'checked' : '' }}
                                           onclick="event.stopPropagation();"
                                           onchange="syncFromCheckbox(this)">
                                    <span>{{ $addon['name'] }}</span>
                                </div>
                                <span style="color:#6b7280; font-size:12px;">
                                    Rp {{ number_format($addon['price'], 0, ',', '.') }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Checked items displayed below --}}
                    <div class="addon-checked-list" id="addonCheckedList">
                        @foreach($menu['addons'] as $addon)
                        <div class="addon-checked-item" id="addonItem_{{ $addon['id'] }}">
                            <div class="addon-item-left">
                                <input type="checkbox" class="custom-checkbox" checked
                                       onchange="removeAddon({{ $addon['id'] }}, this)">
                                <span>{{ $addon['name'] }}</span>
                            </div>
                            <span style="color:#6b7280; font-size:12px;">
                                Rp {{ number_format($addon['price'], 0, ',', '.') }}
                            </span>
                            <input type="hidden" name="addons[]" value="{{ $addon['id'] }}">
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- ── Menu Variant ── --}}
                <div>
                    <label class="section-label">Menu Variant</label>
                    <select name="variant" class="edit-select">
                        <option value="">— Select variant —</option>
                        @foreach($variants as $variant)
                            <option value="{{ $variant['name'] }}"
                                {{ old('variant', $menu['variant']) == $variant['name'] ? 'selected' : '' }}>
                                {{ $variant['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- ══ Action Buttons ══ --}}
            <div style="display:flex; align-items:center; justify-content:flex-end; gap:0.75rem;
                        padding-top:1.5rem; border-top:1.5px solid #F5F0EB;">
                <a href="{{ route('menu-management') }}"
                   style="display:inline-flex; align-items:center; padding:0.65rem 1.75rem;
                          border-radius:0.875rem; background:#fff; border:1.5px solid #E5DDD5;
                          color:#6b7280; font-size:13px; font-weight:600; cursor:pointer;
                          text-decoration:none; transition:background .2s, border-color .2s;"
                   onmouseover="this.style.background='#F9F5F1';this.style.borderColor='#C49060'"
                   onmouseout="this.style.background='#fff';this.style.borderColor='#E5DDD5'">
                    Cancel
                </a>
                <button type="submit"
                        style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.65rem 1.75rem;
                               border-radius:0.875rem; background:#8B5E1A; border:1.5px solid #8B5E1A;
                               color:#fff; font-size:13px; font-weight:600; cursor:pointer;
                               transition:background .2s;"
                        onmouseover="this.style.background='#7a4f14'"
                        onmouseout="this.style.background='#8B5E1A'">
                    <svg width="13" height="13" viewBox="0 0 14 14" fill="none">
                        <path d="M2 7.5l3.5 3.5L12 3" stroke="white" stroke-width="1.8"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Save Changes
                </button>
            </div>

        </div>
    </form>
</div>

<script>
// ── Image preview ──
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('imgPreview').src = e.target.result;
    reader.readAsDataURL(file);
}

// ── Addon dropdown toggle ──
function toggleAddonDropdown() {
    const panel   = document.getElementById('addonPanel');
    const chevron = document.getElementById('addonChevron');
    const trigger = document.getElementById('addonTrigger');
    const isOpen  = panel.classList.toggle('open');
    trigger.classList.toggle('open', isOpen);
    chevron.style.transform = isOpen ? 'rotate(180deg)' : '';
}

// Close on outside click
document.addEventListener('click', function(e) {
    const wrap = document.getElementById('addonWrap');
    if (wrap && !wrap.contains(e.target)) {
        document.getElementById('addonPanel').classList.remove('open');
        document.getElementById('addonTrigger').classList.remove('open');
        document.getElementById('addonChevron').style.transform = '';
    }
});

// ── Click row → toggle checkbox ──
function toggleAddon(id, name, price) {
    const cb = document.getElementById('panelCb_' + id);
    if (!cb) return;
    cb.checked = !cb.checked;
    syncFromCheckbox(cb);
}

// ── Sync checked list from panel checkbox ──
function syncFromCheckbox(cb) {
    const id       = cb.dataset.id;
    const name     = cb.dataset.name;
    const price    = cb.dataset.price;
    const list     = document.getElementById('addonCheckedList');
    const existing = document.getElementById('addonItem_' + id);

    if (cb.checked) {
        if (!existing) {
            const div = document.createElement('div');
            div.className = 'addon-checked-item';
            div.id = 'addonItem_' + id;
            div.innerHTML = `
                <div class="addon-item-left">
                    <input type="checkbox" class="custom-checkbox" checked
                           onchange="removeAddon(${id}, this)">
                    <span>${name}</span>
                </div>
                <span style="color:#6b7280;font-size:12px;">${price}</span>
                <input type="hidden" name="addons[]" value="${id}">
            `;
            list.appendChild(div);
        }
    } else {
        if (existing) existing.remove();
    }
}

// ── Uncheck from the list item ──
function removeAddon(id, cb) {
    if (!cb.checked) {
        const item = document.getElementById('addonItem_' + id);
        if (item) item.remove();
        const panelCb = document.getElementById('panelCb_' + id);
        if (panelCb) panelCb.checked = false;
    }
}
</script>

@endsection