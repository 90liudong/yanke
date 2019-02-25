// pages/tel/tel.js
const app = getApp()
var code = require('../../public/js/code.js')
Page({

  /**
   * 页面的初始数据
   */
  data: {
    sign:"",
    tel:"",
    newTel:"",
    isShow: false,         //默认按钮1显示，按钮2不显示
    sec: "59",　　　　　　　//设定倒计时的秒数
    code:"",
    code1:"",
    addr:"",
    unit:""
  },
  telInput: function (e) {
    this.setData({
      newTel: e.detail.value
    })
  },
  codeInput: function (e) {
    this.setData({
      code1: e.detail.value
    })
  },
  addrInput: function (e) {
    this.setData({
      addr: e.detail.value
    })
  },
  unitInput: function (e) {
    this.setData({
      unit: e.detail.value
    })
  },
  getCode1: function (e) {
    var that = this
    console.log(this.data.newTel)
    var mobile = this.data.newTel
    if (mobile.length == 0) {
      wx.showToast({
        title: '请输入手机号！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
    if (mobile.length != 11) {
      wx.showToast({
        title: '号码长度有误！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
    var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/;
    if (!myreg.test(mobile)) {
      wx.showToast({
        title: '手机号有误！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
    //发送验证码并返回code1
    wx.request({
      url: getApp().AppUrl + 'index.php/liudong/yanke/sendSMS',
      method: 'get',
      data: {
        "tel": this.data.newTel
      },
      success: function (e) {
        that.setData({
          code: e.data
        })
        console.log(that.data.code)
      }
    })
    var _this = this;　　　　//防止this对象的混杂，用一个变量来保存
    var time = _this.data.sec　　//获取最初的秒数
    code.getCode(_this, time);　　//调用倒计时函数
  },
  changeTel:function(){
    var that = this
    if (this.data.code == this.data.code1 && this.data.code1 != "") {
      wx.request({
        url: getApp().AppUrl + 'index.php/geng/jiekou/bphone',
        method: 'get',
        data: {
          token: app.globalData.token,
          newtel:this.data.newTel
        },
        success: function (e) {
          var result = e.data
          console.log(result)
          if(result.status){
            wx.redirectTo({
              url: '../self/self',
            })
          } else {
            wx.showModal({
              title: '提示',
              content: "" + result.content
            })
          }
          that.setData({
              code:"",
              code1: ""
              
          })
        }

      })
    } else {
      wx.showToast({
        title: '验证码错误！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
  },
  changeAddr: function () {
    var that = this
    if (this.data.addr != "" && this.data.unit != "") {
      wx.request({
        url: getApp().AppUrl + 'index.php/geng/jiekou/addrunit',
        method: 'get',
        data: {
          token: app.globalData.token,
          addr: this.data.addr,
          unit: this.data.unit
          
        },
        success: function (e) {
          var result = e.data
          console.log(result)
          if (result.status) {
            wx.navigateTo({
              url: '../self/self',
            })
          } else {
            wx.showModal({
              title: '提示',
              content: "" + result.content
            })
          }
          that.setData({
            code: "",
            code1: ""

          })
        }

      })
    } else {
      wx.showToast({
        title: '请输入！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    console.log(options)
    if(options.flag == "tel"){
      this.setData({
        tel:options.tel,
        sign:options.flag
      })
    }else{
      console.log(options)
      console.log(options.unit)
      this.setData({
        addr: options.addr,
        unit: options.unit,        
        sign: options.flag
      })
    }
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