<div class="mb-3">
    <label class="form-label">Kode Anggota</label>
    <input type="text" name="member_code" class="form-control"
           value="{{ old('member_code', $member->member_code ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $member->name ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Telepon</label>
    <input type="text" name="phone" class="form-control"
           value="{{ old('phone', $member->phone ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="address" class="form-control" rows="3">{{ old('address', $member->address ?? '') }}</textarea>
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>