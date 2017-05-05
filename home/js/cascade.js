$(function(){
/******************ajax+php实现级联下拉******************/
  // $('#s1').empty();
  // $('#s1').append(new Option('== 请选择校区 ==',''));
  var compus,area,building,roomnum,tel,cornet;
  $.ajax({
      type:"post",
      url:"../control/s1.php",
      success:function(msg){
          var json= eval('('+msg+')');
          for(var i=0;i<json.length;i++){
              $('#s1').append(new Option(json[i].value,json[i].key));
          }
      }
  });
  $.ajax({
    type:"post",
    url:"../control/showInfo.php",
    success:function(msg){            //获取当前用户信息
      var json= eval('('+msg+')');
      compus = json.compus;
      area = json.area;
      building = json.building;
      roomnum = json.room;
      tel = json.tel;
      cornet = json.cornet;
      if (cornet) {
        contact = tel +'\/'+cornet;
      } else {
        contact = tel;
      }
      
      $('#roomnum').val(roomnum);
      $('#tel').val(contact);

      $("#s1 option").each(function(i,n){
        if($(n).text()==compus){
          $(n).attr("selected",true);
        } 
      });
      s2($('#s1').val());
    }
  });
  function s2(val) {
    $('#s2').empty();
    $('#s2').append(new Option('== 请选择区域 ==',''));
    if (val!=null) {
      $.ajax({
        type:"post",
        url:"../control/s2.php",
        data:'i='+$('#s1').val(),
        success:function(msg){
            var json= eval('('+msg+')');
            for(var i=0;i<json.length;i++){
                $('#s2').append(new Option(json[i].value,json[i].key)); 
            }
            $("#s2 option").each(function(i,n){
              if($(n).text()==area){
                $(n).attr("selected",true);
              } 
            });
            s3($("#s2").val());
        }
      });
    }
  }
  function s3 (val) {
    $('#s3').empty();
    $('#s3').append(new Option('== 请选择楼栋 ==',''));
    if (val!= null) {
        $.ajax({
        type:"post",
        url:"../control/s3.php",
        data:'i='+$('#s2').val(),
        success:function(msg){
          var json= eval('('+msg+')');
          for(var i=0;i<json.length;i++){
             $('#s3').append('<option>'+json[i].value+'</option>');
          }
          $("#s3 option").each(function(i,n){
            if($(n).text()==building){
              $(n).attr("selected",true);
            }
          });
        }
      });
    }    
  }

  $('#s1').change(function(){
     $('#s2').empty();
     $('#s2').append(new Option('== 请选择 ==',''));
     $.ajax({
      type:"post",
      url:"../control/s2.php",
      data:'i='+$('#s1').val(),
      success:function(msg){
          var json= eval('('+msg+')');
          for(var i=0;i<json.length;i++){
              $('#s2').append(new Option(json[i].value,json[i].key));
          }
      }
    });
  });
  $('#s2').change(function(){
    $('#s3').empty();
    $('#s3').append(new Option('== 请选择 ==',''));
    $.ajax({
      type:"post",
      url:"../control/s3.php",
      data:'i='+$('#s2').val(),
      success:function(msg){
        var json= eval('('+msg+')');
        for(var i=0;i<json.length;i++){
          $('#s3').append('<option>'+json[i].value+'</option>');
        }
      }
    });
  });
});