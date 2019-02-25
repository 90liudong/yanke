//app.js
App({
  AppUrl: "https://pxxy.90web.cn/",
  onLaunch: function () {
    
    // 展示本地存储能力
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)
    // var that = this
    // 登录

  },
  globalData: {
    userInfo: null,
    sign:0,
    openid:"",
    token:"",
    usertype:"",
    share:false,
    jump:true,
  }
})