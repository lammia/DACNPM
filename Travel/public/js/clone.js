// $(function(){
//     $('.add').click(function() {
//         $(this).closest('p').clone(true).appendTo('div.place-event');
//     });
// });

// $(function(){
//     $('.copy').click(function() {
//         $(this).closest('p').clone(true).appendTo('div.aaa');
//     });
// });

$(function(){
    $('.add').click(function() {
        $('.place-event').append(function() {
    		return '<label class="control-label col-sm-2">Place:</label>' + 
          '<select name="place" class="input-large form-control select" id="selectPlace">' + 
  
              '<opation id="option" value=""></option>' + 
              
          '</select>';
		});
    });
});
