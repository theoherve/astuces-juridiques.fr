<?php include('includes/head.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>test2</title>
	</head>
	<body>
    <h3>test 2</h3>

    <div id="test" contenteditable="true" autocomplete="off" autocorrect="off" autocapiatlise="off" spellcheck="false" style="padding: 5px 5px; border: 1px solid black;">This is a test <span style="color: blue">and this is blue</span> and this is back to black</div>

    <br />
    <button id="btn" type="button">Set cursor position to 25 chars in</button>

	</body>
  <script type="text/javascript">
  function createRange(node, chars, range) {
    console.log(chars);
if (!range) {
  range = document.createRange()
  range.selectNode(node);
  range.setStart(node, 0);
}

if (chars.count === 0) {
  range.setEnd(node, chars.count);
} else if (node && chars.count > 0) {
  if (node.nodeType === Node.TEXT_NODE) {
    if (node.textContent.length < chars.count) {
      chars.count -= node.textContent.length;
    } else {
      range.setEnd(node, chars.count);
      chars.count = 0;
    }
  } else {
    for (var lp = 0; lp < node.childNodes.length; lp++) {
      range = createRange(node.childNodes[lp], chars, range);

      if (chars.count === 0) {
        break;
      }
    }
  }
}

return range;
};

function setCurrentCursorPosition(chars) {
if (chars >= 0) {
  var selection = window.getSelection();

  range = createRange(document.getElementById("test").parentNode, {
    count: chars
  });

  if (range) {
    range.collapse(false);
    selection.removeAllRanges();
    selection.addRange(range);
  }
}
};

$('#btn').on('click', function(e) {
setCurrentCursorPosition(document.getElementById('test').innerText.length+17);
});

  </script>
</html>
