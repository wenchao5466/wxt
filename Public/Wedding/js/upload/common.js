document.write('<link type="text/css" rel="stylesheet" href="../common/css/demo.css"/>');
document.write('<script type="text/javascript" src="../common/js/clipboard.v1.js"></script>');

var task = {
    "demo": function(){
          var clip = new ZeroClipboard($('.link-but'),{
              moviePath:"../common/js/clipboard.swf",
              targetEle : function(el){
                  return $(el).next('pre').find('textarea')[0]
              },
          });
          clip.addEventListener( "complete", function(){      
              alert('复制成功！')
          }); 
    }
  }

  $(function(){
    for (var k in task) {
      var v = task[k];
      if (typeof v == 'function') {
        v();
      }
    }
  })
