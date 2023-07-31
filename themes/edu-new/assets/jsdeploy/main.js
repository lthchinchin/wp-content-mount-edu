!function(c){"use strict";function n(t,e){c(".vote-notifi").attr("class","vote-notifi vote-notifi--"+t),c(".vote-notifi #noti-content").html(e),c(".vote-notification-wrapper").addClass("show"),c(".vote-notification-wrapper").css("z-index",99999999),setTimeout(()=>{c(".vote-notification-wrapper").removeClass("show"),c(".vote-notification-wrapper").removeClass("show"),c(".vote-notification-wrapper").css("z-index",-1)},4e3)}var t;function o(){var t=Math.floor(501*Math.random())+1e3;setTimeout(function(){c("*:not(.keep-skeleton)").removeClass("skeleton")},t)}c(document).ready(function(){if(!MYSCRIPT.DEV_MODE){window.console||(window.console={});for(var t=["log","debug","warn","info"],e=0;e<t.length;e++)console[t[e]]=function(){}}o(),AOS.init({once:!1}),c(window).scroll(function(){50<=window.pageYOffset?c(".single .vote-panigation-wrapper ").addClass("show"):c(".single .vote-panigation-wrapper ").removeClass("show")}),c(".navbar-open").on("click",function(){c(this).parents("header").toggleClass("active"),c("body").toggleClass("hidden")}),c("body").on("click",".add-favorite",function(){console.log("infooo",c(this).data("info"));var t=c(this).data("info");console.log("candidateInfo111",t);const e=t.id;var a=myFavItems.find(t=>t.id===e);myFavItems.length<10&&!a?(myFavItems.push(t),localStorage.setItem("myFavCandidates",JSON.stringify(myFavItems)),n("success",`Bạn đã thêm ${t.name} vào danh sách bình chọn. <a href="${MYSCRIPT.home_url}/binh-chon-cua-ban">bình chọn của bạn.`),console.log("$(this).closest('main.candidate')",c(this).closest("main.candidate")),!!c(this).closest("main.candidate").length?((a=c("main.candidate .candidate__content__info .btn")).toggleClass("add-favorite remove-favorite"),a.toggleClass("sub-bg sub-lighter-bg"),a.text("Xoá khỏi danh sách")):((a=c(this)).toggleClass("remove-favorite add-favorite"),a.toggleClass("danger-bg sub-bg"),a.html(`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18 12H6" stroke="#9A140C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>`))):10<=myFavItems.length?n("primary",`Bạn chỉ được thêm 10 ứng viên vào danh sách bình chọn! Danh sách <a href="${MYSCRIPT.home_url}/binh-chon-cua-ban">bình chọn của bạn.</a>`):n("primary",`Ứng viên ${t.name} đã có trong danh sách. Danh sách <a href="${MYSCRIPT.home_url}/binh-chon-cua-ban">bình chọn của bạn.</a>`)}),c("body").on("click",".remove-favorite",function(t){t.preventDefault();const a=c(this);console.log("clickeddd11111d"),showConfirmation("success","Bỏ ứng viên này ra khỏi danh sách!.",function(){console.log("clickedddd");var t=a.data("info");console.log("remove get candidateInfo",t);const e=t.id;myFavItems.find(t=>t.id===e)&&(myFavItems=myFavItems.filter(t=>t.id!=e),localStorage.setItem("myFavCandidates",JSON.stringify(myFavItems)),showCandidatePickedList(myFavItems),n("danger",`Bạn đã xoá ${t.name} ra khỏi danh sách bình chọn.`),t=!!a.closest("main.candidate").length,console.log("isSingle",t),t?(console.log("1"),(t=c("main.candidate .remove-favorite")).toggleClass("remove-favorite add-favorite"),t.toggleClass("sub-lighter-bg sub-bg"),t.text("Thêm vào danh sách")):(console.log("2"),(t=a).toggleClass("remove-favorite add-favorite"),t.toggleClass("danger-bg sub-bg"),t.html(`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.0002 6V18" stroke="#2B4873" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18 12H6" stroke="#2B4873" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>`)),o())},function(){})}),c(".btn-noti-close").click(function(){c(this).closest(".vote-notification-wrapper").removeClass("show")}),c(".swiper-container").length&&c(".swiper-container").each(function(){var t={pagination:{el:"."+c(this).data("pagination-class"),clickable:!0},navigation:{nextEl:"."+c(this).data("next-class"),prevEl:"."+c(this).data("prev-class")},grid:{fill:"row",rows:c(this).data("grid-row")?c(this).data("grid-row"):0},centeredSlides:!!c(this).data("center")&&c(this).data("center"),watchSlidesVisibility:!0,loop:!c(this).data("loop")||c(this).data("loop"),slidesPerView:3,paginationClickable:!0,spaceBetween:0,speed:500,autoplay:!!c(this).data("autoplay")&&{delay:2500},breakpoints:{0:{slidesPerView:c(this).data("mobile")?c(this).data("mobile"):1,spaceBetween:c(this).data("mr")?c(this).data("mr"):12},480:{slidesPerView:c(this).data("mobile")?c(this).data("mobile"):2,spaceBetween:c(this).data("mbmr")?c(this).data("mbmr"):16},768:{slidesPerView:c(this).data("tablet")?c(this).data("tablet"):3,spaceBetween:c(this).data("tbmr")?c(this).data("tbmr"):24},1200:{slidesPerView:c(this).data("desktop")?c(this).data("desktop"):4,spaceBetween:c(this).data("dtmr")?c(this).data("dtmr"):24}}};new Swiper("."+c(this).data("swiper-class"),t)}),new Swiper(".mySwiper",{slidesPerView:3,grid:{rows:2},spaceBetween:30,pagination:{el:".swiper-pagination",clickable:!0}});var a=c(".scroll-fixed");if(null!=a)for(var i=0;i<a.length;i++)new hcSticky(a[i],{stickTo:a[i].parentNode,top:100,bottomEnd:30});c("a.popup-video").fancybox()}),window.addEventListener("resize",function(t){window.innerWidth}),window.showCandidatePickedList=function(t){let e="";t.forEach(t=>{e+=`
          <div class="vars-candidate-item vars-candidate-item--horizontal vars-candidate-item--vote-list ">
          <div class="vars-candidate-item__top skeleton">
              <div class="thumbnail-wrap">
                  <a href="${t.permalink}">
                      <img src="${t.thumbnail}" alt="${t.name}">
                  </a>
              </div>
          </div>
          <div class="vars-candidate-item__bottom">
              <div class="title-wrap">
                  <a href="${t.permalink}">
                      <h4 class="line-1" title="${t.name}">${t.name}</h4>
                  </a>
              </div>
              <div class="career-wrap">
                  <div class="item">
                      <span class="label">Công ty:</span> 
                      <span class="line-1 ms-1" title="">${t.company||""}</span>
                  </div>
              </div>
              <div class="statistical-wrap">
                  <div class="item">
                      STT: 
                      <span>#${t.id}</span>
                  </div>
                  <div class="item">
                      Số lượt bình chọn: 
                      <span>${t.votes}</span>
                  </div>
              </div>
          </div>
          <div class="vars-candidate-item__action">
              <a data-info='${JSON.stringify(t)}' class="remove-favorite" href="">
                  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M19.194 12.7932L12.8047 19.1825" stroke="#2B4873" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M19.1959 19.1863L12.8013 12.7903" stroke="#2B4873" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.9999 28C22.6265 28 27.9999 22.6279 27.9999 16C27.9999 9.37341 22.6265 4 15.9999 4C9.37328 4 3.99988 9.37341 3.99988 16C3.99988 22.6279 9.37328 28 15.9999 28Z" stroke="#2B4873" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
              </a>
          </div>
      </div>
    `}),c("#candidate-picked-list").html(e),c("#length-list").text(t.length),1<=t.length&&t.length<=10?c(".submit-favorite .prev-next-post__right button").removeClass("disable"):c(".submit-favorite .prev-next-post__right button").addClass("disable")},window.setButtonToggleStatus=function(){c(".vars-candidate-item .add-favorite").each(function(t){const e=c(this).data("id");var a;myFavItems.find(t=>t.id===e)&&((a=c(this)).toggleClass("add-favorite remove-favorite"),a.toggleClass("sub-bg danger-bg"),a.html(`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18 12H6" stroke="#9A140C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`))})},window.myFavItems=[],"undefined"!=typeof Storage?(t=localStorage.getItem("myFavCandidates"),myFavItems=t?JSON.parse(t):[],showCandidatePickedList(myFavItems),setButtonToggleStatus()):console.log("Trình duyệt của bạn không hỗ trợ local storage"),window.showConfirmation=function(t,e,a=function(){},i=function(){}){var n="",o="",s=c(".custom-confirm"),d=s.find(".message"),l=s.find(".confirm-button"),r=s.find(".cancel-button");l.show(),"success"===t?(n=e,o="Xác nhận"):"alert"===t&&(n=e,r.text("Đóng"),l.hide()),d.text(n),l.text(o),s.addClass("show"),l.on("click",function(){s.removeClass("show"),r.off("click"),l.off("click"),a()}),r.on("click",function(){s.removeClass("show"),r.off("click"),l.off("click"),i()})}}(jQuery);