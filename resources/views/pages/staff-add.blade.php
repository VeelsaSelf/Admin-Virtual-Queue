@extends('layouts.app')
@section('title', 'Add New Staff')
@section('page-title', 'Add New Staff')
@section('page-subtitle', 'Create a new staff account and assign their role')

@section('content')
<style>
.staff-form-shell{
    background:#F9F7F4;
    border:1.5px solid #E5DDD5;
    border-radius:16px;
    padding:18px 18px 22px;
}
.upload-wrap{
    display:flex;
    justify-content:center;
    margin:2px 0 14px;
}
.upload-box{
    width:100%;
    max-width:430px;
    border:1.5px dashed #DDD3CA;
    border-radius:16px;
    text-align:center;
    background:#FAF8F6;
    padding:20px 16px 18px;
}
.upload-icon{
    width:32px;height:32px;border-radius:999px;background:#EFE8E1;color:#6F5A49;
    display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:16px;
}
.upload-title{font-size:14px;font-weight:600;color:#2C1A06;margin-bottom:4px;}
.upload-sub{font-size:12px;color:#9A8475;margin-bottom:10px;}
.upload-btn{
    border:1.5px solid #E0D7CE;background:#fff;color:#3E2D1D;border-radius:9px;
    padding:7px 14px;font-size:12px;font-weight:600;cursor:pointer;
}
.section-label{font-size:13px;color:#9A8475;margin-bottom:8px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px 14px;}
.field label{
    display:block;font-size:13px;font-weight:600;color:#2C1A06;margin-bottom:6px;
}
.input,.select{
    width:100%;height:44px;border:1.5px solid #E0D7CE;border-radius:12px;padding:0 12px;
    font-size:13px;color:#4B5563;background:#fff;outline:none;
}
.password-wrap{position:relative;}
.password-wrap .input{padding-right:38px;}
.password-eye{
    position:absolute;right:10px;top:50%;transform:translateY(-50%);
    border:none;background:transparent;color:#8B7A6B;cursor:pointer;
}
.actions{display:flex;justify-content:flex-end;gap:8px;margin-top:12px;}
.btn{
    border:none;border-radius:9px;padding:8px 16px;font-size:13px;font-weight:600;cursor:pointer;
}
.btn-cancel{background:#F5E7EB;color:#D94669;}
.btn-save{background:#8B5E1A;color:#fff;}
@media (max-width: 900px){ .form-grid{grid-template-columns:1fr;} }
</style>

<div class="staff-form-shell">
    <div class="upload-wrap">
        <div class="upload-box">
            <div class="upload-icon">⟳</div>
            <div class="upload-title">Choose a file or drag &amp; drop it here</div>
            <div class="upload-sub">JPEG, PNG, and SVG formats, up to 50MB</div>
            <button class="upload-btn" type="button">Browse Photo</button>
        </div>
    </div>

    <div class="section-label">Staff Information</div>
    <div class="form-grid">
        <div class="field">
            <label>Full Name</label>
            <input class="input" value="George Herrans">
        </div>
        <div class="field">
            <label>Username</label>
            <input class="input" value="jay.herrans">
        </div>
        <div class="field">
            <label>Phone Number</label>
            <input class="input" value="081234567890">
        </div>
        <div class="field">
            <label>Email Address</label>
            <input class="input" value="georgeherrans21@email.com">
        </div>
        <div class="field">
            <label>Role</label>
            <select class="select">
                <option selected>Cashier</option>
                <option>Barista</option>
                <option>Manager</option>
            </select>
        </div>
        <div class="field">
            <label>Status</label>
            <select class="select">
                <option selected>Active</option>
                <option>Inactive</option>
            </select>
        </div>
    </div>

    <div class="section-label" style="margin-top:14px;">Authentication</div>
    <div class="form-grid">
        <div class="field">
            <label>Create Password</label>
            <div class="password-wrap">
                <input class="input" type="password" value="staff19000">
                <button class="password-eye" type="button">&#128065;</button>
            </div>
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <div class="password-wrap">
                <input class="input" type="password" placeholder="Confirm Your Password">
                <button class="password-eye" type="button">&#128065;</button>
            </div>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('staff-management') }}" class="btn btn-cancel">Cancel</a>
        <button class="btn btn-save" type="button">Save Staff</button>
    </div>
</div>
@endsection
