// pages/user/user.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   * B1显示当前
   * B显示所有
   */
  data: {
    edit:false,
    b1:"",
    line: true,
    B1:[],
    B: {},
    tel:"",
    discount:"",
    show:false
  },
  disInput: function (e) {
    this.setData({
      discount: e.detail.value
    })
  },
  getB1: function(){
    console.log(this.data.B)
    this.setData({
      line: true,
      B1: this.data.B.two
    })
  },
  getB1_2: function() {
    this.setData({
      line: false,
      B1:this.data.B.three
    })
  },
  toedit: function (e) {
    var count = e.currentTarget.dataset["count"]
    var tel = e.currentTarget.dataset["tel"]
    this.setData({
      edit: true,
      discount:count,
      tel:tel
    })
  },
  eqedit: function () {
    this.setData({
      edit: false
    })
  },
  //将折扣传上去
  sureedit: function () {
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/discount',
      method: 'post',
      data: {
        tel:this.data.tel,
        discount: this.data.discount
      },
      success: function (e) {
        var result = e.data
        console.log(result)
        wx.request({
          url: getApp().AppUrl + 'index.php/geng/jiekou/manage',
          method: 'GET',
          data: {
            token: app.globalData.token,
            type: app.globalData.usertype
          },
          success: function (e) {
            var result = e.data
            console.log(result)
            var length = 0;
            for (var j in result) {
              length++;
            }
            console.log(length)
            if(that.data.line){
              if (length == 2) {
                that.setData({
                  b1: true,
                  B: result,
                  B1: result.two
                })
              } else if (length == 1) {
                that.setData({
                  b1: false,
                  B: result,
                  B1: result
                })
              }
            }else{
              console.log(123456)
              that.setData({
                b1: true,
                B: result,
                B1: result.three
              })
            }
          }

        })
      }

    })
    this.setData({
      edit: false
    })
  },
  
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this
    wx.request({
      url: getApp().AppUrl + 'index.php/geng/jiekou/manage',
      method: 'GET',
      data: {
        token: app.globalData.token,
        type: app.globalData.usertype
      },
      success: function (e) {
        var result = e.data
        console.log(result)
        var length = 0;
        for (var j in result) {
          length++;
        }
        console.log(length)
        if (result.hasOwnProperty("two")) {  
          if(length == 2){
            that.setData({
              b1: true,
              B: result,
              B1:result.two , 
            })
          }else if (length == 1){
            that.setData({
              b1: false,
              B: result,
              B1: result
            })
          }else{
            if(app.globalData.usertype==1){
              that.setData({
                b1: true
              })
            }else{
              that.setData({
                b1: false
              })
            }
          }
        }else{
          that.setData({
            b1: false,
            B: result,
            B1: result
          })
        }
        //开启显示
        that.setData({
          show:true
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