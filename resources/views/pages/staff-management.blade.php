@extends('layouts.app')

@section('title', 'Staff Management')

@section('content')
@php
    $dummyStaffs = [
        [
            'name' => 'Miguela Veloso',
            'role' => 'Cashier',
            'email' => 'm.veloso23@gmail.com',
            'phone' => '+1-418-543-8090',
            'status' => 'inactive',
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
            'checked' => false,
        ],
        [
            'name' => 'Miguela Veloso',
            'role' => 'Cashier',
            'email' => 'm.veloso23@gmail.com',
            'phone' => '+1-418-543-8090',
            'status' => 'inactive',
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
            'checked' => true,
        ],
        [
            'name' => 'Miguela Veloso',
            'role' => 'Cashier',
            'email' => 'm.veloso23@gmail.com',
            'phone' => '+1-418-543-8090',
            'status' => 'inactive',
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
            'checked' => false,
        ],
    ];
@endphp

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  --bg:#F7F3EE;
  --white:#FFFFFF;
  --brown:#2C1503;
  --brown-2:#7A4520;
  --caramel:#C17A3A;
  --caramel-lt:#F0DEC8;
  --text:#1A0E04;
  --muted:#9A8070;
  --border:#E5DAD0;
  --row-hover:#FDF9F5;
  --active-nav:#FFF0E0;
  --pill-inactive-bg:#FFF0EE;
  --pill-inactive-c:#B93A2A;
  --pill-active-bg:#EDFAF3;
  --pill-active-c:#1A7A46;
  --sidebar:240px;
  --topbar:70px;
  --r:12px;
}

html,body{height:100%;font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);overflow-x:hidden}

.shell{display:flex;min-height:100vh}

/* SIDEBAR */
.sidebar{
  width:var(--sidebar);position:fixed;top:0;left:0;height:100vh;
  background:var(--white);border-right:1.5px solid var(--border);
  display:flex;flex-direction:column;padding:26px 0 20px;
  z-index:100;animation:slideInLeft .4s cubic-bezier(.16,1,.3,1) both;
}
@keyframes slideInLeft{from{transform:translateX(-20px);opacity:0}to{transform:translateX(0);opacity:1}}

