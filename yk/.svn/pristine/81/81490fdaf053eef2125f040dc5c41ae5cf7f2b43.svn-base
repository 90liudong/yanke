// pages/shoping/shoping.js
const app = getApp()
var jisuan = require('../../public/js/jisuan.js')
var sub = require('../../public/js/sub.js')

Page({

  /**
   * 页面的初始数据
   */
  data: {
    edit:false,
    shop:{},
    utype:"",
    direct:false,
    gid:"",
    up_uid:"",
    num:1,
    total:0,
    haveaddr:false,
    name:"",
    tel:"",
    addr:"",
    goods:0,
    over_id:0,
    sw:true
  },
  telinput: function (e) {
    this.setData({
      tel: e.detail.value
    })
  },
  nameinput: function (e) {
    this.setData({
      name: e.detail.value
    })
  },
  addrinput: function (e) {
    this.setData({
      addr: e.detail.value
    })
  },
  toedit:function(){
    this.setData({
      edit:true
    })
  },
  eqedit: function () {
    this.setData({
      edit: false
    })
  },
  sureedit: function () {
    var that = this
    if (that.data.name == "") {
      wx.showModal({
        title: '提示',
        content: "请输入姓名"
      })
      return false
    }
    if (that.data.tel == "") {
      wx.showModal({
        title: '提示',
        content: "请输入手机"
      })
      return false
    }
    if (that.data.addr == "") {
      wx.showModal({
        title: '提示',
        content: "请输入地址"
      })
      return false
    }
    this.setData({
      edit: false,
      name:this.data.name,
      tel: this.data.tel,
      addr: this.data.addr,
      haveaddr:true
    })
  },
  plus:function(){
    var num1 = this.data.num +1
    if(this.data.direct){
      var money = jisuan.add(this.data.total,this.data.shop.retail_price) 
    }else{
      var money = jisuan.add(this.data.total,this.data.shop.coupon_price) 
    }

    this.setData({
      num: num1,
      total:money
    })
  },
  jian: function () {
    if (this.data.num==1){
      return false
    }else{
      var num1 = this.data.num -1
      if (this.data.direct) {
        var money = sub.sub(this.data.total, this.data.shop.retail_price) 
      } else {
        var money = sub.sub(this.data.total, this.data.shop.coupon_price) 
      }
      this.setData({
        num: num1,
        total: money
      })
    }

  },
  pay:function(){ 
    var that = this 
    if(that.data.sw){
      that.setData({
        sw:false
      })

      if (this.data.direct) {
        if (this.data.haveaddr) {



          wx.request({
            url: getApp().AppUrl + 'index.php/liudong/pay/payfee', //你服务器code.php文件地址，默认GET。小程序只支持https ，
            method: 'GET',
            header: {
              'content-type': 'application/x-www-form-urlencoded'
            },
            data: {
              money: that.data.total,
              openid: app.globalData.openid
            },
            success: res => {
              console.log(res.data);
              console.log('调起支付');
              console.log(res.data.timeStamp, res.data.nonceStr, res.data.package, res.data.paySign)
              wx.requestPayment({
                'timeStamp': res.data.timeStamp,
                'nonceStr': res.data.nonceStr,
                'package': res.data.package,
                'signType': 'MD5',
                'paySign': res.data.paySign,

                'success': function (res) {

                  console.log('success');
                  wx.showToast({
                    title: '支付成功',
                    icon: 'success',
                    duration: 3000
                  });
                  wx.request({
                    url: getApp().AppUrl + 'index.php/geng/jiekou/buy',
                    method: 'get',
                    data: {
                      token: app.globalData.token,
                      up_uid: that.data.over_id,
                      name: that.data.name,
                      tel: that.data.tel,
                      addr: that.data.addr,
                      gid: that.data.gid,
                      num: that.data.num,
                      unit_price: that.data.total
                    },
                    success: function (e) {
                      console.log(e)

                      that.setData({
                        sw: true
                      })
                      //跳转到我的订单
                      // var result = e.data
                      wx.redirectTo({
                        url: '../order/order',
                      })
                    }

                  })
                },
                'fail': function (res) {

                  that.setData({
                    sw: true
                  })
                  console.log('fail');
                },
                'complete': function (res) {

                  that.setData({
                    sw: true
                  })
                  console.log('complete');
                }
              });

            },
            fail: function (res) {

              that.setData({
                sw: true
              })
              console.log(res.data)
            }
          })
        }
        else {
          that.setData({
            sw: true
          })
          wx.showToast({
            title: '请填写收货地址！',
            icon: "none",
            duration: 2000
          })
          return false
        }
      } else {
        //判断b1的库存有没有够不够
        //够就下单        // 不够就提示
        if (this.data.haveaddr) {
          wx.request({
            url: getApp().AppUrl + 'index.php/geng/jiekou/isnum',
            method: 'get',
            data: {
              gid: that.data.gid,
              up_uid: that.data.up_uid
            },
            success: function (e) {
              // console.log("hhh666666", e.data)
              console.log("hhh78777777", that.data.num)
              if (e.data < that.data.num) {
                that.setData({
                  sw: true
                })
                wx.showToast({
                  title: '该代理商库存剩余' + e.data + "件.",
                  icon: "none",
                  duration: 2000
                })
                return false
              } else {
                wx.request({
                  url: getApp().AppUrl + 'index.php/liudong/pay/payfee',
                  method: 'GET',
                  header: {
                    'content-type': 'application/x-www-form-urlencoded'
                  },
                  data: {
                    money: that.data.total,
                    openid: app.globalData.openid
                  },
                  success: res => {
                    console.log(res.data);
                    console.log('调起支付');
                    console.log(res.data.timeStamp, res.data.nonceStr, res.data.package, res.data.paySign)
                    wx.requestPayment({
                      'timeStamp': res.data.timeStamp,
                      'nonceStr': res.data.nonceStr,
                      'package': res.data.package,
                      'signType': 'MD5',
                      'paySign': res.data.paySign,

                      'success': function (res) {

                        console.log('success');
                        wx.showToast({
                          title: '支付成功',
                          icon: 'success',
                          duration: 3000
                        });

                        wx.request({
                          url: getApp().AppUrl + 'index.php/geng/jiekou/buy',
                          method: 'post',
                          data: {
                            token: app.globalData.token,
                            up_uid: that.data.up_uid,
                            name: that.data.name,
                            tel: that.data.tel,
                            addr: that.data.addr,
                            gid: that.data.gid,
                            num: that.data.num,
                            unit_price: that.data.shop.coupon_price
                          },
                          success: function (e) {
                            console.log(e)
                            wx.removeStorage({
                              key: 'product',
                              success: function (res) {
                                console.log(res.data)
                                console.log("qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq")

                              }
                            })

                            that.setData({
                              sw: true
                            })
                            //跳转到我的订单
                            // var result = e.data
                            wx.redirectTo({
                              url: '../order/order',
                            })
                          }

                        })
                      },
                      'fail': function (res) {

                        that.setData({
                          sw: true
                        })
                        console.log('fail');
                      },
                      'complete': function (res) {

                        that.setData({
                          sw: true
                        })
                        console.log('complete');
                      }
                    });

                  },
                  fail: function (res) {

                    that.setData({
                      sw: true
                    })
                    console.log(res.data)
                  }
                })
              }
            }
          })
        }
        else {
          that.setData({
            sw: true
          })
          wx.showToast({
            title: '请填写收货地址！',
            icon: "none",
            duration: 2000
          })
          return false
        }


      }

    } 

  
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/isaddr',
      method: 'post',
      data: {
        token:app.globalData.token
      },
      success: function (e) {
        console.log("122454",e.data)
        if(!e.data.status){
          that.setData({
            haveaddr: false
          })
        }else{
          that.setData({
            name: e.data.content.name,
            tel: e.data.content.tel,
            addr: e.data.content.addr,
            haveaddr:true
          })
        }

      }

    })
    console.log(options)
    //判断缓存有没有id
    var over_id = 0;

    try {
      var value = wx.getStorageSync('over_id')
      if (value) {
        console.log("hhhhhh",value);
        over_id  = value
        wx.request({
          url: getApp().AppUrl + 'index.php/geng/jiekou/isnum',
          method: 'get',
          data: {
            gid: options.gid,
            up_uid:over_id
          },
          success: function (e) {
            console.log("库存", e.data)
            that.setData({
              goods:e.data,
              over_id:over_id
            })

            //有缓存id的执行
              if (options.flag == "direct") {
                var gid = options.gid
                console.log(gid)
                that.setData({
                  direct:true,
                  gid:gid
                })

                wx.request({
                  url: getApp().AppUrl + 'index.php/geng/jiekou/cjdetail',
                  method: "post",
                  data: {
                    gid: "" + gid,
                  },
                  success: function (res) {
                    console.log(res.data)
                    var img = res.data[0].image.replace('\\', '/')
                    res.data[0].image = getApp().AppUrl + "static/uploads/product_pic/" + img
                      console.log("aaaaaaa",that.data.goods)
                      if (that.data.goods) {
                       var price = res.data[0].coupon_price
                      }else{
                       var price =  res.data[0].retail_price
                      }

                    that.setData({
                      shop: res.data[0],
                      utype: app.globalData.usertype,
                      total: price
                    })
                  }
                })
              }else{
                var gid = options.gid
                var uid = options.uid
                var up_uid = options.up_uid
                that.setData({
                  direct:false,
                  gid: gid,
                  up_uid:up_uid
                })
                wx.request({
                  url: getApp().AppUrl + 'index.php/geng/jiekou/detail',
                  method: "post",
                  data: {
                    uid: "" + uid,
                    gid: "" + gid
                  },
                  success: function (res) {
                    console.log(res.data)
                    var img = res.data[0].image.replace('\\', '/')
                    res.data[0].image = getApp().AppUrl + "static/uploads/product_pic/" + img
                    that.setData({
                      shop: res.data[0],
                      utype: app.globalData.usertype,
                      total: res.data[0].coupon_price
                    })
                  }
                })
              }


          }
        })
      }else{
        if (options.flag == "direct") {
          var gid = options.gid
          console.log(gid)
          that.setData({
            direct:true,
            gid:gid
          })

          wx.request({
            url: getApp().AppUrl + 'index.php/geng/jiekou/cjdetail',
            method: "post",
            data: {
              gid: "" + gid,
            },
            success: function (res) {
              console.log(res.data)
              var img = res.data[0].image.replace('\\', '/')
              res.data[0].image = getApp().AppUrl + "static/uploads/product_pic/" + img
                console.log("aaaaaaa",that.data.goods)
                if (that.data.goods) {
                 var price = res.data[0].coupon_price
                }else{
                 var price =  res.data[0].retail_price
                }
              that.setData({
                shop: res.data[0],
                utype: app.globalData.usertype,
                total: price
              })
            }
          })
        }else{
          var gid = options.gid
          var uid = options.uid
          var up_uid = options.up_uid
          that.setData({
            direct:false,
            gid: gid,
            up_uid:up_uid
          })
          wx.request({
            url: getApp().AppUrl + 'index.php/geng/jiekou/detail',
            method: "post",
            data: {
              uid: "" + uid,
              gid: "" + gid
            },
            success: function (res) {
              console.log(res.data)
              var img = res.data[0].image.replace('\\', '/')
              res.data[0].image = getApp().AppUrl + "static/uploads/product_pic/" + img
              that.setData({
                shop: res.data[0],
                utype: app.globalData.usertype,
                total: res.data[0].coupon_price
              })
            }
          })
        }
      }
    } catch (e) {
      // Do something when catch error
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