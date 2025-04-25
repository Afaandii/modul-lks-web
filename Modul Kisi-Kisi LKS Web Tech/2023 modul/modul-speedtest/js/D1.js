  const calendarBody = document.getElementById('calendar-body');
  const calendarTitle = document.getElementById('calendar-title');
  const today = new Date();
  let currentDate = new Date(today.getFullYear(), today.getMonth(), 1);

  function renderCalendar() {
      calendarTitle.innerText = `${currentDate.toLocaleString('default', { month: 'long' })} ${currentDate.getFullYear()}`;

      const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
      const firstDayOfWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();

      calendarBody.innerHTML = ''; // Clear previous content

      // Add empty cells for days before the first day of the month
      for (let i = 0; i < firstDayOfWeek; i++) {
          const emptyCell = document.createElement('div');
          calendarBody.appendChild(emptyCell);
      }

      // Add cells for each day of the month
      for (let day = 1; day <= daysInMonth; day++) {
          const dayCell = document.createElement('div');
          dayCell.classList.add('calendar-day');
          dayCell.innerText = day;

          // Highlight today's date
          if (day === today.getDate() && currentDate.getMonth() === today.getMonth() && currentDate.getFullYear() === today.getFullYear()) {
              dayCell.classList.add('today');
          }

          calendarBody.appendChild(dayCell);
      }
  }

  function previousMonth() {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar();
  }

  function nextMonth() {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar();
  }

  renderCalendar();
