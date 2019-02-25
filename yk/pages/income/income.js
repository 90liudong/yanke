// pages/income/income.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    utype:"",
    line:true,
    sign:true,
    date:"2018-01",
    len:false,
    record: [],
    statistics: [],
    total:0
  },
  One:function(){
    this.setData({
      line: true,
      sign: true,
    })
    console.log(this.data.record.length)
    if(!this.data.record.length){
      this.setData({
        len:true,
      })
    }else{
      this.setData({
        len: false,
      })
    }
  },
  Two: function () {
    this.setData({
      line: false,
      sign: false,
      len:false,
      statistics:this.data.record
    })
    console.log(this.data.utype)
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
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
        // console.log(that.data.orders.length)
        if (result.hasOwnProperty("order")) {
          that.setData({
            record: result.order,
            total:result.total,
            utype: app.globalData.usertype
          })
        } else {
          console.log(123456789)
          that.setData({
            len: true,
            utype: app.globalData.usertype
          })
        }

      }

    })
  },
  bindDateChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      date: e.detail.value
    })
  },
  tongji:function(){
    var that = this;
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/shouru',
      method: 'get',
      data: {
        token: app.globalData.token,
        dates: this.data.date
      },
      success: function (e) {
        var result = e.data
        console.log(result)
        // console.log(that.data.orders.length)
        if (result.order.length) {
          that.setData({
            statistics: result.order,
            total: result.total
          })
        } else {
          // console.log(123456789)
          that.setData({
            statistics: result.order,
            total:0

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