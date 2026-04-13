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
.menu-table { width:100%; border-collapse:collapse; }
.menu-table th {
    background:#fff;
    font-size:13px;
    font-weight:600;
    color:#374151;
    padding:12px 16px;
    text-align:left;
    border-bottom:1.5px solid #F0EBE3;
    white-space:nowrap;
    user-select:none;
}
.menu-table td {
    padding:12px 16px;
    font-size:13px;
    color:#374151;
    border-bottom:1px solid #F5F0EB;
    vertical-align:middle;
}
.menu-table tbody tr {
    transition:background .15s;
}
.menu-table tbody tr:hover {
    background:#FDFAF7;
}
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
    display:inline-flex; align-items:center; justify-content:center;
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
.menu-overlay {
    position: fixed;
    inset: 0;
    background: rgba(17, 24, 39, 0.32);
    backdrop-filter: blur(2px);
    z-index: 120;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.menu-overlay.open { display: flex; }
.menu-modal {
    width: 100%;
    max-width: 760px;
    background: #fff;
    border: 1.5px solid #E5DDD5;
    border-radius: 16px;
    box-shadow: 0 24px 50px rgba(44, 26, 6, 0.18);
    overflow: hidden;
}
.menu-modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid #EFEAE4;
}
.menu-profile {
    display: flex;
    align-items: center;
    gap: 12px;
}
.menu-profile img {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    object-fit: cover;
    background: #F5EFE8;
}
.menu-profile-name {
    font-size: 30px;
    line-height: 1.15;
    font-weight: 700;
    color: #1f2937;
}
.menu-close {
    width: 34px;
    height: 34px;
    border: none;
    border-radius: 8px;
    background: transparent;
    color: #6b7280;
    font-size: 24px;
    line-height: 1;
    cursor: pointer;
}
.menu-close:hover { background: #F9F5EF; color: #374151; }
.menu-modal-body {
    padding: 20px;
}
.menu-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px 16px;
}
.menu-field label {
    display: block;
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 7px;
}
.menu-field input {
    width: 100%;
    border: 1.5px solid #E5DDD5;
    border-radius: 10px;
    background: #F9F7F4;
    padding: 10px 12px;
    font-size: 13px;
    color: #374151;
}
</style>

@php
$menuItems = array_fill(0, 10, [
    'name'     => 'Chicken Teriyaki Rice Bowl',
    'category' => 'Food',
    'price'    => 'Rp 42.000',
    'stock'    => 'Out of Stock',
    'status'   => 'Not Available',
    'img'      => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=80&h=80&fit=crop',
]);
@endphp

