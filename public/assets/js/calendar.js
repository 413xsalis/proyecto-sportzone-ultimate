// calendar.js

// Envuelve todo el código en un evento que se dispara cuando el DOM está listo.
document.addEventListener('DOMContentLoaded', () => {

    // Referencias a los elementos del DOM.
    const calendarBody = document.getElementById('calendarBody');
    const monthSelector = document.getElementById('monthSelector');
    const prevButton = document.getElementById('prevMonth');
    const nextButton = document.getElementById('nextMonth');
    const dailyEventsContainer = document.getElementById('dailyEvents');
    const dailyEventsTitle = document.querySelector('#dailyEvents h5');

    // Almacena la fecha que se está mostrando.
    let currentDate = new Date();

    // Base de datos simulada de eventos. El mes se usa de 1 a 12 para más claridad.
    const events = [
        { day: 5, month: 8, year: 2025, title: 'Fútbol juvenil', time: '08:00 - 09:30', location: 'Cancha principal - Grupo A', status: 'Confirmado' },
        { day: 10, month: 8, year: 2025, title: 'Práctica de Baloncesto', time: '17:00 - 18:30', location: 'Gimnasio techado', status: 'Confirmado' },
        { day: 15, month: 8, year: 2025, title: 'Torneo de Fútbol', time: '10:00 - 12:00', location: 'Estadio principal', status: 'Próximo' },
        { day: 20, month: 8, year: 2025, title: 'Clase de Natación', time: '16:00 - 17:00', location: 'Piscina Olímpica', status: 'Confirmado' },
        { day: 25, month: 8, year: 2025, title: 'Entrenamiento de Atletismo', time: '07:00 - 09:00', location: 'Pista de Atletismo', status: 'Confirmado' },
    ];

    /**
     * Función para renderizar el calendario en el DOM.
     * Genera dinámicamente las celdas de los días para el mes y año actuales.
     */
    function renderCalendar() {
        // Limpiar el contenido anterior.
        calendarBody.innerHTML = '';

        // Obtener la información del mes y año actuales.
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const lastDayOfMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();

        // Obtener el día de la semana del primer día del mes (0 = domingo, 1 = lunes).
        let firstDayOfWeek = new Date(year, month, 1).getDay();
        // Ajustar para que la semana empiece en Lunes (0).
        if (firstDayOfWeek === 0) firstDayOfWeek = 6;
        else firstDayOfWeek--;

        let day = 1;
        let currentRow;

        // Llenar los días vacíos del mes anterior (si los hay).
        for (let i = 0; i < firstDayOfWeek; i++) {
            if (i % 7 === 0) {
                currentRow = document.createElement('div');
                currentRow.classList.add('calendar-row', 'd-flex');
                calendarBody.appendChild(currentRow);
            }
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('calendar-day', 'text-center', 'p-2', 'border');
            emptyCell.style.cssText = 'width: 14.28%; height: 60px;';
            currentRow.appendChild(emptyCell);
        }

        // Llenar los días del mes actual.
        while (day <= lastDayOfMonth) {
            if ((firstDayOfWeek + day - 1) % 7 === 0) {
                currentRow = document.createElement('div');
                currentRow.classList.add('calendar-row', 'd-flex');
                calendarBody.appendChild(currentRow);
            }

            const dayCell = document.createElement('div');
            dayCell.classList.add('calendar-day', 'text-center', 'p-2', 'border');
            dayCell.style.cssText = 'width: 14.28%; height: 60px; cursor: pointer;';
            dayCell.dataset.day = day;

            // Verificar si este día es el actual o si tiene eventos.
            const hasEvent = events.some(e => e.day === day && e.month === (month + 1) && e.year === year);
            const isToday = day === today.getDate() && month === today.getMonth() && year === today.getFullYear();

            // Crear el contenido del día (número e indicador de evento).
            dayCell.innerHTML = `
                <div class="d-flex flex-column h-100">
                    <div class="day-number ${isToday ? 'bg-primary text-white rounded-circle d-inline-block mx-auto' : ''}"
                        style="width: 24px; height: 24px; line-height: 24px;">
                        ${day}
                    </div>
                    ${hasEvent ? '<div class="event-indicator mt-auto"><span class="badge bg-success rounded-pill" style="font-size: 6px;">●</span></div>' : ''}
                </div>
            `;

            // Agregar el evento de clic a la celda del día.
            dayCell.addEventListener('click', () => {
                const selectedDay = parseInt(dayCell.dataset.day);
                renderDailyEvents(selectedDay, month + 1, year);
                // Opcional: Agregar clase de "activo" al día seleccionado.
                document.querySelectorAll('.calendar-day.active').forEach(cell => cell.classList.remove('active'));
                dayCell.classList.add('active');
            });

            currentRow.appendChild(dayCell);
            day++;
        }

        // Actualizar el valor del input del selector de mes.
        const monthString = currentDate.toISOString().slice(0, 7);
        monthSelector.value = monthString;
    }

    /**
     * Función para renderizar los eventos de un día seleccionado.
     * @param {number} selectedDay - El día del mes seleccionado.
     * @param {number} selectedMonth - El mes (1-12) seleccionado.
     * @param {number} selectedYear - El año seleccionado.
     */
    function renderDailyEvents(selectedDay, selectedMonth, selectedYear) {
        const today = new Date();
        const isToday = selectedDay === today.getDate() && selectedMonth === (today.getMonth() + 1) && selectedYear === today.getFullYear();

        // Filtrar los eventos para el día, mes y año seleccionados.
        const dailyEvents = events.filter(e => e.day === selectedDay && e.month === selectedMonth && e.year === selectedYear);

        // Título de la sección de eventos.
        if (isToday) {
            dailyEventsTitle.textContent = 'Actividades para hoy';
        } else {
            dailyEventsTitle.textContent = `Actividades para el ${selectedDay}/${selectedMonth}/${selectedYear}`;
        }

        // Generar el HTML de los eventos.
        let eventsHtml = '';
        if (dailyEvents.length > 0) {
            eventsHtml = dailyEvents.map(event => `
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">${event.title}</h6>
                        <small>${event.time}</small>
                    </div>
                    <p class="mb-1">${event.location}</p>
                    <small class="text-success"><i class="bi bi-check-circle"></i> ${event.status}</small>
                </a>
            `).join('');
        } else {
            eventsHtml = `
                <div class="alert alert-info" role="alert">
                    No hay actividades programadas para este día.
                </div>
            `;
        }

        // Actualizar el DOM.
        dailyEventsContainer.querySelector('.list-group').innerHTML = eventsHtml;
    }

    // Manejador para el botón de "mes anterior".
    prevButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
        renderDailyEvents(currentDate.getDate(), currentDate.getMonth() + 1, currentDate.getFullYear());
    });

    // Manejador para el botón de "mes siguiente".
    nextButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
        renderDailyEvents(currentDate.getDate(), currentDate.getMonth() + 1, currentDate.getFullYear());
    });

    // Manejador para el selector de mes.
    monthSelector.addEventListener('change', (e) => {
        const [year, month] = e.target.value.split('-');
        currentDate = new Date(year, month - 1, 1);
        renderCalendar();
        renderDailyEvents(currentDate.getDate(), currentDate.getMonth() + 1, currentDate.getFullYear());
    });

    // Llamar a las funciones al cargar la página para el estado inicial.
    renderCalendar();
    renderDailyEvents(new Date().getDate(), new Date().getMonth() + 1, new Date().getFullYear());

});