const driver = window.driver.js.driver;

const driverObj = driver({
    showProgress: true,
    showButtons: ['next', 'previous'],
    popoverClass: 'driverjs-theme',
    steps: [
        { element: '#nav_overview', popover: { title: 'Profile Overview', description: 'This tabs contains the overview of your account details', side: "left", align: 'start' }},
        { element: '#nav_edit', popover: { title: 'Edit Profile', description: 'By Clicking this a form for editing your accounts info will appear then you can start editing it and save changes', side: "bottom", align: 'start' }},
        { element: '#nav_changepass', popover: { title: 'Change Password', description: 'By Clicking this a form for change password will appear and let you change your accounts password', side: "bottom", align: 'start' }},
        
      ],
      onDestroyStarted: () => {
        if (!driverObj.hasNextStep() || confirm("Are you sure you want to skipped the tour?")) {
          driverObj.destroy();
          UpdateTour('Profile')

        }
      },
  });

  driverObj.drive();