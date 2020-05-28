Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'nova-contracts',
      path: '/nova-contracts',
      component: require('./components/Tool'),
    },
  ])
})
