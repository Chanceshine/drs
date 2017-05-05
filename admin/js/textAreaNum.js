/**
 * [文本域统计字数]
 * @param  {[type]} textArea [文本域节点]
 * @param  {[type]} numItem  [剩余字数显示]
 * @return {[type]}          [description]
 */
// $(function () {
  function statInputNum(textArea,numItem) {
    var max = numItem.text(),
            curLength;
    textArea[0].setAttribute("maxlength", max);
    curLength = textArea.val().length;
    numItem.text(max - curLength);
    textArea.on('input propertychange', function () {
        var _value = $(this).val().replace(/\n/gi,"");
        numItem.text(max - _value.length);
    });
  }

// });
