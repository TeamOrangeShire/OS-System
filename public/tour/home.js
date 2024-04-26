const driver = window.driver.js.driver;

const driverObj = driver({
    showProgress: true,
    showButtons: ['next', 'previous'],
    popoverClass: 'driverjs-theme',
    steps: [
        { element: '#currentCredit', popover: { title: 'Shire Credits', description: 'Your current credit will be shown here this is used for payment of some in app purchases', side: "left", align: 'start' }},
        { element: '#logStatus', popover: { title: 'Log Status', description: 'This will show if you are currently logged in to shire or not and the time and date of your login', side: "bottom", align: 'start' }},
        { element: '#available', popover: { title: 'Navigation Buttons', description: 'This buttons are clickable and it will take you to the pages of the app you want to use', side: "bottom", align: 'start' }},
        { element: '#unavailable', popover: { title: 'Locked Services', description: 'This buttons are clickable also but currently locked because it is under development', side: "bottom", align: 'start' }},
        { element: '#burger', popover: { title: 'Menu Bar', description: 'This is also another way of navigating the app\'s other pages', side: "left", align: 'start' }},
        { element: '#profilebtn', popover: { title: 'Profile', description: 'The Profile will also show you some basic info of your account and other navigation button including the sign out button', side: "top", align: 'start' }},
      ],
      onDestroyStarted: () => {
        if (!driverObj.hasNextStep() || confirm("Are you sure you want to skipped the tour?")) {
          driverObj.destroy();
          UpdateTour('Home')

        }
      },
  });

  driverObj.drive();

