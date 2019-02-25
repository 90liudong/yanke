// pages/order/order.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    orders:[],
    len:false,
    sw:true
  },
  toDetail:function(e){
    if (this.data.sw) {
      console.log(2222222222222222)
      this.setData({
        sw: false
      })
      app.globalData.jump = false
      var i = e.currentTarget.dataset["id"]
      wx.setStorage({
        key: "order",
        data: this.data.orders[i]
      })
      console.log(123456)
      wx.navigateTo({
        url: '../detail/detail',
      })
    }
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
    app.globalData.jump = true
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/findOrders',
      method: 'get',
      data: {
        token: app.globalData.token,
        type: app.globalData.usertype
      },
      success: function (e) {
        var result = e.data
        console.log(result)
        if (result.hasOwnProperty("order")){
          that.setData({
            orders: result.order
          })
        }else{
          that.setData({
            len: true
          })
        }

      }

    })
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
    // console.log(78997979798)
    // if(app.globalData.jump){
    //   wx.reLaunch({
    //     url: '../homepage/homepage'
    //   })
    // }

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
    // if (app.globalData.jump) {
    //   wx.reLaunch({
    //     url: '../homepage/homepage'
    //   })
    // }
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