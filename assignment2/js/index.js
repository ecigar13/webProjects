var imgArr;

$(document).ready(function () {
  //ajax call to get data.json
  var jqxhr = $.getJSON("js/data.json", displayImg)
    .fail(function () {
      console.log("Failed to get data.");
    }).always(function () {
      console.log("Finished.");
    });
});

//display images.
function displayImg(data) {
  console.log(data);
  $('.gallery').empty();
  $('body').append("<div id='preview' ></div>");
  $('#preview').css({
    'position': 'absolute',
    'z-index': 100
  });


  //add image elements.
  $.each(data, function (index, value) {
    var tag = "<li><img id='" + value.id + "' src='images/square/" + value.path + "' alt='" + value.title + "' ></li>";
    $('.gallery').append(tag);

    $('#' + value.id).mouseenter(function (event) {
      $(this).addClass("gray");
      var fullImg = "<img src='images/medium/" + value.path + "' alt='" + value.title + "' >"
      var imgInfo = "<p>City: " + value.city + "<br>Country: " + value.country + "<br>Description: " +
        value.description + "<br>Tags: " + value.tags.join(", ") + "</p>";
      $('#preview').show().append(fullImg).append(imgInfo).css({
        top: event.pageY,
        left: event.pageX,
        'position': 'absolute',
        'z-index': 100
      });

    }).mouseleave(function () {
      $(this).removeClass("gray");
      $('#preview').empty().hide();

    }).mousemove(function (event) {
      $('#preview').css({
        top: event.pageY,
        left: event.pageX,
        'position': 'absolute',
        'z-index': 10
      });
    });
  });

};