const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    imgUrls: [],
    shop:[],
    utype:"1",
    indicatorDots: true,
    autoplay: true,
    interval: 5000,
    duration: 1000,
    toView: 'red',
    scrollTop: 100,
    token:"",
    sw:true
  },
  toself: function () {
    wx.redirectTo({
      url: '../self/self'
    })
  },
 todetail:function(e){
   if(this.data.sw){
    this.setData({
      sw:false
    })
    if (app.globalData.usertype !=5){
      //如果是 其他用户传改用户最上级B1的id 和商品id
      //  console.log(e.currentTarget.dataset["id"])
      var uid = e.currentTarget.dataset["uid"]
      var gid = e.currentTarget.dataset["gid"]
      var flag = false
      console.log(uid)

      wx.navigateTo({
        url: '../shop/shop?uid=' + uid + '&gid=' + gid + '&flag=' + flag
      })
    }else{
      //如果是c1用户 直接传一个商品id
      var uid = 0
      var gid = e.currentTarget.dataset["gid"]
      var flag = false
      console.log(uid)

      wx.navigateTo({
        url: '../shop/shop?uid=' + uid + '&gid=' + gid + '&flag=' + flag
      })
    }

  }
 },
  //置顶按钮
 onPageScroll: function (e) { // 获取滚动条当前位置
  //  console.log(e)
 },
 goTop: function (e) {  // 一键回到顶部
   if (wx.pageScrollTo) {
     wx.pageScrollTo({
       scrollTop: 0
     })
   } else {
     wx.showModal({
       title: '提示',
       content: '当前微信版本过低，无法使用该功能，请升级到最新微信版本后重试。'
     })
   }
 },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/lunbo',
      method: 'GET',
      success: function (e) {
        // console.log(e)
        var result = e.data
        for (var i = 0; i < result.length; i++) {
          var img = result[i].replace('\\', '/')
          result[i] = getApp().AppUrl + "static/uploads/slider_pic/" + img
        }
        that.setData({
          imgUrls: result
        })
      }

    })

    // console.log(app.globalData.token) 
  //如果是c1用户 直接拿厂家产品 
  //如果是 其他用户拿改用户最上级B1的商品

      wx.request({
        url: getApp().AppUrl + 'index.php/geng/jiekou/pro',
        method: 'post',
        data:{
          token:app.globalData.token
        },
        success: function (e){
          var result = e.data
          console.log(result) 
          for (var i = 0; i < result.length; i++) {
            var img = result[i].image.replace('\\', '/')
            result[i].image = getApp().AppUrl + "static/uploads/product_pic/" + img
          }
          that.setData({
            shop: result,
            utype: app.globalData.usertype
          })
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