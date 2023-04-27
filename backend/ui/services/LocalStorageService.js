export default {
  setAuthToken(token, expiresIn) {
    localStorage.setItem(
      'token',
      JSON.stringify(
        {
          token,
          expires: new Date().getTime() + expiresIn
        }
      )
    )
  },

  getAuthToken() {
    const itemStr = localStorage.getItem('token')
    if (!itemStr) {
      return null
    }
    const item = JSON.parse(itemStr)
    if (new Date().getTime() > item.expires) {
      localStorage.removeItem('token')
      return null
    }

    return item.token
  },

  clearAuthToken() {
    localStorage.removeItem('token')
  }
}
