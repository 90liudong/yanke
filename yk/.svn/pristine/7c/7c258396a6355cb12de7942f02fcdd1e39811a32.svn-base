// pages/shop/shop.js
var WxParse = require('../../wxParse/wxParse.js');
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    one:true,
    two:true,
    shop:{},
    utype:"",
    b1uid:"",
    sid:"",
    up_uid:"",
    article:""
  },
  tohome: function () {
    wx.redirectTo({
      url: '../homepage/homepage'
    })
  },
  toshoping:function(){
    console.log(this.data.up_uid)
    if (this.data.up_uid){
      var id = this.data.sid
      var uid = this.data.b1uid
      var gid = id
      var up_uid = this.data.up_uid
      var flag = "notdirect"
      wx.navigateTo({
        url: '../shoping/shoping?uid=' + uid + '&gid=' + id + '&up_uid=' + up_uid +  '&flag=' + flag,
      })
    }else{
      var id = this.data.sid
      var uid = 0
      var gid = id
      var flag = "direct"
      wx.navigateTo({
        url:'../shoping/shoping?uid=' + uid + '&gid=' + id + '&flag=' + flag ,
      })
    }

  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

    var that = this;
    console.log(6666555, options)
    wx.showShareMenu({
      withShareTicket: true,
    })
    //flag true 是分享进来的判断页 sharetrue 分享进来的商品页 false 普通首页进来的
    if (options.flag=="true"){
      console.log(789789,options)
      console.log("aaaaaaaa", options.uid)
      wx.redirectTo({
        url: '../load/load?buserid =' + '1232' + "&gid=" + options.gid + "&up_uid=" + options.up_uid + "&flag=" + options.uid + '&user_id =' +1,
      })
    } else if (options.flag == "sharetrue"){
      wx.getStorage({
        key: 'product',
        success: function (res) {
          console.log("99999888", res.data)
          var op = res.data
          console.log("11111", op)
          var b1uid = op.flag
          console.log("111115555", op.b1userid)
          console.log("1111666", op.user_id)
          console.log("1111777", op.flag) 
          console.log("123232", op.gid)
          var gid = op.gid
          var up_uid = op.up_uid
          that.setData({
            b1uid: b1uid,
            sid: gid,
            up_uid: up_uid,
            utype: app.globalData.usertype
          })
          console.log(that.data.b1uid, that.data.sid, that.data.up_uid)
          wx.request({
            url: getApp().AppUrl + 'index.php/geng/jiekou/detail',
            method: "post",
            data: {
              uid: "" + b1uid,
              gid: "" + gid,
            },
            success: function (res) {
              console.log(res.data)
              var img = res.data[0].image.replace('\\', '/')
              res.data[0].image = getApp().AppUrl + "static/uploads/product_pic/" + img
              that.setData({
                shop: res.data[0],
                utype: app.globalData.usertype
              })
              that.setData({
                article: that.data.shop.detail
              })  
             
               WxParse.wxParse('article', 'html', that.data.article, that, 5);
              // console.log(temp)
              // that.setData({
              //   article: temp
              // })
              wx.removeStorage({
                key: 'product',
                success: function (res) {
                  console.log(res.data)
                  console.log("aaaaaaaaaaaa")

                }
              })
            }
          })
        }
      })
     
    }else{   
      //如果是c1用户 直接拿厂家产品 
      if (app.globalData.usertype == 5) {
        var uid = options.uid // b1 的 uid
        var gid = options.gid
        that.setData({
          sid: gid
        })
        console.log(that.data.up_uid)
        wx.request({
          url: getApp().AppUrl + 'index.php/geng/jiekou/cjdetail',
          method: "get",
          data: {
            gid: "" + gid,
          },
          success: function (res) {
            console.log(res.data)
            var img = res.data[0].image.replace('\\', '/')
            res.data[0].image = getApp().AppUrl + "static/uploads/product_pic/" + img
            that.setData({
              shop: res.data[0],
              utype: app.globalData.usertype
            })
            that.setData({
              article: that.data.shop.detail
            })   
             WxParse.wxParse('article', 'html', that.data.article, that, 5);
            // that.setData({
            //   article: temp
            // })
          }
        })

      } else {
        //如果是 其他用户拿改用户最上级B1的商品
        wx.request({
          //拿到当前分享出去的人的uid 赋值给 up_uid
          url: getApp().AppUrl + 'index.php/liudong/yanke/getUid',
          method: "post",
          data: {
            token: app.globalData.token
          },
          success: function (res) { 
            // var up_id = ""+ res.data
            console.log(res.data)
            that.setData({
              up_uid: res.data
            })
            console.log(that.data.up_uid)
            var uid = options.uid // b1 的 uid
            var gid = options.gid
            that.setData({
              b1uid: uid,
              sid: gid
            })
            //拿到该商品的信息
              wx.request({
                url: getApp().AppUrl + 'index.php/geng/jiekou/detail',
                method: "get",
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
                    article: res.data[0].detail
                  })
                  that.data.shop = res.data[0]
                  that.data.utype = app.globalData.usertype
                  that.data.article = res.data[0].detail
                  console.log(2, that.data) 
                 WxParse.wxParse('article', 'html', that.data.article, that, 5);
                  // that.setData({
                  //   article: temp
                  // }) 
                }
              })

            }

          
        })
      }
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
  onShow: function (e) {
    //复原开关

    var pages = getCurrentPages();
    var Page = pages[pages.length - 1];//当前页
    var prevPage = pages[pages.length - 2];  //上一个页面
    var info = prevPage.data
    setTimeout(function () {
      prevPage.setData({
        sw: true
      })
    }, 1000)

    // console.log(info)
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
    // var self = this;
    // // console.log(123456)
    // // wx.showLoading({
    // //   title: '加载中',
    // // })
    // // setTimeout(function () {
    // //   wx.hideLoading()
    // // }, 2000)
    //   setTimeout(function () {
    //     self.setData({
    //       two: true
    //     })
    // }, 500)
  },
  onPageScroll: function (e) { // 获取滚动条当前位置
    if(this.two){
      console.log(e)
    }
  },
  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function (res) {        
    var flag = true
        return {
          title: '眼科之家',
          path: '/pages/shop/shop?uid=' + this.data.b1uid + "&gid=" + this.data.sid + "&up_uid=" + this.data.up_uid + "&flag=" + flag,
          success: function (res1) {
            // 转发成功
            var shareTickets = res1.shareTickets
            if (shareTickets.length == 0){
                return false
            }
            console.log("转发成功")            
            wx.getShareInfo({
              shareTicket: shareTickets[0],
              success:function(e){
                var encryptedData = e.encryptedData
                console.log(encryptedData)
              }
            })
          },
          fail: function (res) {
            // 转发失败
            console.log("转发失败")
          }
        }

  }
})