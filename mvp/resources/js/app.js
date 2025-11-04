import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

// CSS
import '@fullcalendar/daygrid/main.css';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            events: '/events', // Laravelのルート
        });
        calendar.render();
    }
});
