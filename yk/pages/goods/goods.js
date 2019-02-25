// pages/goods/goods.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    shop:[]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/kucun',
      method: 'get',
      data: {
        token: app.globalData.token
      },
      success: function (e) {
        var result = e.data
        console.log(result)
        for (var i = 0; i < result.length; i++) {
          var img = result[i].image.replace('\\', '/')
          result[i].image = getApp().AppUrl + "static/uploads/product_pic/" + img
        }
        that.setData({
          shop: result
        })
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