<form method="POST" action="{{route('leaves.store')}}">
    @csrf

    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
    </div>

    <div class="mb-3">
        <label for="reason" class="form-label">Reason</label>
        <textarea class="form-control" id="reason" name="reason" required>{{ old('reason') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Leave Request</button>
</form>
