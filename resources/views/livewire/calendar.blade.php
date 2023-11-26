<!-- resources/views/livewire/calendar.blade.php -->

<div>
    @push('scripts')
        <!-- Include FullCalendar CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />

        <!-- Include Livewire Scripts -->
        @livewireStyles

        <!-- Include FullCalendar Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>

        <!-- Include Livewire Scripts -->
        @livewireScripts

        <!-- Initialize FullCalendar -->
        <script>
            document.addEventListener('livewire:load', function () {
                // Livewire hook to initialize FullCalendar
                Livewire.hook('message.processed', (message, component) => {
                    if (message.updateQueue && message.updateQueue.hasOwnProperty('fullCalendar')) {
                        $('#calendar').fullCalendar('refetchEvents');
                    }
                });

                // FullCalendar initialization
                $('#calendar').fullCalendar({
                    // Add your FullCalendar options here
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: @this.events(),
                    eventClick: function (calEvent, jsEvent, view) {
                        // Handle event click
                        // Example: Livewire.emit('eventClicked', calEvent.id);
                    },
                });
            });
        </script>
    @endpush

    <div id="calendar"></div>
</div>
