@extends('layouts.app')
@section('title','Edit Profile')
@section('page-title','Edit Profile')
@section('page-subtitle','Update your personal information and account details')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>

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

.profile-card {
    background:#fff;
    border:1.5px solid #E5DAD0;
    border-radius:12px;
    padding:36px 40px 40px;
    box-shadow:0 2px 16px rgba(44,21,3,.05);
    width:100%;
    animation: fadeIn .3s ease both;
}

/* ── Avatar ── */
.avatar-section {
    display:flex; justify-content:center;
    margin-bottom:32px;
}
.avatar-wrap {
    position:relative; width:180px; height:180px;
    cursor:pointer; flex-shrink:0;
}
.avatar-wrap img {
    width:100%; height:100%; object-fit:cover;
    border-radius:14px; border:1.5px solid #E5DAD0; display:block;
}
.avatar-overlay {
    position:absolute; inset:0; border-radius:14px;
    background:rgba(26,14,4,.45);
    display:flex; align-items:center; justify-content:center;
    opacity:0; transition:opacity .2s;
}
.avatar-wrap:hover .avatar-overlay { opacity:1; }
.avatar-overlay i { font-size:32px; color:#fff; }

/* ── Section header ── */
.section-header {
    font-size:11px; font-weight:700;
    letter-spacing:1px; text-transform:uppercase;
    color:#9A8070; margin-bottom:18px;
}

/* ── Form ── */
.form-grid {
    display:grid; grid-template-columns:1fr 1fr;
    gap:18px 28px; margin-bottom:28px;
}
.fg { display:flex; flex-direction:column; gap:7px; }
.fl { font-size:13.5px; font-weight:600; color:#1A0E04; }
.fc {
    width:100%; padding:12px 15px;
    border:1.5px solid #E5DAD0; border-radius:9px;
    font-family:'DM Sans',sans-serif;
    font-size:13.5px; color:#1A0E04;
    background:#F7F3EE; outline:none;
    transition:border-color .2s, box-shadow .2s;
    box-sizing:border-box;
}
.fc:focus {
    border-color:#C17A3A;
    box-shadow:0 0 0 3px rgba(193,122,58,.12);
}
.fc:disabled {
    background:#EDE5DA; color:#9A8070; cursor:not-allowed;
}
.fc::placeholder { color:#9A8070; }

.pw-wrap { position:relative; }
.pw-wrap .fc { padding-right:46px; }
.pw-eye {
    position:absolute; right:14px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer;
    color:#9A8070; font-size:18px;
    display:flex; align-items:center; line-height:1;
}
.pw-eye:hover { color:#1A0E04; }

/* ── Divider ── */
.section-divider {
    border:none; border-top:1.5px solid #F0EBE3; margin:0 0 24px;
}

/* ── Buttons ── */
.form-actions {
    display:flex; gap:10px; justify-content:flex-end; margin-top:4px;
}
.btn-cancel {
    padding:11px 26px; border-radius:9px;
    border:1.5px solid #F5C0C8; background:#FDEEF0;
    color:#B93A2A; font-family:'DM Sans',sans-serif;
    font-size:13.5px; font-weight:600; cursor:pointer;
    text-decoration:none; display:inline-flex; align-items:center;
    transition:background .15s;
}
.btn-cancel:hover { background:#f8d6da; }
.btn-save {
    padding:11px 26px; border-radius:9px; border:none;
    background:#2C1503; color:#fff;
    font-family:'DM Sans',sans-serif;
    font-size:13.5px; font-weight:600; cursor:pointer;
    box-shadow:0 2px 10px rgba(44,21,3,.25);
    transition:background .15s, transform .15s, box-shadow .15s;
}
.btn-save:hover {
    background:#7A4520; transform:translateY(-1px);
    box-shadow:0 6px 18px rgba(44,21,3,.28);
}
.btn-save:active { transform:translateY(0); }

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
.toast-icon { width:38px; height:38px; border-radius:50%; background:#F0FDF4; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.toast-title { font-size:13px; font-weight:700; color:#1f2937; margin:0 0 2px; }
.toast-msg   { font-size:12px; color:#6b7280; margin:0; }
.toast-close { margin-left:auto; background:none; border:none; cursor:pointer; color:#9ca3af; padding:4px; display:flex; align-items:center; border-radius:6px; transition:background .15s; }
.toast-close:hover { background:#f3f4f6; }
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

<script>
function closeToast(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.animation = 'slideDown .3s ease forwards';
    setTimeout(() => el.remove(), 300);
}
function previewAvatar(e) {
    const file = e.target.files[0];
    if (!file) return;
    const r = new FileReader();
    r.onload = ev => document.getElementById('avatarPreview').src = ev.target.result;
    r.readAsDataURL(file);
}
function togglePw(inputId, iconId) {
    const inp  = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (inp.type === 'password') { inp.type = 'text';     icon.className = 'ph ph-eye'; }
    else                         { inp.type = 'password'; icon.className = 'ph ph-eye-slash'; }
}
</script>

<div class="profile-card">

    {{-- ── Avatar ── --}}
    <div class="avatar-section">
        <div class="avatar-wrap" onclick="document.getElementById('avatarInput').click()">
            <img id="avatarPreview"
                 src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop"
                 alt="Profile Photo">
            <div class="avatar-overlay"><i class="ph ph-image-square"></i></div>
        </div>
        <input type="file" id="avatarInput" accept="image/*"
               style="display:none;" onchange="previewAvatar(event)">
    </div>

    <form action="{{ route('edit-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ── Staff Information ── --}}
        <p class="section-header">Staff Information</p>
        <hr class="section-divider">

        <div class="form-grid">
            <div class="fg">
                <label class="fl" for="fullName">Full Name</label>
                <input class="fc" type="text" id="fullName" name="full_name"
                       value="Miguela Veloso" required>
                @error('full_name')
                    <p style="color:#ef4444; font-size:12px; margin:0;">{{ $message }}</p>
                @enderror
            </div>
            <div class="fg">
                <label class="fl" for="username">Username</label>
                <input class="fc" type="text" id="username" name="username"
                       value="mico.ela" required>
                @error('username')
                    <p style="color:#ef4444; font-size:12px; margin:0;">{{ $message }}</p>
                @enderror
            </div>
            <div class="fg">
                <label class="fl" for="phone">Phone Number</label>
                <input class="fc" type="tel" id="phone" name="phone"
                       value="+1-418-543-8090" required>
                @error('phone')
                    <p style="color:#ef4444; font-size:12px; margin:0;">{{ $message }}</p>
                @enderror
            </div>
            <div class="fg">
                <label class="fl" for="email">Email Address</label>
                <input class="fc" type="email" id="email" name="email"
                       value="m.veloso23@gmail.com" required>
                @error('email')
                    <p style="color:#ef4444; font-size:12px; margin:0;">{{ $message }}</p>
                @enderror
            </div>
            <div class="fg">
                <label class="fl" for="role">Role</label>
                <input class="fc" type="text" id="role" value="Cashier" disabled>
            </div>
        </div>

        {{-- ── Authentication ── --}}
        <p class="section-header">Authentication</p>
        <hr class="section-divider">

        <div class="form-grid">
            <div class="fg">
                <label class="fl" for="password">Password</label>
                <div class="pw-wrap">
                    <input class="fc" type="password" id="password"
                           name="password" value="password123">
                    <button type="button" class="pw-eye" onclick="togglePw('password','eye1')">
                        <i id="eye1" class="ph ph-eye-slash"></i>
                    </button>
                </div>
                @error('password')
                    <p style="color:#ef4444; font-size:12px; margin:0;">{{ $message }}</p>
                @enderror
            </div>
            <div class="fg">
                <label class="fl" for="passwordConfirm">Confirm Password</label>
                <div class="pw-wrap">
                    <input class="fc" type="password" id="passwordConfirm"
                           name="password_confirmation" value="password">
                    <button type="button" class="pw-eye" onclick="togglePw('passwordConfirm','eye2')">
                        <i id="eye2" class="ph ph-eye-slash"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- ── Actions ── --}}
        <div class="form-actions">
            <a href="{{ route('staff-management') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-save">Save Changes</button>
        </div>

    </form>
</div>

@endsection