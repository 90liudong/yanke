//js
Page({
  data: {
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    up_id:"",
    id:"",
    invnum:""
  },
  onLoad: function (options) {
    console.log("set",options);
    var that = this;
    if (options.hasOwnProperty("up_id")){
      this.setData({
        up_id: options.up_id
      })
    }
    if (options.hasOwnProperty("invnum")) {
      this.setData({
        invnum: options.invnum,
        id:options.id
      })
    }
    // 查看是否授权
    wx.getSetting({
      success: function (res) {
        console.log("set", res.authSetting['scope.userInfo'])
        if (res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称
          // wx.getUserInfo({
          //   success: function (res) {
          //     console.log(res.userInfo)
          //   }
          // })
          if(that.data.invnum){
            wx.redirectTo({
              url: '../load/load?id=' + that.data.id + '&invnum=' + that.data.invnum,
            })
          } else if (that.data.up_id){
            wx.redirectTo({
              url: '../load/load?up_id='+that.data.up_id,
            })
          }else{
            wx.redirectTo({
              url: '../load/load',
            })
          }


        }
      }
    })
  },
  bindGetUserInfo: function (e) {
    var that = this;
    if (that.data.invnum) {
      wx.redirectTo({
        url: '../load/load?id=' + that.data.id + '&invnum=' + that.data.invnum,
      })
    } else if (that.data.up_id) {
      wx.redirectTo({
        url: '../load/load?up_id=' + that.data.up_id,
      })
    } else {
      wx.redirectTo({
        url: '../load/load',
      })
    }
  }
})