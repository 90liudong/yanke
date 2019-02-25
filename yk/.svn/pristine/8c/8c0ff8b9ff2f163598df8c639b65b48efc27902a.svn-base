// pages/once/once.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   * check[]空的时候显示没有复选框
   * check 显示的当前列表
   * 不空的时候显示复选框
   * status 
   */
  data: {
     check:[],
     all: "../../public/img/check1.png",
     edit:0,
     status:1
    
  },
  check: function (e) {
    var that = this
    console.log(e.currentTarget.dataset.id);
    var id = e.currentTarget.dataset.id
    var ssrc = that.data.check[id].src
    // console.log(ssrc);
    if (ssrc == "../../public/img/check1.png"){
      that.data.check[id].src = "../../public/img/check2.png"   
      that.data.check[id].does = true      
    }else{
      that.data.check[id].src = "../../public/img/check1.png"
      that.data.check[id].does = false
      
    }
    that.setData({
      check: that.data.check
    })
    // console.log(that.data.check[id].does)
  },
  checkAll: function (e) {
    var that = this
    if (that.data.all == "../../public/img/check1.png") {
      that.data.all = "../../public/img/check2.png"
    } else {
      that.data.all = "../../public/img/check1.png"
    }
    var length = that.data.check.length
    // console.log(length)
    for (var i = 0; i < length; i++) {
      that.data.check[i].does = true
      that.data.check[i].src = that.data.all  
    }
    that.setData({
      check: that.data.check,
      all: that.data.all
    })
  },
  //编辑
  toEdit:function(){
    var that = this
    var length = that.data.check.length
    // console.log(length)
    for(var i=0;i<length;i++){
      that.data.check[i].edit = true
    }
    that.setData({
      check: that.data.check,
      edit:1
    })
  },
  //将没有设置成个别商品的渲染出来，添加
  toAdd: function () {

    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/prodiscount',
      method: 'post',
      data: {
        token: app.globalData.token
      },
      success: function (e) {
        console.log(e)
        var result = e.data
        for (var i = 0; i < result.length; i++) {
          var img = result[i].image.replace('\\', '/')
          result[i].image = getApp().AppUrl + "static/uploads/product_pic/" + img
          result[i].src = "../../public/img/check1.png"
          result[i].does = false
          result[i].edit = false

        }
        console.log(result)
        that.setData({
          check: result
        })

        var length = that.data.check.length
        for (var i = 0; i < length; i++) {
          that.data.check[i].edit = true
        }
        that.setData({
          check: that.data.check,
          status:1,
          edit: 2
        })
      }
    })
  },
  //取消
  eq: function () {
    var that = this
    var length = that.data.check.length
    // console.log(length)
    for (var i = 0; i < length; i++) {
      that.data.check[i].edit = false
    }
    that.setData({
      check: that.data.check,
      edit: 0
    })

  },
  //移除个别商品
  del:function(){
    var gid = []
    var index = []
    var c = this.data.check

    for(var i=0; i<c.length; i++ ){
        if(c[i].does){
          gid.push(c[i].gid)
          index.push(i)
        }
    }
    console.log(gid.length)
    if (gid.length == 0) {
      wx.showToast({
        title: '请至少选择一项！',
        icon: 'success',
        duration: 1500
      })
      return false;
    }
    var arr = { "token": app.globalData.token,"gid":gid}
    console.log(arr)
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/delect',
      method: 'GET',
      data: {
        data: arr
      },
      success: function (e) {
        wx.request({
          url: getApp().AppUrl + 'index.php/geng/jiekou/proshow',
          method: 'post',
          data: {
            token: app.globalData.token
          },
          success: function (e) {
            console.log(e)
            var result = e.data
            if (result.length) {
              for (var i = 0; i < result.length; i++) {
                var img = result[i].image.replace('\\', '/')
                result[i].image = getApp().AppUrl + "static/uploads/product_pic/" + img
                result[i].src = "../../public/img/check1.png"
                result[i].does = false
                result[i].edit = false

              }
              console.log(result)
              that.setData({
                check: result,
                edit: 0,
                all: "../../public/img/check1.png"                
              })

            } else {
              that.setData({
                status: 2,
                edit: 0,
                all: "../../public/img/check1.png"
              })
            }
          }

        })
        
      }

    })
  },
  //添加个别商品
  add: function () {
    var gid = []
    var c = this.data.check
    for (var i = 0; i < c.length; i++) {
      if (c[i].does) {
        gid.push(c[i].gid)
      }
    }
    var arr = { "token": app.globalData.token, "gid": gid }
    console.log(arr)
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/add',
      method: 'GET',
      data: {
        data: arr
      },
      success: function (e) {
        wx.request({
          url: getApp().AppUrl + 'index.php/geng/jiekou/proshow',
          method: 'post',
          data: {
            token: app.globalData.token
          },
          success: function (e) {
            console.log(e)
            var result = e.data
            if (result.length) {
              for (var i = 0; i < result.length; i++) {
                var img = result[i].image.replace('\\', '/')
                result[i].image = getApp().AppUrl + "static/uploads/product_pic/" + img
                result[i].src = "../../public/img/check1.png"
                result[i].does = false
                result[i].edit = false

              }
              console.log(result)
              that.setData({
                check: result,
                edit:0,
                all: "../../public/img/check1.png"                
              })

            } else {
              that.setData({
                status: 2,
                edit: 0,
                all: "../../public/img/check1.png"                
              })
            }
          }

        })
      }

    })
  },
  /**
   * 生命周期函数--监听页面加载
   * 渲染已有的个别商品并构造数组
   */
  onLoad: function (options) {
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/proshow',
      method: 'post',
      data: {
        token: app.globalData.token
      },
      success: function (e) {
        console.log(e)
        var result = e.data
        if (result.length){
          for (var i = 0; i < result.length; i++) {
            var img = result[i].image.replace('\\', '/')
            result[i].image = getApp().AppUrl + "static/uploads/product_pic/" + img
            result[i].src = "../../public/img/check1.png"
            result[i].does = false
            result[i].edit = false
            
          }
          console.log(result)
          that.setData({
            check: result
          })

        }else{
          that.setData({
            status:2
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