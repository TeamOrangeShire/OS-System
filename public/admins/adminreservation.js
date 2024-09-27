 $(document).ready(function() {
    console.log('connect')
    $('#calendar').evoCalendar({
      theme: 'Orange Coral', // Optional: default theme is "Midnight Blue"
      language: 'en', // Optional: default language is English
      calendarEvents: [
        {
        id: 'bHay68s', // Event's ID (required)
        name: "New Year", // Event name (required)
        date: "September/29/2024", // Event date (required)
        type: "holiday", // Event type (required)
        },
        {
        name: "Vacation Leave",
        badge: "02/13 - 02/15", // Event badge (optional)
        date: ["September/1/2024", "September/15/2024"], // Date range
        description: `<h1>hello</h1>`, // Event description (optional)
        type: "event",
        color: "#63d867" // Event custom color (optional)
      }
      ] // Initialize with no events
    });
  });