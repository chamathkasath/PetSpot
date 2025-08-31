<?php
// filepath: app/models/AvailableSlot.php
class AvailableSlot
{
    use Model;

    protected $table = 'available_slots';

    protected $allowedColumns = [
        'date',
        'start_time',   // <-- add this
        'end_time',     // <-- add this
        'vet_staff_id',
        'is_booked'
    ];
}