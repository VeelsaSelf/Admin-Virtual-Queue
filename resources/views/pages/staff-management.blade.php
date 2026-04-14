@extends('layouts.app')
@section('title','Staff Management')
@section('page-title','Staff Management')
@section('page-subtitle','Manage staff accounts, roles, and access permissions')

@section('content')

<style>
@keyframes fadeIn {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes modalIn {
    from { opacity:0; transform:scale(.97) translateY(10px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}
@keyframes slideUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes slideDown {
    from { opacity:1; transform:translateY(0); }
    to   { opacity:0; transform:translateY(20px); }
}

/* ── Table ── */
.staff-table { width:100%; border-collapse:collapse; }
.staff-table th {
    background:#fff; font-size:13px; font-weight:600; color:#374151;
    padding:12px 16px; text-align:left; border-bottom:1.5px solid #F0EBE3;
    white-space:nowrap; user-select:none;
}
.staff-table td {
    padding:12px 16px; font-size:13px; color:#374151;
    border-bottom:1px solid #F5F0EB; vertical-align:middle;
}
.staff-table tbody tr { transition:background .15s; }
.staff-table tbody tr:hover { background:#FDFAF7; }

.sort-icon { display:inline-flex; flex-direction:column; gap:1px; margin-left:6px; vertical-align:middle; }
.sort-icon span { display:block; width:0; height:0; }
.sort-icon .up   { border-left:4px solid transparent; border-right:4px solid transparent; border-bottom:4px solid #9ca3af; }
.sort-icon .down { border-left:4px solid transparent; border-right:4px solid transparent; border-top:4px solid #9ca3af; }

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

.action-btn {
    width:32px; height:32px; border-radius:8px; border:1.5px solid #E5DDD5;
    background:#fff; display:inline-flex; align-items:center; justify-content:center;
    cursor:pointer; transition:background .15s, border-color .15s; text-decoration:none;
}
.action-btn:hover { background:#FDF6EE; border-color:#C49060; }
.action-btn.delete:hover { background:#FFF5F5; border-color:#FCA5A5; }

.badge-inactive {
    display:inline-block; padding:4px 12px; border-radius:999px;
    background:#FFF5F5; border:1.5px solid #FECACA;
    color:#ef4444; font-size:12px; font-weight:500; white-space:nowrap;
}
.badge-active {
    display:inline-block; padding:4px 12px; border-radius:999px;
    background:#F0FDF4; border:1.5px solid #86EFAC;
    color:#16a34a; font-size:12px; font-weight:500; white-space:nowrap;
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

/* ── Modal overlay ── */
.modal-overlay {
    display:none; position:fixed; inset:0; z-index:9000;
    background:rgba(0,0,0,.35); backdrop-filter:blur(2px);
    align-items:center; justify-content:center;
}
.modal-overlay.open { display:flex; }
.modal-box {
    background:#fff; border-radius:1.25rem; padding:2rem;
    width:100%; max-width:560px;
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

/* view modal read-only fields */
.view-field-label {
    font-size:12px; font-weight:600; color:#6b7280; margin:0 0 5px;
}
.view-field-value {
    width:100%; padding:0.6rem 1rem; border-radius:0.75rem;
    border:1.5px solid #E5DDD5; background:#FAFAF9;
    font-size:13px; color:#374151; box-sizing:border-box;
}

/* delete modal */
.delete-modal-box {
    background:#fff; border-radius:1.25rem; padding:2rem;
    width:100%; max-width:400px; text-align:center;
    box-shadow:0 24px 64px rgba(0,0,0,.18);
    animation: modalIn .25s cubic-bezier(.16,1,.3,1) both;
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
<script>document.addEventListener('DOMContentLoaded',()=>setTimeout(()=>closeToast('toast'),3500));</script>
@endif

{{-- ══ VIEW STAFF MODAL ══ --}}
<div class="modal-overlay" id="viewModal" onclick="if(event.target===this) closeViewModal()">
    <div class="modal-box" style="max-width:580px;">
        <button class="modal-close-btn" onclick="closeViewModal()">
            <svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="#6b7280" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>

        {{-- Profile header --}}
        <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.5rem; padding-right:2rem;">
            <img id="viewAvatar" src="" alt=""
                 style="width:56px; height:56px; border-radius:12px; object-fit:cover; flex-shrink:0; border:1.5px solid #E5DDD5;">
            <div>
                <h2 id="viewName" style="font-size:18px; font-weight:700; color:#1f2937; margin:0 0 3px;"></h2>
                <p id="viewRole" style="font-size:13px; color:#9ca3af; margin:0;"></p>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div>
                <p class="view-field-label">Username</p>
                <input class="view-field-value" id="viewUsername" type="text" readonly>
            </div>
            <div>
                <p class="view-field-label">Phone Number</p>
                <input class="view-field-value" id="viewPhone" type="text" readonly>
            </div>
            <div>
                <p class="view-field-label">Email Address</p>
                <input class="view-field-value" id="viewEmail" type="text" readonly>
            </div>
            <div>
                <p class="view-field-label">Joined Date</p>
                <input class="view-field-value" type="text" value="31 January 2026" readonly>
            </div>
            <div>
                <p class="view-field-label">Role</p>
                <input class="view-field-value" id="viewRoleField" type="text" readonly>
            </div>
            <div>
                <p class="view-field-label">Status</p>
                <input class="view-field-value" id="viewStatus" type="text" readonly>
            </div>
        </div>
    </div>
</div>

{{-- ══ DELETE STAFF MODAL ══ --}}
<div class="modal-overlay" id="deleteModal" onclick="if(event.target===this) closeDeleteModal()">
    <div class="delete-modal-box">
        <div style="width:44px; height:44px; border-radius:50%; background:#FFF0F0;
                    display:flex; align-items:center; justify-content:center; margin:0 auto 1rem;">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 6v5M10 14h.01" stroke="#ef4444" stroke-width="2" stroke-linecap="round"/>
                <circle cx="10" cy="10" r="8" stroke="#ef4444" stroke-width="1.8"/>
            </svg>
        </div>
        <h3 style="font-size:17px; font-weight:700; color:#1f2937; margin:0 0 8px;">Delete Staff</h3>
        <p style="font-size:13px; color:#6b7280; margin:0 0 1.5rem; line-height:1.6;">
            Are you sure you want to delete <strong id="deleteStaffName"></strong>?<br>
            This action cannot be undone.
        </p>
        <div style="display:flex; gap:0.75rem; justify-content:center;">
            <button onclick="closeDeleteModal()"
                    style="min-width:110px; padding:0.65rem 1.5rem; border-radius:0.875rem;
                           background:#fff; border:1.5px solid #E5DDD5; color:#6b7280;
                           font-size:13px; font-weight:600; cursor:pointer; transition:background .15s;"
                    onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#fff'">
                Cancel
            </button>
            <button onclick="confirmDelete()"
                    style="min-width:110px; padding:0.65rem 1.5rem; border-radius:0.875rem;
                           background:#ef4444; border:1.5px solid #ef4444; color:#fff;
                           font-size:13px; font-weight:600; cursor:pointer; transition:background .15s;"
                    onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
function closeToast(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.animation = 'slideDown .3s ease forwards';
    setTimeout(() => el.remove(), 300);
}

function openViewModal(data) {
    document.getElementById('viewAvatar').src        = data.avatar;
    document.getElementById('viewName').textContent  = data.name;
    document.getElementById('viewRole').textContent  = data.role;
    document.getElementById('viewUsername').value    = data.name.toLowerCase().replace(/\s+/g,'.');
    document.getElementById('viewPhone').value       = data.phone;
    document.getElementById('viewEmail').value       = data.email;
    document.getElementById('viewRoleField').value   = data.role;
    document.getElementById('viewStatus').value      = data.status;
    document.getElementById('viewModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeViewModal() {
    document.getElementById('viewModal').classList.remove('open');
    document.body.style.overflow = '';
}

let pendingDeleteName = '';
function openDeleteModal(name) {
    pendingDeleteName = name;
    document.getElementById('deleteStaffName').textContent = name;
    document.getElementById('deleteModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
    document.body.style.overflow = '';
}
function confirmDelete() { closeDeleteModal(); }

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeViewModal(); closeDeleteModal(); }
});

function filterTable(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#staffTbody tr').forEach(r => {
        r.style.display = r.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
}
function toggleAll(cb) {
    document.querySelectorAll('.row-check').forEach(c => c.checked = cb.checked);
}
</script>

@php
$staffItems = array_fill(0, 10, [
    'name'   => 'Miguela Veloso',
    'role'   => 'Cashier',
    'email'  => 'm.veloso23@gmail.com',
    'phone'  => '+1-418-543-8090',
    'status' => 'inactive',
    'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
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
            <input type="text" placeholder="Search by name, role, or status..."
                style="width:100%; padding:0.6rem 1rem 0.6rem 2.5rem; border-radius:0.875rem;
                       background:#fff; border:1.5px solid #E5DDD5; font-size:0.8125rem;
                       color:#4b5563; outline:none; transition:border-color .2s;"
                oninput="filterTable(this.value)"
                onfocus="this.style.borderColor='#8B5E1A'" onblur="this.style.borderColor='#E5DDD5'">
        </div>

        <div style="margin-left:auto;">
            <a href="{{ route('staff-add') }}"
               style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.6rem 1.25rem;
                      border-radius:0.875rem; background:#8B5E1A; border:none; text-decoration:none;
                      color:#fff; font-size:13px; font-weight:600; cursor:pointer; transition:background .2s;"
               onmouseover="this.style.background='#7a4f14'" onmouseout="this.style.background='#8B5E1A'">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1v12M1 7h12" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Add Staff
            </a>
        </div>
    </div>

    {{-- ══ Table ══ --}}
    <div style="background:#fff; border-radius:1rem; border:1.5px solid #EDE8E0; overflow:hidden;">
        <table class="staff-table">
            <thead>
                <tr>
                    <th style="width:48px; padding-left:20px;">
                        <input type="checkbox" class="custom-checkbox" id="checkAll"
                               onchange="toggleAll(this)">
                    </th>
                    <th style="width:72px;">Image</th>
                    <th>Name <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Role <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Email <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Phone <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Status <span class="sort-icon"><span class="up"></span><span class="down"></span></span></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="staffTbody">
                @foreach($staffItems as $idx => $staff)
                @php
                $viewData = json_encode([
                    'name'   => $staff['name'],
                    'role'   => $staff['role'],
                    'email'  => $staff['email'],
                    'phone'  => $staff['phone'],
                    'status' => ucfirst($staff['status']),
                    'avatar' => $staff['avatar'],
                ]);
                @endphp
                <tr>
                    <td style="padding-left:20px;">
                        <input type="checkbox" class="row-check custom-checkbox" {{ $idx === 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <img src="{{ $staff['avatar'] }}" alt="{{ $staff['name'] }}"
                             style="width:44px; height:44px; border-radius:10px; object-fit:cover; display:block;">
                    </td>
                    <td style="font-weight:500;">{{ $staff['name'] }}</td>
                    <td style="color:#6b7280;">{{ $staff['role'] }}</td>
                    <td style="color:#6b7280;">{{ $staff['email'] }}</td>
                    <td style="color:#6b7280;">{{ $staff['phone'] }}</td>
                    <td>
                        @if($staff['status'] === 'active')
                            <span class="badge-active">Active</span>
                        @else
                            <span class="badge-inactive">Inactive</span>
                        @endif
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
                            <a href="{{ route('staff-edit') }}" class="action-btn" title="Edit">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                    <path d="M11 2l3 3-9 9H2v-3l9-9z" stroke="#6b7280" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"/>
                                </svg>
                            </a>
                            {{-- Delete --}}
                            <button class="action-btn delete" title="Delete" onclick="openDeleteModal('{{ $staff['name'] }}')">
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