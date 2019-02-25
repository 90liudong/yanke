// pages/tixian/tixian.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    show:false,
    can:0,
    codenum:"",
    name:"",
    money:"",
    payword:"",
    sw:true
  },
  codenumInput: function (e) {
    this.setData({
      codenum: e.detail.value
    })
  },
  nameInput: function (e) {
    this.setData({
      name: e.detail.value
    })
  },
  moneyInput: function (e) {
    var regNum = new RegExp('^[0-9]+\.?[0-9]{0,2}$', 'g'); 
    var rsNum = regNum.exec(e.detail.value); 
    
    console.log("dfadsaf", rsNum  )
  if(rsNum){
    this.setData({
      money: e.detail.value
    })
  }else{
    this.setData({
      money: ""
    })
    wx.showModal({
      title: '提示',
      content: "请正确输金额！",
      showCancel: false
    })
    return false;
  }

  },
  paywordInput: function (e) {
    this.setData({
      payword: e.detail.value
    })
  },
  sub:function(){
    var that = this
    if(that.data.num==""){
      wx.showModal({
        title: '提示',
        content: "请输入银行卡号",
        showCancel: false 
      })
      return false
    }
    if (that.data.name == "") {
      wx.showModal({
        title: '提示',
        content: "请输入银行卡姓名",
        showCancel: false
      })
      return false
    }
    if (that.data.money < 100 || that.data.money==".") {
      var val = that.data.money 
      if (val === "" || val == null) {
        wx.showModal({
          title: '提示',
          content: "请输入金额！",
          showCancel: false
        })
        return false;
      }
      wx.showModal({
        title: '提示',
        content: "提现额度最低为100元",
        showCancel: false
      })
      return false
    }
    if(that.data.sw){
      console.log("aaaaa", that.data.money)
      that.setData({
        sw: false
      })
      wx.request({
        url: getApp().AppUrl + 'index.php/geng/jiekou/bring',
        method: 'post',
        data: {
          token: app.globalData.token,
          bank: that.data.codenum,
          name: that.data.name,
          num: that.data.money,
          pay_password: that.data.payword,
        },
        success: function (e) {
          wx.setStorage({
            key: "bank",
            data: that.data.codenum
          })
          wx.setStorage({
            key: "bankname",
            data: that.data.name
          })
          var result = e.data
          console.log(result)
          if (result.status) {
            console.log("发起提现成功！")
            // that.setData({
            //   sw: true
            // })
            console.log(9999+"aaaaaaaa")
            wx.redirectTo({
              url: '../money/money?ti=yes',
            })
          } else {
            that.setData({
              sw: true
            })
            wx.showModal({
              title: '提示',
              content: "" + result.content,
              showCancel: false

            })
          }


        }

      })
    }

  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    console.log(options)
    var that = this    
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/ispay',
      method: 'post',
      data: {
        "token": app.globalData.token
      },
      success: function (e) {
        console.log(e)
        var result = e.data
        if (!result.status) {
          wx.redirectTo({
            url: '../password/password?type=2'
          })
        }else{
          wx.getStorage({
            key: 'bank',
            success: function (res) {
              that.setData({
                codenum: res.data
              })
            }
          })
          wx.getStorage({
            key: 'bankname',
            success: function (res) {
              that.setData({
                name: res.data
              })

            }
          })
          that.setData({
            can: options.money,
            show: true
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