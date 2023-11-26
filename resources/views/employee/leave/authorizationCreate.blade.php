<form method="POST" action="{{ route('employee.storeAuthorization') }}">
    @csrf

    <div id="timeFields">
        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="reason" class="form-label">Reason</label>
        <textarea class="form-control" id="reason" name="reason" required>{{ old('reason') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Leave Request</button>
</form>
