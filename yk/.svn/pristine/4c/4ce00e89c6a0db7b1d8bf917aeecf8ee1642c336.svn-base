//index.js
//获取应用实例
const app = getApp()
var code = require('../../public/js/code.js')
Page({
  data: {
    userInfo: {},
    tel:"",
    code1:"",
    password:"",
    password1:"",
    invcode:"",
    addr:"",
    unit:"",
    code2:"",
    hasUserInfo: false,
    canIUse: true,
    isShow: false,         //默认按钮1显示，按钮2不显示
    sec: "59",　　　　　　　//设定倒计时的秒数
    have:true,
    product:""
  },
  //事件处理函数
  bindViewTap: function() {
    wx.navigateTo({
      url: '../logs/logs'
    })
  },
  //将各类input数据拿到
  telInput: function (e) {
    this.setData({
      tel: e.detail.value
    })
  },
  codeInput: function (e) {
    this.setData({
      code1: e.detail.value
    })
  },
  passwordInput1: function (e) {
    this.setData({
      password: e.detail.value
    })
  },
  passwordInput2: function (e) {
    this.setData({
      password1: e.detail.value
    })
  },
  invcodeInput: function (e) {
    this.setData({
      invcode: e.detail.value
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
  //发送验证码
  getCode1: function (e) {
    var that = this
    console.log(this.data.tel)
    var mobile = this.data.tel
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
        "tel": this.data.tel
      },
      success: function (e) {
        that.setData({
          code2:e.data
        })
        console.log(that.data.code2)
      }
    })
    var _this = this;　　　　//防止this对象的混杂，用一个变量来保存
    var time = _this.data.sec　　//获取最初的秒数
    code.getCode(_this, time);　　//调用倒计时函数
  },
  //登录页
  tologin: function () {
    wx.redirectTo({
      url: '../login/login'
    })
  },
  //注册
  toreg: function () {
    if (this.data.password == "") {
      wx.showToast({
        title: '请输入密码！',
        duration: 1500
      })
      return false;
    }else{
      if (this.data.password1 == ""){
        wx.showToast({
          title: '请再次输入密码！',
          icon: "none",
          duration: 1500
        })
        return false;
      }
    }
    // 去缓存里拿数据product  有的话 是 分享进来注册的 没有的话 普通注册
  var that = this
    wx.getStorage({
      key: 'product',
      success: function (res) {
        console.log("99999",res.data)
        that.setData({
          have:false,
          product: res.data
        })
      }
    })
    console.log("",that.data.have)
    console.log("12345678",that.data.product)
    if(that.data.have){
      // 普通注册
      //做校验，密码，验证码，校验成功后提交数据库绑定
      if (this.data.code1 == this.data.code2 && this.data.code1!="") {
        if (this.data.password == this.data.password1) {
          wx.request({
            url: getApp().AppUrl + 'index.php/geng/jiekou/zhuce',
            method: 'GET',
            data: {
              tel: this.data.tel,
              password: this.data.password,
              invit_code: this.data.invcode,
              openid: app.globalData.openid,
              nickname: app.globalData.userInfo.nickName,
              headimg: app.globalData.userInfo.avatarUrl,
              addr: this.data.addr,
              unit: this.data.unit
            },
            success: function (e) {
              console.log("商品信息",e.data)
              var res = e.data
              if (res.status) {
                app.globalData.token = e.data.content.token
                app.globalData.usertype = e.data.content.type
                app.globalData.openid = e.data.content.openid
                wx.redirectTo({
                  url: '../homepage/homepage'
                })
              }else{
                wx.showModal({
                  title: '提示',
                  content: '该手机号已经被注册！',
                  success: function (res) {

                  }
                }) 
              }
            }
          })

        } else {
          wx.showToast({
            title: '密码不一致！',
            icon: 'success',
            duration: 1500
          })
          return false;
        }

      } else {
        wx.showToast({
          title: '验证码错误！',
          icon: 'success',
          duration: 1500
        })
        return false;
      }
    }else{
      // 分享注册
      if (this.data.code1 == this.data.code2 && this.data.code1 != "") {
        if (this.data.password == this.data.password1) {
          wx.request({
            url: getApp().AppUrl + 'index.php/geng/jiekou/zhuce',
            method: 'GET',
            data: {
              tel: this.data.tel,
              password: this.data.password,
              invit_code: this.data.invcode,
              openid: app.globalData.openid,
              nickname: app.globalData.userInfo.nickName,
              headimg: app.globalData.userInfo.avatarUrl,
              addr: this.data.addr,
              unit: this.data.unit
            },
            success: function (e) {
              console.log("商品信息2", e.data)
              var res = e.data
              if(res.status){
                app.globalData.token = e.data.content.token
                app.globalData.usertype = e.data.content.type
                app.globalData.openid = e.data.content.openid
                console.log("1234567",that.data.product)
                
                wx.redirectTo({
                  url: '../shop/shop?flag=sharetrue'
                })
              }else{
                wx.showModal({
                  title: '提示',
                  content: '该手机号已经被注册！',
                  success: function (res) {
    
                  }
                }) 
              }

            }
          })

        } else {
          wx.showToast({
            title: '密码不一致！',
            icon: 'success',
            duration: 1500
          })
          return false;
        }

      } else {
        wx.showToast({
          title: '验证码错误！',
          icon: 'success',
          duration: 1500
        })
        return false;
      }
    }

    
  },
  onLoad: function (options) {
    console.log("aaaaaaaaaa",options)
    if (options.hasOwnProperty("invcode")) {
      console.log(options)
      this.setData({
        invcode:options.invcode
      })
    }
    if (app.globalData.userInfo) {
      // console.log(app.globalData.userInfo)
      this.setData({
        userInfo: app.globalData.userInfo,
        hasUserInfo: true
      })
    } else if (this.data.canIUse){
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      app.userInfoReadyCallback = res => {
        this.setData({
          userInfo: res.userInfo,
          hasUserInfo: true
        })
      }
    } else {
      // 在没有 open-type=getUserInfo 版本的兼容处理
      wx.getUserInfo({
        success: res => {
          app.globalData.userInfo = res.userInfo
          this.setData({
            userInfo: res.userInfo,
            hasUserInfo: true
          })
        }
      })
    }
  },
  getUserInfo: function(e) {
    console.log(e)
    app.globalData.userInfo = e.detail.userInfo
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  }
})
