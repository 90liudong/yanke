// pages/money/money.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    money:0.00,
    water:[]
  },
  totixian:function(){
    wx.navigateTo({
      url: '../tixian/tixian?money='+this.data.money,
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    if (options.hasOwnProperty("ti")){
      var pages = getCurrentPages();
      var Page = pages[pages.length - 1];//当前页
      var prevPage = pages[pages.length - 2];  //上一个页面
      var info = prevPage.data
      setTimeout(function () {
        prevPage.setData({
          sw: true
        })
        console.log(888888888999)
      }, 1000)
    }
    var that = this 
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/restprofit',
      method: 'get',
      data: {
        token: app.globalData.token
      },
      success: function (e) {
        var result = e.data
        console.log(result)

        that.setData({
          money: result.profit
        })
      }

    })
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/moneywater',
      method: 'get',
      data: {
        token: app.globalData.token
      },
      success: function (e) {
        var result = e.data
        console.log(result)

        that.setData({
          water: result
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