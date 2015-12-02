$(function(){
  $('#newUser').submit(function(e){
    e.preventDefault();
    var formData = $(this).serializeArray();
    $.post('./server/new_user.php', formData)
    .success(function(d){
      alert(d.msg);
      if (d.status == 'SUCCESS') {
        document.location.href = './login.php';
      }
    })
    .fail(function(d){
      console.log(d);
    });

  })
})
