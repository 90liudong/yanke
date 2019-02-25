// pages/modify/modify.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    tel:"",
    addr:"",
    unit:""
  },
  change:function(){
    wx.redirectTo({
      url: '../tel/tel?flag=tel&tel='+this.data.tel,
    })
  },
  change2: function () {
    wx.redirectTo({
      url: '../tel/tel?flag=addr&addr=' + this.data.addr + "&unit=" + this.data.unit,
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/liudong/yanke/getUserInfo',
      method: 'post',
      data: {
        token: app.globalData.token
      },
      success: function (e) {
        var result = e.data
        console.log(result)
        var tel1 = "" + result.tel
        tel1 = tel1.slice(0, 4) 
        var tel2 = "" + result.tel
        tel2 = tel2.slice(8,12) 
        // var tel2 = "" + result.tel.slice(0, 4)  
        result.tel = tel1+"****"+tel2
        that.setData({
          addr: result.addr,
          unit: result.unit,
          tel: result.tel

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