<form method="POST" action="{{ route('employee.update', $employee->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employee->name) }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">New Password (Leave blank to keep the same)</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <button type="submit" class="btn btn-primary">Update Employee</button>
</form>