<div style="animation: fadeIn .3s ease both;">

    {{-- ══ Top bar ══ --}}
    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.25rem;">

        {{-- Search --}}
        <div style="position:relative; width:22rem;">
            <svg style="position:absolute; left:12px; top:50%; transform:translateY(-50%);
                        color:#9ca3af; pointer-events:none;"
                 width="15" height="15" viewBox="0 0 16 16" fill="none">
                <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M10.5 10.5l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <input type="text" placeholder="Search by name, category, or price..."
                style="width:100%; padding:0.6rem 1rem 0.6rem 2.5rem; border-radius:0.875rem;
                       background:#fff; border:1.5px solid #E5DDD5; font-size:0.8125rem;
                       color:#4b5563; outline:none; transition:border-color .2s;"
                onfocus="this.style.borderColor='#8B5E1A'"
                onblur="this.style.borderColor='#E5DDD5'">
        </div>

        {{-- Buttons --}}
        <div style="display:flex; gap:0.75rem; margin-left:auto;">

            {{-- Add Add-On (tetap button biasa) --}}
            <button style="display:inline-flex; align-items:center; gap:0.5rem;
                           padding:0.6rem 1.25rem; border-radius:0.875rem;
                           background:#fff; border:1.5px solid #C49060;
                           color:#8B5E1A; font-size:13px; font-weight:600; cursor:pointer;
                           transition:background .2s;"
                    onmouseover="this.style.background='#FDF6EE'"
                    onmouseout="this.style.background='#fff'">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Add Add-On
            </button>

            {{-- Add Menu → direct ke halaman add-menu --}}
            <a href="{{ route('menu-add') }}"
               style="display:inline-flex; align-items:center; gap:0.5rem;
                      padding:0.6rem 1.25rem; border-radius:0.875rem;
                      background:#8B5E1A; border:none; text-decoration:none;
                      color:#fff; font-size:13px; font-weight:600; cursor:pointer;
                      transition:background .2s;"
               onmouseover="this.style.background='#7a4f14'"
               onmouseout="this.style.background='#8B5E1A'">
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
                    <th>
                        Menu Name
                        <span class="sort-icon"><span class="up"></span><span class="down"></span></span>
                    </th>
                    <th>
                        Category
                        <span class="sort-icon"><span class="up"></span><span class="down"></span></span>
                    </th>
                    <th>
                        Price
                        <span class="sort-icon"><span class="up"></span><span class="down"></span></span>
                    </th>
                    <th>
                        Stock
                        <span class="sort-icon"><span class="up"></span><span class="down"></span></span>
                    </th>
                    <th>
                        Status
                        <span class="sort-icon"><span class="up"></span><span class="down"></span></span>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuItems as $idx => $item)
                <tr>
                    <td style="padding-left:20px;">
                        <input type="checkbox" class="row-check custom-checkbox"
                               {{ $idx === 1 ? 'checked' : '' }}>
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
                            <button class="action-btn" title="View" onclick="openMenuModal()">
                                <svg width="15" height="15" viewBox="0 0 20 14" fill="none">
                                    <path d="M1 7C1 7 4 1 10 1s9 6 9 6-3 6-9 6S1 7 1 7z"
                                          stroke="#6b7280" stroke-width="1.5" stroke-linejoin="round"/>
                                    <circle cx="10" cy="7" r="2.5" stroke="#6b7280" stroke-width="1.5"/>
                                </svg>
                            </button>
                            {{-- Edit --}}
                            <button class="action-btn" title="Edit">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                    <path d="M11 2l3 3-9 9H2v-3l9-9z"
                                          stroke="#6b7280" stroke-width="1.5"
                                          stroke-linejoin="round" stroke-linecap="round"/>
                                </svg>
                            </button>
                            {{-- Delete --}}
                            <button class="action-btn delete" title="Delete">
                                <svg width="13" height="14" viewBox="0 0 14 16" fill="none">
                                    <path d="M1 4h12M5 4V2h4v2M6 7v5M8 7v5M2 4l1 10h8l1-10"
                                          stroke="#ef4444" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ══ Pagination ══ --}}
        <div style="display:flex; align-items:center; justify-content:space-between;
                    padding:14px 20px; border-top:1.5px solid #F0EBE3;">
            <div style="display:flex; align-items:center; gap:0.5rem; font-size:13px; color:#6b7280;">
                <span>Showing</span>
                <select style="padding:4px 28px 4px 10px; border-radius:8px; border:1.5px solid #E5DDD5;
                               background:#fff; font-size:13px; color:#374151;
                               appearance:none; -webkit-appearance:none; cursor:pointer;
                               background-image:url(\"data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E\");
                               background-repeat:no-repeat; background-position:right 8px center; outline:none;">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span>of 38 entries</span>
            </div>
            <div style="display:flex; align-items:center; gap:6px;">
                <button class="page-btn" disabled>
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none">
                        <path d="M6 1L1 6l5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none">
                        <path d="M1 1l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

</div>

<div id="menuDetailOverlay" class="menu-overlay" onclick="closeMenuModal(event)">
    <div class="menu-modal" role="dialog" aria-modal="true" aria-label="Menu detail" onclick="event.stopPropagation()">
        <div class="menu-modal-head">
            <div class="menu-profile">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=90&h=90&fit=crop" alt="Menu image">
                <div class="menu-profile-name">Chicken Teriyaki Rice Bowl</div>
            </div>
            <button class="menu-close" type="button" aria-label="Close" onclick="closeMenuModal()">&times;</button>
        </div>

        <div class="menu-modal-body">
            <div class="menu-detail-grid">
                <div class="menu-field">
                    <label>Category</label>
                    <input type="text" value="Food" readonly>
                </div>
                <div class="menu-field">
                    <label>Price</label>
                    <input type="text" value="Rp 42.000" readonly>
                </div>
                <div class="menu-field">
                    <label>Stock</label>
                    <input type="text" value="Out of Stock" readonly>
                </div>
                <div class="menu-field">
                    <label>Status</label>
                    <input type="text" value="Not Available" readonly>
                </div>
                <div class="menu-field" style="grid-column:1/-1;">
                    <label>Description</label>
                    <input type="text" value="Savory teriyaki chicken served over warm rice." readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openMenuModal() {
    document.getElementById('menuDetailOverlay').classList.add('open');
}

function closeMenuModal(event) {
    if (!event || event.target.id === 'menuDetailOverlay') {
        document.getElementById('menuDetailOverlay').classList.remove('open');
    }
}
</script>

@endsection