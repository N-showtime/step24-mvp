// import './bootstrap';
// import 'bootstrap/dist/css/bootstrap.min.css';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const eventsUrl = calendarEl.dataset.eventsUrl; // Bladeから渡されたURLを取得

   // カレンダー初期化
    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: 'ja',
        events: '/task/events',
    });

    // 他ファイルやフォームからも呼べるように
    window.calendar = calendar;

    calendar.render();
});



