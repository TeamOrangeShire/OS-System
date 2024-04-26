const driver = window.driver.js.driver;

const driverObj = driver({
    showProgress: true,
    showButtons: ['next', 'previous'],
    popoverClass: 'driverjs-theme',
    steps: [
        { element: '#scanner', popover: { title: 'QR Scanner', description: 'Clicking this will open your camera for you to be able to scan a Orange Shire QR Code', side: "left", align: 'start' }},
        { element: '#nav_status', popover: { title: 'Log Status', description: 'This will show if you are currently logged in to shire or not and the time and date of your login', side: "bottom", align: 'start' }},
        { element: '#nav_history', popover: { title: 'Log In History', description: 'By clicking this a table will be shown containing all the past logins you have in Orange Shire', side: "bottom", align: 'start' }},
      ],
      onDestroyStarted: () => {
        if (!driverObj.hasNextStep() || confirm("Are you sure you want to skipped the tour?")) {
          driverObj.destroy();
          UpdateTour('Login')

        }
      },
  });

  driverObj.drive();