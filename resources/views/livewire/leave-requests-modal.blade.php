
<div wire:ignore.self class="modal fade" id="leaveRequestsModal" tabindex="-1" aria-labelledby="leaveRequestsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaveRequestsModalLabel">Leave Requests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Display leave requests here -->
                <ul>
                   
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('showLeaveRequestsModal', () => {
            $('#leaveRequestsModal').modal('show');
        });

        $('#leaveRequestsModal').on('hidden.bs.modal', function () {
            Livewire.emit('resetLeaveRequests'); // Reset leave requests when the modal is closed
        });
    });
</script>
