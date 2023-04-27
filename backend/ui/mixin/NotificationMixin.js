export default {
  methods: {
    simpleError (message) {
      const options = {
        message,
        buttons: ['X'],
        buttonsClass: 'notification-dialog-close-button',
        boxClass: 'alert alert-danger text-center notification-dialog'
      }

      this.$dialog(options)
    }
  }
}
