!function($,a,t){$(function(){"use strict";var a=$(window),t=a.width();$(".wrapper > .inner").waypoint(function(){$(".header nav").toggleClass("stuck")},{offset:"115"}),$("#nav-toggle").on("click",function(a){a.preventDefault(),$(this).toggleClass("active"),$(".header nav ul").slideToggle()});var e=$("#tabs nav a"),n=$(".tabsCol .tabWrap");e.length>0&&(e.first().addClass("active"),n.each(function(){var a=$(this);a.find("h3").length>1&&a.addClass("accordions")}));var i=function(a,t){e.removeClass("active"),a.addClass("active"),n.hide(),n.eq(t).show()};$("#tabs nav").on("click","a",function(a){a.preventDefault();var t=$(this),e=t.index();i(t,e)})})}(jQuery,this);