// pages/invite/invite.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    inv:[],
    len:""
  },
  saveImgToPhotosAlbumTap: function (e) {
    var id = e.currentTarget.dataset["id"]
    var that = this;
    wx.downloadFile({
      url: that.data.inv[id],
      success: function (res) {
        console.log(res)
        wx.saveImageToPhotosAlbum({
          filePath: res.tempFilePath,
          success: function (res) {
            console.log(res)
          },
          fail: function (res) {
            console.log(res)
            console.log('fail')
          }
        })
      },
      fail: function () {
        console.log('fail')
      }
    })

  }, 
  copy1:function(e){
    var that = this
    var index = e.currentTarget.dataset["id"]
    if (index==1){
      var i=1
    }else{
      var i=0
    }
    wx.setClipboardData({
      data: that.data.inv[i],  //复制的内容
      success() {
        //成功之后的回调
        // console.log(123456)
        wx.showToast({
          title: '复制成功！',
          icon: 'success',
          duration: 1500
        })
      }
    
})
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/makeEwm',
      method: 'post',
      data: {
        "type": app.globalData.usertype,
        "token": app.globalData.token
      },
      success: function (e) {
        console.log(e.data)
        var utype =  app.globalData.usertype
        if(utype == 2){
          that.setData({
            len:1,
            inv:[e.data[0].ewm1]
          })
        }else{
          that.setData({
            len: 2,
            inv: [e.data[0].ewm1, e.data[0].ewm2]
          })
        }
        console.log(that.data.inv)
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