.logo{display:flex;align-items:center;gap:10px;padding:0 22px 24px;border-bottom:1.5px solid var(--border)}
.logo-icon{width:38px;height:38px;border-radius:9px;background:var(--brown);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.logo-icon svg{width:22px;height:22px}
.logo-text{font-family:'Playfair Display',serif;font-size:16px;font-weight:600;color:var(--brown);letter-spacing:.5px}

.sidebar-foot{padding:16px 12px 0;border-top:1.5px solid var(--border);margin-top:auto}
.btn-signout{
  display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:9px;
  color:#B93A2A;font-size:13.5px;font-weight:500;background:none;border:none;
  cursor:pointer;width:100%;transition:background .15s;
}
.btn-signout:hover{background:#FFF0EE}
.btn-signout i{font-size:19px}

/* MAIN */
.main{margin-left:var(--sidebar);flex:1;display:flex;flex-direction:column;min-height:100vh}

/* TOPBAR */
.topbar{
  height:var(--topbar);background:var(--white);border-bottom:1.5px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;padding:0 30px;
  position:sticky;top:0;z-index:90;
  animation:fadeDown .4s .1s cubic-bezier(.16,1,.3,1) both;
}
@keyframes fadeDown{from{transform:translateY(-10px);opacity:0}to{transform:translateY(0);opacity:1}}

.topbar-left h1{font-family:'Playfair Display',serif;font-size:21px;font-weight:600;color:var(--text)}
.topbar-left p{font-size:12.5px;color:var(--muted);margin-top:1px}
.topbar-right{display:flex;align-items:center;gap:14px}

.notif-btn{
  position:relative;width:38px;height:38px;border-radius:50%;
  border:1.5px solid var(--border);background:var(--bg);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;color:var(--muted);font-size:19px;
  transition:background .15s,transform .15s;
}
.notif-btn:hover{background:var(--caramel-lt);transform:scale(1.07)}
.notif-dot{position:absolute;top:7px;right:7px;width:8px;height:8px;background:#3B82F6;border-radius:50%;border:2px solid white;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{transform:scale(1)}50%{transform:scale(1.4)}}

.user-chip{
  display:flex;align-items:center;gap:9px;cursor:pointer;
  padding:5px 12px 5px 5px;border-radius:30px;
  border:1.5px solid var(--border);background:var(--bg);transition:background .15s;
}
.user-chip:hover{background:var(--caramel-lt)}
.user-av{
  width:34px;height:34px;border-radius:50%;border:2px solid var(--border);
  background:var(--caramel-lt);display:flex;align-items:center;justify-content:center;
  font-size:13px;font-weight:700;color:var(--caramel);overflow:hidden;
}
.user-av img{width:100%;height:100%;object-fit:cover}
.user-name{font-size:13px;font-weight:600;color:var(--text)}
.user-role{font-size:11px;color:var(--muted)}

/* CONTENT */
.content{padding:24px 30px;flex:1}

/* TOOLBAR - SEARCH GAP FIX */
.toolbar{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:18px;gap:12px;
  animation:fadeUp .4s .2s cubic-bezier(.16,1,.3,1) both;
}
@keyframes fadeUp{from{transform:translateY(12px);opacity:0}to{transform:translateY(0);opacity:1}}

.search-wrap{position:relative;flex:0 0 320px}
.search-wrap i{
  position:absolute;
  left:16px; /* Icon digeser ke kanan dikit */
  top:50%;
  transform:translateY(-50%);
  color:var(--muted);
  font-size:17px;
  pointer-events:none
}
.search-input{
  width:100%;
  padding:10px 14px 10px 48px; /* Padding kiri ditambah biar ada gap ke teks */
  border:1.5px solid var(--border);
  border-radius:10px;
  background:var(--white);
  font-family:'DM Sans',sans-serif;
  font-size:13.5px;
  color:var(--text);
  outline:none;
  transition:border-color .2s,box-shadow .2s;
}
.search-input::placeholder{color:var(--muted)}
.search-input:focus{border-color:var(--caramel);box-shadow:0 0 0 3px rgba(193,122,58,.12)}

.btn-add{
  display:inline-flex;align-items:center;gap:7px;padding:10px 20px;
  background:var(--brown);color:#fff;border-radius:10px;
  font-family:'DM Sans',sans-serif;font-size:13.5px;font-weight:600;
  border:none;cursor:pointer;text-decoration:none;
  box-shadow:0 2px 10px rgba(44,21,3,.25);
  transition:background .15s,transform .15s,box-shadow .15s;
}
.btn-add:hover{background:var(--brown-2);transform:translateY(-2px);box-shadow:0 6px 20px rgba(44,21,3,.3)}
.btn-add:active{transform:translateY(0)}
.btn-add i{font-size:17px}

/* TABLE CARD */
.table-card{
  background:var(--white);border:1.5px solid var(--border);border-radius:var(--r);
  overflow:hidden;box-shadow:0 2px 16px rgba(44,21,3,.06);
  animation:fadeUp .4s .3s cubic-bezier(.16,1,.3,1) both;
}
table{width:100%;border-collapse:collapse}
thead tr{border-bottom:1.5px solid var(--border)}
thead th{padding:13px 16px;text-align:left;font-size:12.5px;font-weight:700;color:var(--text);white-space:nowrap;letter-spacing:.2px}
thead th.sort{cursor:pointer;user-select:none;transition:color .15s}
thead th.sort:hover{color:var(--caramel)}
.th-inner{display:inline-flex;align-items:center;gap:4px}
.th-inner i{font-size:13px;color:var(--muted)}

tbody tr{border-bottom:1px solid var(--border);transition:background .12s;animation:rowIn .35s cubic-bezier(.16,1,.3,1) both}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:var(--row-hover)}
@keyframes rowIn{from{opacity:0;transform:translateX(-10px)}to{opacity:1;transform:translateX(0)}}

tbody td{padding:13px 16px;font-size:13.5px;color:var(--text);vertical-align:middle}

.cb{width:17px;height:17px;border:1.5px solid var(--border);border-radius:5px;cursor:pointer;accent-color:var(--brown)}

.av{
  width:36px;height:36px;border-radius:8px;object-fit:cover;
  border:2px solid var(--border);background:var(--caramel-lt);
  display:flex;align-items:center;justify-content:center;
  font-size:13px;font-weight:700;color:var(--caramel);overflow:hidden;
}
.av img{width:100%;height:100%;object-fit:cover}
.name-cell{display:flex;align-items:center;gap:12px}

.pill{
  display:inline-block;padding:4px 13px;border-radius:20px;
  font-size:11.5px;font-weight:700;letter-spacing:.3px;cursor:pointer;
}
.pill-inactive{background:var(--pill-inactive-bg);color:var(--pill-inactive-c);border:1px solid #F5C0BB}
.pill-active{background:var(--pill-active-bg);color:var(--pill-active-c);border:1px solid #A8DFBF}

.actions{display:flex;align-items:center;gap:5px}
.act-btn{
  width:33px;height:33px;border-radius:8px;border:1.5px solid var(--border);
  background:var(--bg);display:flex;align-items:center;justify-content:center;
  cursor:pointer;color:var(--muted);font-size:16px;text-decoration:none;
}
.act-btn:hover{background:#EDE6DD;color:var(--text)}

/* FOOTER */
.table-foot{
  display:flex;align-items:center;justify-content:space-between;
  padding:14px 18px;border-top:1.5px solid var(--border);background:var(--white);
}
.showing{font-size:12.5px;color:var(--muted);display:flex;align-items:center;gap:6px}
.per-page{
  border:1.5px solid var(--border);border-radius:7px;padding:4px 8px;
  font-size:12.5px;background:var(--white);cursor:pointer;outline:none;
}
.pages{display:flex;align-items:center;gap:3px}
.pg{
  width:34px;height:34px;border-radius:8px;border:1.5px solid var(--border);
  background:var(--white);font-size:13px;font-weight:600;color:var(--muted);
  cursor:pointer;display:flex;align-items:center;justify-content:center;
  text-decoration:none;
}
.pg.active{background:var(--brown);color:#fff;border-color:var(--brown)}
.pg.disabled{opacity:.35;pointer-events:none}

/* MODAL */
.overlay{
  position:fixed;inset:0;background:rgba(26,14,4,.5);backdrop-filter:blur(4px);
  z-index:200;display:none;align-items:center;justify-content:center;
}
.overlay.open{display:flex}
.modal{
  background:var(--white);border-radius:16px;padding:30px;width:100%;max-width:500px;
  box-shadow:0 20px 60px rgba(44,21,3,.2);
}
.modal-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px}
.modal-title{font-family:'Playfair Display',serif;font-size:19px;color:var(--text)}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.fg{display:flex;flex-direction:column;gap:5px}
.fg.full{grid-column:1/-1}
.fl{font-size:12.5px;font-weight:700;color:var(--text)}
.fc{
  padding:10px 13px;border:1.5px solid var(--border);border-radius:9px;
  font-family:'DM Sans',sans-serif;font-size:13.5px;background:var(--bg);outline:none;
}
.modal-foot{display:flex;gap:10px;justify-content:flex-end;margin-top:22px}
.btn-save{
  padding:10px 22px;background:var(--brown);color:#fff;border:none;border-radius:9px;
  font-weight:600;cursor:pointer;
}
.detail-modal{
  width:100%;
  max-width:760px;
  background:var(--white);
  border:1.5px solid var(--border);
  border-radius:14px;
  box-shadow:0 18px 45px rgba(44,21,3,.18);
  overflow:hidden;
}
.detail-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:16px 20px;border-bottom:1px solid #EEE4DA;
}
.detail-profile{display:flex;align-items:center;gap:12px}
.detail-profile .avatar{
  width:46px;height:46px;border-radius:10px;object-fit:cover;border:1px solid var(--border);
}
.detail-name{font-size:33px;font-weight:700;line-height:1.1;color:#1F2937}
.detail-close{
  border:none;background:transparent;color:#6B7280;font-size:28px;line-height:1;cursor:pointer;
  width:36px;height:36px;border-radius:8px;
}
.detail-close:hover{background:#F7F3EE}
.detail-body{padding:18px 20px 22px}
.detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.detail-field label{display:block;font-size:13px;color:#6b7280;margin-bottom:6px}
.detail-field input{
  width:100%;padding:11px 12px;border:1.5px solid var(--border);border-radius:10px;
  background:#FAF8F5;font-size:13px;color:#374151;
}
.delete-modal{
  width:100%;
  max-width:430px;
  background:#fff;
  border-radius:16px;
  box-shadow:0 20px 45px rgba(44,21,3,.22);
  padding:24px 22px 18px;
  text-align:center;
}
.delete-icon{
  width:30px;height:30px;border-radius:999px;margin:0 auto 10px;
  display:flex;align-items:center;justify-content:center;
  background:#FDECEF;color:#B4234D;font-size:16px;font-weight:700;
}
.delete-title{
  font-size:29px;
  font-weight:700;
  color:#2C1A06;
  margin-bottom:6px;
}
.delete-text{
  font-size:18px;
  color:#7D6A5A;
  line-height:1.45;
  margin-bottom:14px;
}
.delete-actions{
  display:flex;
  gap:10px;
  justify-content:center;
}
.btn-delete-cancel{
  min-width:110px;
  height:42px;
  border:none;
  border-radius:10px;
  background:#F3F3F3;
  color:#2A2A2A;
  font-size:15px;
  font-weight:500;
  cursor:pointer;
}
.btn-delete-confirm{
  min-width:110px;
  height:42px;
  border:none;
  border-radius:10px;
  background:#D90445;
  color:#fff;
  font-size:15px;
  font-weight:600;
  cursor:pointer;
}
.btn-delete-confirm:hover{background:#bf003d}

/* BULK BAR */
.bulk-bar{
  display:none;align-items:center;gap:10px;background:#FFF7E6;
  border:1px solid #F0C060;border-radius:10px;padding:11px 16px;
  margin-bottom:14px;font-size:13.5px;color:#7A4A00;
}
.bulk-bar.show{display:flex}

.toast{
  position:fixed;bottom:28px;right:28px;background:var(--brown);color:#fff;
  padding:13px 20px;border-radius:12px;font-size:13.5px;font-weight:600;
  box-shadow:0 8px 24px rgba(44,21,3,.3);z-index:999;
  display:flex;align-items:center;gap:8px;
  animation:toastIn .3s cubic-bezier(.16,1,.3,1) both;
}
@keyframes toastIn{from{transform:translateY(16px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;500;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
<script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>

<div class="shell">
  <aside class="sidebar" style="padding-top: 0px;">
    <div class="flex items-center gap-2.5 px-6 pt-7 pb-8">
            <!-- Coffee bean SVG icon -->
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="28" height="28" rx="7" fill="#8B5E1A"/>
                <path d="M14 6C10.134 6 7 9.134 7 13C7 16.866 10.134 20 14 20C17.866 20 21 16.866 21 13C21 9.134 17.866 6 14 6ZM14 8C16.761 8 19 10.239 19 13C19 15.761 16.761 18 14 18C11.239 18 9 15.761 9 13C9 10.239 11.239 8 14 8Z" fill="white"/>
                <path d="M14 10C14 10 12 11.5 12 13C12 14.105 12.895 15 14 15C15.105 15 16 14.105 16 13C16 11.5 14 10 14 10Z" fill="white"/>
            </svg>
            <span class="font-display font-bold text-[18px] tracking-tight text-[#3d2609]">MAU KOPI</span>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 space-y-0.5">
            @php
                $currentRoute = request()->routeIs('dashboard') ? 'dashboard'
                    : (request()->routeIs('orders') ? 'orders'
                    : (request()->routeIs('payments') ? 'payments'
                    : (request()->routeIs('menu-management') ? 'menu-management'
                    : (request()->routeIs('staff-management') ? 'staff-management'
                    : (request()->routeIs('sales-report') ? 'sales-report' : 'dashboard')))));
            @endphp

            <x-nav-item route="dashboard" :active="$currentRoute === 'dashboard'" label="Dashboard">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><rect x="2" y="2" width="7" height="7" rx="2" fill="currentColor"/><rect x="11" y="2" width="7" height="7" rx="2" fill="currentColor"/><rect x="2" y="11" width="7" height="7" rx="2" fill="currentColor"/><rect x="11" y="11" width="7" height="7" rx="2" fill="currentColor"/></svg>
            </x-nav-item>

            <x-nav-item route="orders" :active="$currentRoute === 'orders'" label="Orders">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6"/><path d="M6.5 10h7M10 6.5v7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </x-nav-item>

            <x-nav-item route="payments" :active="$currentRoute === 'payments'" label="Payments">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><rect x="2" y="5" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M2 9h16" stroke="currentColor" stroke-width="1.6"/><rect x="5" y="12" width="4" height="2" rx="0.5" fill="currentColor"/></svg>
            </x-nav-item>

            <x-nav-item route="menu-management" :active="$currentRoute === 'menu-management'" label="Menu Management">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="6" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M4 17c0-3.314 2.686-6 6-6s6 2.686 6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </x-nav-item>

            <x-nav-item route="staff-management" :active="$currentRoute === 'staff-management'" label="Staff Management">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><circle cx="7.5" cy="6" r="2.5" stroke="currentColor" stroke-width="1.6"/><circle cx="13" cy="6" r="2.5" stroke="currentColor" stroke-width="1.6"/><path d="M2 17c0-3.038 2.462-5.5 5.5-5.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M9 17c0-2.761 1.79-5.118 4.25-5.43C16.134 11.853 18 14.21 18 17" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </x-nav-item>

            <x-nav-item route="sales-report" :active="$currentRoute === 'sales-report'" label="Sales Report">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><rect x="3" y="3" width="14" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M6 13l3-3 2 2 3-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </x-nav-item>
        </nav>
  </aside>

  <div class="main" style="margin-left: 0px">
    <header class="topbar">
      <div class="topbar-left">
        <h1>Staff Management</h1>
        <p>Manage staff accounts and permissions</p>
      </div>
      <div class="user-chip">
        <div class="user-av">MV</div>
        <div class="user-name">Miguela Veloso</div>
      </div>
    </header>

    <div class="content">
      <div class="bulk-bar" id="bulkBar">
        <span id="bulkCount">0</span> staff dipilih
      </div>

      <div class="toolbar">
        <div class="search-wrap">
          <i class="ph ph-magnifying-glass"></i>
          <input type="text" class="search-input" placeholder="Search by name, role..." oninput="filterTable(this.value)">
        </div>
        <a href="{{ route('staff-add') }}" class="btn-add"><i class="ph ph-plus"></i> Add Staff</a>
      </div>

      <div class="table-card">
        <table>
          <thead>
            <tr>
              <th style="width:44px"><input type="checkbox" id="checkAll" onchange="toggleAll(this)"></th>
              <th>Name</th>
              <th>Role</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="tbody">
            @foreach($dummyStaffs as $staff)
            <tr>
              <td><input type="checkbox" class="row-cb cb" onchange="updateBulk()" {{ $staff['checked'] ? 'checked' : '' }}></td>
              <td>
                <div class="name-cell">
                  <div class="av"><img src="{{ $staff['avatar'] }}" alt="{{ $staff['name'] }}"></div>
                  <strong>{{ $staff['name'] }}</strong>
                </div>
              </td>
              <td>{{ $staff['role'] }}</td>
              <td>{{ $staff['email'] }}</td>
              <td>{{ $staff['phone'] }}</td>
              <td><span class="pill {{ $staff['status'] === 'active' ? 'pill-active' : 'pill-inactive' }}">{{ ucfirst($staff['status']) }}</span></td>
              <td>
                <div class="actions">
                  <button
                    class="act-btn"
                    onclick="openDetailModal(this)"
                    data-name="{{ $staff['name'] }}"
                    data-role="{{ $staff['role'] }}"
                    data-email="{{ $staff['email'] }}"
                    data-phone="{{ $staff['phone'] }}"
                    data-status="{{ ucfirst($staff['status']) }}"
                    data-avatar="{{ $staff['avatar'] }}"
                  ><i class="ph ph-eye"></i></button>
                  <a href="{{ route('staff-edit') }}" class="act-btn"><i class="ph ph-pencil"></i></a>
                  <button class="act-btn" onclick="openDeleteModal('{{ $staff['name'] }}')"><i class="ph ph-trash"></i></button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="table-foot">
          <div class="showing">
            Showing {{ count($dummyStaffs) }} of {{ count($dummyStaffs) }} entries
          </div>
          <div class="pages">
              <span class="pg disabled"><i class="ph ph-caret-left"></i></span>
              <span class="pg active">1</span>
              <span class="pg disabled"><i class="ph ph-caret-right"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="overlay" id="overlay">
  <div class="modal">
    <div class="modal-head">
      <h2 class="modal-title">Tambah Staff</h2>
      <button onclick="closeModal()">X</button>
    </div>
    <form action="#">
      <div class="form-grid">
        <div class="fg full"><label class="fl">Nama</label><input type="text" class="fc" required></div>
        <div class="fg"><label class="fl">Role</label><select class="fc"><option>Cashier</option><option>Barista</option></select></div>
      </div>
      <div class="modal-foot">
        <button type="button" onclick="closeModal()">Batal</button>
        <button type="submit" class="btn-save">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="overlay" id="detailOverlay" onclick="closeDetailModal(event)">
  <div class="detail-modal" onclick="event.stopPropagation()">
    <div class="detail-head">
      <div class="detail-profile">
        <img id="detailAvatar" class="avatar" src="" alt="avatar">
        <h2 id="detailName" class="detail-name">Miguela Veloso</h2>
      </div>
      <button type="button" class="detail-close" onclick="closeDetailModal()">&times;</button>
    </div>
    <div class="detail-body">
      <div class="detail-grid">
        <div class="detail-field">
          <label>Username</label>
          <input id="detailUsername" type="text" readonly>
        </div>
        <div class="detail-field">
          <label>Phone Number</label>
          <input id="detailPhone" type="text" readonly>
        </div>
        <div class="detail-field">
          <label>Email Address</label>
          <input id="detailEmail" type="text" readonly>
        </div>
        <div class="detail-field">
          <label>Joined Date</label>
          <input type="text" value="31 January 2026" readonly>
        </div>
        <div class="detail-field">
          <label>Role</label>
          <input id="detailRole" type="text" readonly>
        </div>
        <div class="detail-field">
          <label>Status</label>
          <input id="detailStatus" type="text" readonly>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="overlay" id="deleteOverlay" onclick="closeDeleteModal(event)">
  <div class="delete-modal" onclick="event.stopPropagation()">
    <div class="delete-icon">!</div>
    <h3 class="delete-title">Delete Staff</h3>
    <p class="delete-text">
      Are you sure you want to delete <span id="deleteStaffName">this person</span>?<br>
      This action cannot be undone.
    </p>
    <div class="delete-actions">
      <button type="button" class="btn-delete-cancel" onclick="closeDeleteModal()">Cancel</button>
      <button type="button" class="btn-delete-confirm" onclick="confirmDelete()">Delete</button>
    </div>
  </div>
</div>

<script>
function openModal() { document.getElementById('overlay').classList.add('open') }
function closeModal() { document.getElementById('overlay').classList.remove('open') }
function openDetailModal(button) {
  document.getElementById('detailName').innerText = button.dataset.name;
  document.getElementById('detailUsername').value = button.dataset.name.toLowerCase().replace(/\s+/g, '.');
  document.getElementById('detailPhone').value = button.dataset.phone;
  document.getElementById('detailEmail').value = button.dataset.email;
  document.getElementById('detailRole').value = button.dataset.role;
  document.getElementById('detailStatus').value = button.dataset.status;
  document.getElementById('detailAvatar').src = button.dataset.avatar;
  document.getElementById('detailOverlay').classList.add('open');
}
function closeDetailModal(event) {
  if (!event || event.target.id === 'detailOverlay') {
    document.getElementById('detailOverlay').classList.remove('open');
  }
}
let selectedDeleteName = '';
function openDeleteModal(name) {
  selectedDeleteName = name || 'this person';
  document.getElementById('deleteStaffName').innerText = selectedDeleteName;
  document.getElementById('deleteOverlay').classList.add('open');
}
function closeDeleteModal(event) {
  if (!event || event.target.id === 'deleteOverlay') {
    document.getElementById('deleteOverlay').classList.remove('open');
  }
}
function confirmDelete() {
  closeDeleteModal();
}

function filterTable(q) {
  q = q.toLowerCase();
  document.querySelectorAll('#tbody tr').forEach(r => {
    r.style.display = r.innerText.toLowerCase().includes(q) ? '' : 'none';
  });
}

function toggleAll(cb) {
  document.querySelectorAll('.row-cb').forEach(c => c.checked = cb.checked);
  updateBulk();
}

function updateBulk() {
  const count = document.querySelectorAll('.row-cb:checked').length;
  document.getElementById('bulkCount').innerText = count;
  document.getElementById('bulkBar').classList.toggle('show', count > 0);
}

updateBulk();
</script>
@endsection