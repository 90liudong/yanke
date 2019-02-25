// pages/password/password.js
const app = getApp()
var code = require('../../public/js/code.js')
Page({

  /**
   * 页面的初始数据
   */
  data: {
    userInfo: {},
    tel: "",
    code1: "",
    invcode: "",
    addr: "123",
    unit: "",
    code2: "",
    hasUserInfo: false,
    canIUse: true,
    isShow: false,         //默认按钮1显示，按钮2不显示
    sec: "59",　　　　　　//设定倒计时的秒数
    haspayword:"",
    changeType:"",
    password: "",
    password1: "",
    password2: "",
    payword1:"",
    payword2:""
    
  },

  //将各类input数据拿到
  //设置资金密码
  setPassword1: function (e) {
    this.setData({
      payword1: e.detail.value
    })
  },
  setPassword2: function (e) {
    this.setData({
      payword2: e.detail.value
    })
  },
  setpayword:function(){
    //校验成功则上传绑定并跳转到个人中心
    if (this.data.payword1 == this.data.payword2){
      wx.request({
        url: getApp().AppUrl + 'index.php/geng/jiekou/makepay',
        method: 'post',
        data: {
          "token": app.globalData.token,
          "pay_password": this.data.payword1
        },
        success: function (e) {
          console.log(e)
          var result = e.data
          if(result.status){
            wx.showToast({
              title: '设置成功！',
              icon: 'success',
              duration: 1500
            })
            wx.navigateTo({
              url: '../self/self'
            })
          }
        }

      })
    }else{
      wx.showToast({
        title: '密码不一致！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
  },
  //修改密码
  passwordInput: function (e) {
    this.setData({
      password: e.detail.value
    })
  },
  passwordInput1: function (e) {
    this.setData({
      password1: e.detail.value
    })
  },
  passwordInput2: function (e) {
    this.setData({
      password2: e.detail.value
    })
  },
  setLoginPassword:function(){
    // 校验两次密码 对了 校验旧密码 错了 返回 全部正确 体交修改
    console.log(123123123123123)
    if (this.data.password1 == "" && this.data.password2 == "" ){
        wx.showToast({
          title: '请输入密码！',
          icon: 'success',
          duration: 1500
        })
        return false; 
    }
    if (this.data.password1 == this.data.password2){
      // 1 修改登录密码 2修改资金密码 
      if(this.data.changeType == 1){
        wx.request({
          url: getApp().AppUrl + 'index.php/geng/jiekou/newnums',
          method: 'post',
          data: {
            "token": app.globalData.token,
            "password": this.data.password,
            "newpassword": this.data.password1
          },
          success: function (e) {
            console.log(e)
            var result = e.data
            if (result.status) {
              wx.showToast({
                title: '修改成功！',
                icon: 'success',
                duration: 1500
              })
              setTimeout(function () {
                wx.navigateBack({
                  url: '../self/self'
                })
              }, 1000);
            }else{
              wx.showToast({
                title: '旧密码错误！',
                icon: 'success',
                duration: 1500
              })
            }
          }

        })
      }else{
        wx.request({
          url: getApp().AppUrl + 'index.php/geng/jiekou/moneynum',
          method: 'post',
          data: {
            "token": app.globalData.token,
            "pay_password": this.data.password,
            "newpay": this.data.password1
          },
          success: function (e) {
            console.log(e)
            var result = e.data
            if (result.status) {
              wx.showToast({
                title: '修改成功！',
                icon: 'success',
                duration: 1500
              })
              setTimeout(function () {
                wx.navigateBack({
                  url: '../self/self'
                })
              }, 1000);
            } else {
              wx.showToast({
                title: '旧密码错误！',
                icon: 'success',
                duration: 1500
              })
            }
          }

        })
      }
    }else{
      wx.showToast({
        title: '密码不一致！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
  },


  codeInput: function (e) {
    this.setData({
      code1: e.detail.value
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
    console.log(this.data.tel)
    console.log(this.data.code)
    console.log(this.data.password)
    console.log(this.data.password1)
    console.log(this.data.invcode)
    var mobile = this.data.tel
    //发送验证码并返回code1
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
        title: '手机号长度有误！',
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
    //做校验，密码，验证码，校验成功后提交数据库绑定
    wx.redirectTo({
      url: '../homepage/index'
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
    var type = options.type
    console.log(type)
    this.setData({
      changeType:type
    })
    if(type==1){
      this.setData({
        haspayword: true
      })
    }else{
      wx.request({
        url: getApp().AppUrl + 'index.php/geng/jiekou/ispay',
        method: 'post',
        data:{
          "token":app.globalData.token
        },
        success: function (e) {
          console.log(e)
          var result = e.data
          that.setData({
            haspayword: result.status
          })
          if (!result.status){
            wx.setNavigationBarTitle({
              title: '设置资金密码'
            })
          }

        }

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