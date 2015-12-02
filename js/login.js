$(function(){
  $('#login').submit(function(e){
    e.preventDefault();
    var formData = $(this).serializeArray();
    $.post('./server/login.php', formData)
    .success(function(d){
      if (d.status == 'SUCCESS') {
        document.location.href = './user.php';
      } else {
        alert(d.msg);
      }
    })
    .fail(function(d){
      console.log(d);
    });

  })
})
