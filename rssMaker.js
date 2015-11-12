var _url="192.168.33.10/rss";

$(function(){
  $("#button_step1").click(function(){
    // send and get html
    $.ajax({
      type: "POST",
      url: "http://" + _url + "/readHtml.php",
      data: $("#baseurl").val(),
      success: function(data) {
        $("#basehtml").val(data);
      }
    });
  });

  $("#button_step2").click(function(){
    var _pattern = $("#content_pattern").val();
    var _html = $("#basehtml").val();

    if(!_pattern) {
      alert("please input pattern");
      return;
    }

    var _data = {
        pattern : _pattern,
        html : _html
    };
    $.ajax({
      type: "POST",
      url: "http://" + _url + "/getPatternList.php",
      data: JSON.stringify(_data),
      success: function(data){
        console.log(data);
        var json = $.parseJSON(data);

        // パターン表示
        var patterns = json.patterns;
        var list = "";
        for(var i = 0; i < patterns.length; i++)
        {
          list = list + "match" + i + ":\n";
          for(var j = 1; j < patterns[i].length; j++){
            list = list + "{%" + j + "} : " + patterns[i][j] + "\n";
          }
          list = list + "\n";
        }
        $("#pattern_list").val(list);

        $("#feed_title").val(json.title);
        $("#feed_description").val(json.description);
        $("#feed_link").val($("#baseurl").val());
      }
    });
  });

  $("#button_step3").click(function(){
    debuglog("step3");
    var _baseurl = $("#baseurl").val();
    var _pattern = $("#content_pattern").val();
    var _html = $("#basehtml").val();
    var _feed_title = $("#feed_title").val();
    var _feed_link = $("#feed_link").val();
    var _feed_description = $("#feed_description").val();
    var _item_title = $("#item_title").val();
    var _item_link = $("#item_link").val();
    var _item_image = $("#item_image").val();
    var _item_content = $("#item_content").val();

    if(!_baseurl || !_pattern) {
      alert("please input pattern");
      return;
    }

    var _data = {
        baseurl          : _baseurl,
        pattern          : _pattern,
        html             : _html,
        feed_title       : _feed_title,
        feed_link        : _feed_link,
        feed_description : _feed_description,
        item_title       : _item_title,
        item_link        : _item_link,
        item_image       : _item_image,
        item_content     : _item_content
    };
    $.ajax({
      type: "POST",
      url: "http://" + _url + "/createRss.php",
      data: JSON.stringify(_data),
      success: function(data){
        debuglog("success");
        $("#rss_sample").val(data);
      }
    });
  });

  $("#button_step4").click(function(){
    debuglog("step4");
    var _baseurl = $("#baseurl").val();
    var _pattern = $("#content_pattern").val();
    var _html = $("#basehtml").val();
    var _feed_title = $("#feed_title").val();
    var _feed_link = $("#feed_link").val();
    var _feed_description = $("#feed_description").val();
    var _item_title = $("#item_title").val();
    var _item_link = $("#item_link").val();
    var _item_image = $("#item_image").val();
    var _item_content = $("#item_content").val();

    if(!_baseurl || !_pattern) {
      alert("please input pattern");
      return;
    }

    var _data = {
        baseurl          : _baseurl,
        pattern          : _pattern,
        html             : _html,
        feed_title       : _feed_title,
        feed_link        : _feed_link,
        feed_description : _feed_description,
        item_title       : _item_title,
        item_link        : _item_link,
        item_image       : _item_image,
        item_content     : _item_content
    };
    $.ajax({
      type: "POST",
      url: "http://" + _url + "/saveRss2.php",
      data: JSON.stringify(_data),
      success: function(data){
        debuglog("success" + data);
      }
    });
  });
});

// debug
function debuglog(log)
{
  console.log(log);
}

