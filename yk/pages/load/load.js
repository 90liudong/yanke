const app = getApp()
Page({
  data: {
    // text:"这是一个页面"
    hiddenLoading:false,
    canIUse: wx.canIUse('button.open-type.getUserInfo')
  },

  /**
  * 监听button点击事件
  */
  listenerButton: function () {
    this.setData({
      hiddenLoading: !this.data.hiddenLoading
    })
  },
  onLoad: function (options) {
    console.log(this.data.canIUse)
    var that = this
    console.log("load", options)
    wx.getSetting({
      success: function (res) {
        console.log(res.authSetting['scope.userInfo'])
        if (res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称


          if (options.hasOwnProperty("up_id")) {
            wx.setStorage({
              key: "over_id",
              data: options.up_id
            })
          }
          if (options.hasOwnProperty("flag")) {
            // // 分享用户进来注册流程
            wx.login({
              success: res => {
                // 发送 res.code 到后台换取 openId, sessionKey, unionId
                if (res.code) {
                  //发起网络请求
                  wx.request({
                    url: app.AppUrl + 'index.php/liudong/yanke/login',
                    method: 'post',
                    data: {
                      code: res.code
                    },
                    success: function (e) {
                      var result = e.data
                      console.log(22222222, result)
                      //有注册过 就 进入首页
                      if (result.sign == 1) {
                        app.globalData.sign = 1
                        app.globalData.openid = result.openid
                        wx.getSetting({
                          success(res) {
                            console.log(res.authSetting['scope.userInfo'])
                            // if (!res.authSetting['scope.userInfo']) {
                            wx.getUserInfo({
                              success: res => {
                                // 可以将 res 发送给后台解码出 unionId
                                console.log(res.userInfo)
                                app.globalData.userInfo = res.userInfo
                                if (that.userInfoReadyCallback) {
                                  that.userInfoReadyCallback(res)
                                }
                                // options.uuuid = options.uid
                                //跳转之前将商品信息存入缓存
                                wx.setStorage({
                                  key: "product",
                                  data: options
                                })
                                wx.showModal({
                                  title: '提示',
                                  content: '您还未注册，请先完成注册！',
                                  showCancel: false,
                                  success: function (res) {
                                    if (res.confirm) {
                                      console.log('用户点击确定')
                                      wx.redirectTo({
                                        url: '../index/index'
                                      })
                                    } else {
                                      wx.removeStorage({
                                        key: 'product',
                                        success: function (res) {
                                          console.log(res.data)
                                          console.log("ccccccccccccc")

                                        }
                                      })
                                      console.log('用户点击取消')
                                      wx.navigateBack({//返回
                                        delta: 1
                                      })
                                    }
                                  }
                                })
                              },
                              fail: function () {
                                wx.showModal({
                                  title: '警告',
                                  content: '您点击了拒绝授权，无法使用此功能。',
                                  success: function (res) {
                                    if (res.confirm) {
                                      console.log('用户点击确定')
                                    } else {
                                      console.log('用户点击取消')
                                    }
                                  }
                                })
                                // wx.openSetting({
                                //   success: function(res) {
                                //     if(res.authSetting["scope.userInfo"]) {

                                //     } // 如果成功打开授权
                                //     else {

                                //     } // 如果用户依然拒绝授权
                                //   },
                                //   fail: function () { //调用失败，授权登录不成功
                                //     fail()
                                //   }
                                // })
                              }
                            })
                            // }
                          }
                        })
                      } else {
                        //跳转之前将商品信息存入缓存
                        wx.setStorage({
                          key: "product",
                          data: options
                        })
                        app.globalData.sign = 2
                        app.globalData.token = result.token
                        app.globalData.openid = result.openid
                        app.globalData.usertype = result.type
                        console.log("assssssss", app.globalData.usertype)
                        console.log("aaaaaaaaa", result.type)
                        if (result.type != 5) {
                          wx.showModal({
                            title: '提示',
                            content: '您非C1型用户，无法打开此页面！',
                            success: function (res) {
                              if (res.confirm) {
                                console.log('用户点击确定')
                                wx.redirectTo({
                                  url: '../homepage/homepage'
                                })
                                // return false;
                              } else {
                                wx.redirectTo({
                                  url: '../homepage/homepage'
                                })
                                console.log('用户点击取消')
                                // return false;
                              }
                            }
                          })
                          return false;
                        } else {
                          wx.redirectTo({
                            url: '../shop/shop?flag=sharetrue'
                          })
                        }

                      }
                    },
                    fail: function (e) {
                      console.log(e)
                    }

                  })
                } else {
                  console.log('获取用户登录态失败！' + res.errMsg)
                }

              }
            })
          } else {
            // // 普通用户进来注册流程
            wx.login({
              success: res => {
                // 发送 res.code 到后台换取 openId, sessionKey, unionId
                if (res.code) {
                  //发起网络请求
                  wx.request({
                    url: app.AppUrl + 'index.php/liudong/yanke/login',
                    method: 'post',
                    data: {
                      code: res.code
                    },
                    success: function (e) {
                      var result = e.data
                      console.log(111111111111, result)
                      //如果没注册或者没绑定过 直接进去登录注册页然后再获取个人信息
                      //有注册过 就 进入首页

                      if (result.sign == 1) {

                        app.globalData.sign = 1
                        app.globalData.openid = result.openid
                        wx.getSetting({
                          success(res) {
                            console.log("8888", res.authSetting['scope.userInfo'])
                            // if (!res.authSetting['scope.userInfo']) {
                            wx.getUserInfo({
                              success: res => {
                                // 可以将 res 发送给后台解码出 unionId
                                console.log(res.userInfo)
                                app.globalData.userInfo = res.userInfo
                                if (that.userInfoReadyCallback) {
                                  that.userInfoReadyCallback(res)
                                }
                                if (options.hasOwnProperty("invnum")) {
                                  console.log("xxxxxxxx", options);
                                  wx.redirectTo({
                                    url: '../index/index?invcode=' + options.invnum
                                  })
                                } else {
                                  wx.redirectTo({
                                    url: '../index/index'
                                  })
                                }
                              },
                              fail: function () {
                                wx.showModal({
                                  title: '警告',
                                  content: '您点击了拒绝授权，无法使用此功能。',
                                  success: function (res) {
                                    if (res.confirm) {
                                      console.log('用户点击确定')
                                      wx.openSetting({
                                        success: (res) => {
                                          if (res.authSetting["scope.userInfo"]) {////如果用户重新同意了授权登录
                                            wx.getUserInfo({
                                              success: function (res) {
                                                var userInfo = res.userInfo;
                                                that.setData({
                                                  nickName: userInfo.nickName,
                                                  avatarUrl: userInfo.avatarUrl,
                                                })
                                              }
                                            })
                                          }
                                        }, fail: function (res) {

                                        }
                                      })
                                      return false

                                    } else {
                                      console.log('用户点击取消')
                                      return false

                                    }
                                  }
                                })

                              }
                            })
                            // }
                          }
                        })
                      } else {
                        console.log(result.status)
                        if (result.status == 0) {
                          wx.getUserInfo({
                            success: res => {
                              // 可以将 res 发送给后台解码出 unionId
                              console.log("4654654564", res.userInfo)
                              app.globalData.userInfo = res.userInfo
                              if (that.userInfoReadyCallback) {
                                that.userInfoReadyCallback(res)
                              }
                              wx.request({
                                url: getApp().AppUrl + 'index.php/liudong/yanke/updateHeadImg',
                                method: 'GET',
                                data: {
                                  token: result.token,
                                  img: app.globalData.userInfo.avatarUrl
                                },
                                success: function (e) {
                                  // console.log("4565645fsdf",e.data)

                                }

                              })
                            }
                          })
                          app.globalData.sign = 2
                          app.globalData.token = result.token
                          app.globalData.openid = result.openid
                          app.globalData.usertype = result.type
                          wx.redirectTo({
                            url: '../homepage/homepage'
                          })
                        } else {
                          wx.showModal({
                            title: '提示',
                            content: "您的账户已冻结，请联系管理员处理！",
                            showCancel: false,
                            success: function (res) {
                              if (res.confirm) {
                                wx.navigateBack({//返回
                                  delta: 1
                                })
                                console.log('用户点击确定')
                              } else {
                                console.log('用户点击取消')
                              }
                            }
                          })
                          return false;
                        }
                      }
                    },
                    fail: function (e) {
                      console.log(e)
                    }

                  })
                } else {
                  console.log('获取用户登录态失败！' + res.errMsg)
                }

              }
            })
          }


        }
      }
    })


  
  },
  onReady: function () {
    // 页面渲染完成
  },
  onShow: function () {
    // 页面显示
  },
  onHide: function () {
    
    // 页面隐藏
  },
  onUnload: function () {
    // 页面关闭
  }
})