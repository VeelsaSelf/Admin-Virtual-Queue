@extends('layouts.app')
@section('title', 'Edit Staff')
@section('page-title', 'Edit Staff')
@section('page-subtitle', 'Update staff account information and permissions')

@section('content')
<style>
.edit-shell{
    background:#F9F7F4;
    border:1.5px solid #E5DDD5;
    border-radius:16px;
    padding:18px 18px 22px;
}
.avatar-wrap{
    display:flex;
    justify-content:center;
    margin:6px 0 16px;
}
.avatar-box{
    width:140px;
    height:140px;
    border-radius:14px;
    overflow:hidden;
    border:1.5px solid #D9D0C7;
    position:relative;
    background:#D8D8D8;
}
.avatar-box img{width:100%;height:100%;object-fit:cover;}
.avatar-edit{
    position:absolute;
    inset:auto 0 10px 0;
    margin:auto;
    width:34px;
    height:34px;
    border:none;
    border-radius:10px;
    background:rgba(44, 21, 3, .75);
    color:#fff;
    font-size:16px;
}
.section-label{
    font-size:13px;
    color:#9A8475;
    margin-bottom:8px;
}
.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px 14px;
}
.field label{
    display:block;
    font-size:13px;
    font-weight:600;
    color:#2C1A06;
    margin-bottom:6px;
}
.input, .select{
    width:100%;
    height:44px;
    border:1.5px solid #E0D7CE;
    border-radius:12px;
    padding:0 12px;
    font-size:13px;
    color:#4B5563;
    background:#fff;
    outline:none;
}
.actions{
    display:flex;
    justify-content:flex-end;
    gap:8px;
    margin-top:12px;
}
.btn{
    border:none;
    border-radius:9px;
    padding:8px 16px;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
}
.btn-cancel{background:#F5E7EB;color:#D94669;}
.btn-save{background:#8B5E1A;color:#fff;}
@media (max-width: 900px){
    .form-grid{grid-template-columns:1fr;}
}
</style>

<div class="edit-shell">
    <div class="avatar-wrap">
        <div class="avatar-box">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop" alt="Staff avatar">
            <button type="button" class="avatar-edit">✎</button>
        </div>
    </div>

    <div class="section-label">Staff Information</div>
    <div class="form-grid">
        <div class="field">
            <label>Full Name</label>
            <input class="input" value="Miguela Veloso">
        </div>
        <div class="field">
            <label>Username</label>
            <input class="input" value="mico.ela">
        </div>
        <div class="field">
            <label>Phone Number</label>
            <input class="input" value="+1-418-543-8090">
        </div>
        <div class="field">
            <label>Email Address</label>
            <input class="input" value="m.veloso23@gmail.com">
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
            <label>Password</label>
            <input class="input" type="password" value="********">
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <input class="input" type="password" value="********">
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('staff-management') }}" class="btn btn-cancel">Cancel</a>
        <button class="btn btn-save" type="button">Save Changes</button>
    </div>
</div>
@endsection
