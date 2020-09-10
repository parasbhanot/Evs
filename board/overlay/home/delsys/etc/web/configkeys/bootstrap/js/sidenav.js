function navbar() {
   var trigger = 0;
   $("#back_navbar").click(function(e) {
        e.preventDefault();
        $(".wrap_navbar").animate({
          left: -200+"px",
      }, 0, function() {
        $(".wrap_navbar_list_item").css({
            paddingLeft: '0px',
            width: '0px',
            // borderBottom: '2px solid #4b5a72',
        });
        return trigger = 0; 
      });
      $(".wrap_content").animate({
          marginLeft: 50+"px",
      }, 0, function() {
        return trigger = 0; 
      });
    });
  $(".wrap_navbar_burger_btn").on("click", function() {  
//     open nav
    if  (trigger == 0) {
      $(".wrap_navbar").animate({
          left: 0+"px",
      }, 0, function() {
        $(".wrap_navbar_list_item").css({
            paddingLeft: '15px',
            width: '250px',
        });
        return trigger = 1; 
      });
      $(".wrap_content").animate({
          marginLeft: 250+"px",
      }, 0, function() {
        return trigger = 1; 
      });
//       close nav
    } else if(trigger == 1) {
      $(".wrap_navbar").animate({
          left: -200+"px",
      }, 0, function() {
        $(".wrap_navbar_list_item").css({
            paddingLeft: '0px',
            width: '0px',
            // borderBottom: '2px solid #4b5a72',
        });
        return trigger = 0; 
      });
      $(".wrap_content").animate({
          marginLeft: 50+"px",
      }, 0, function() {
        return trigger = 0; 
      });
    }
  });
}