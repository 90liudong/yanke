// pages/login/login.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    tel:"",
    password:""
  },
  telInput: function (e) {
    this.setData({
      tel: e.detail.value
    })
  },
  passwordInput: function (e) {
    this.setData({
      password: e.detail.value
    })
  },
  //事件处理函数
  tologin: function () {
    console.log(this.data.tel)
    console.log(this.data.password)
    var that = this
    //将账号密码校验，校验成功后将微信用户信息绑定，返回token并跳转到首页
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/login',
      method: 'post',
      data: {
        tel: that.data.tel,
        password: that.data.password,
        openid: app.globalData.openid,
        nickname: app.globalData.userInfo.nickName,
        headimg: app.globalData.userInfo.avatarUrl
      },
      success: function (e) {
        console.log(e.data.status)
        if(e.data.status){
          app.globalData.token = e.data.content.token
          app.globalData.usertype = e.data.content.type
          app.globalData.openid = e.data.content.openid
          // console.log(app.globalData)
          wx.redirectTo({
            url: '../homepage/homepage'
          })
        }else{
          wx.showToast({
            title: '帐号密码错误！',
            icon: 'success',
            duration: 1500
          })
          return false;
        }
        
      }

    })
  },
  toreg: function () {
    wx.redirectTo({
      url: '../index/index'
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
  
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
  
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
  
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },

  /**
   * 用户点击右上角分享
   */
  // onShareAppMessage: function () {
  
  // }
})